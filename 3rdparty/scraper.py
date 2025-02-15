import os
import json
import csv
import requests
import mysql.connector
from bs4 import BeautifulSoup
from dotenv import load_dotenv
from datetime import datetime

# Load environment variables from .env
load_dotenv()

# Base URL for game info pages
BASE_URL = "https://psxdatacenter.com/psx2/"

def get_db_connection():
    """Creates database connection using Laravel's .env settings"""
    return mysql.connector.connect(
        host='localhost',  # Changed to Docker service name
        user=os.getenv('DB_USERNAME', 'root'),
        password=os.getenv('DB_PASSWORD', ''),
        database=os.getenv('DB_DATABASE'),
        port=int(os.getenv('DB_PORT', 3306))
    )

def scrape_psx_data(index_pages):
    """Scrapes multiple index pages and extracts game data."""
    all_games = []
    
    for page in index_pages:
        url = page['url']
        print(f"Scraping: {url}")
        
        try:
            response = requests.get(url)
            status_code = response.status_code
            error_message = None
            
            if status_code == 200:
                soup = BeautifulSoup(response.text, 'html.parser')
                
                # Find all game rows within tables
                for row in soup.select("table.sectiontable tr"):
                    cols = row.find_all("td")
                    if len(cols) < 4:
                        continue  # Skip incomplete rows
                    
                    game_info = {
                        "serial": cols[1].text.strip().replace(',', '\\,').replace('\n', '\\n'),
                        "title": cols[2].text.strip().replace(',', '\\,').replace('\n', '\\n'),
                        "language": cols[3].text.strip().replace(',', '\\,').replace('\n', '\\n'),
                        "info_url": BASE_URL + cols[0].find("a")["href"] if cols[0].find("a") else None
                    }
                    all_games.append(game_info)
            else:
                error_message = f"HTTP {status_code}"
                
        except Exception as e:
            status_code = None
            error_message = str(e)
        
        # Update page status in database
        update_page_status(page['id'], status_code, error_message)
    
    return all_games

def update_page_status(page_id, status_code, error_message=None):
    """Updates the status of an index page after scraping"""
    conn = get_db_connection()
    cursor = conn.cursor()
    
    sql = """UPDATE index_pages 
             SET last_checked_at = %s, 
                 status_code = %s, 
                 error_message = %s 
             WHERE id = %s"""
             
    values = (datetime.now(), status_code, error_message, page_id)
    cursor.execute(sql, values)
    
    conn.commit()
    cursor.close()
    conn.close()

def save_to_database(data):
    """Saves data to MariaDB using Laravel's database configuration"""
    conn = get_db_connection()
    cursor = conn.cursor()
    
    for game in data:
        # Assuming your table is named 'games'
        sql = """INSERT INTO games (serial, title, language, info_url) 
                 VALUES (%s, %s, %s, %s)
                 ON DUPLICATE KEY UPDATE
                 title = VALUES(title),
                 language = VALUES(language),
                 info_url = VALUES(info_url)"""
        
        values = (game['serial'], game['title'], game['language'], game['info_url'])
        cursor.execute(sql, values)
    
    conn.commit()
    cursor.close()
    conn.close()
    print("Data saved to database")

def save_to_json(data, output_path):
    """Saves data to a JSON file."""
    with open(output_path, "w", encoding="utf-8") as f:
        json.dump(data, f, indent=4)
    print(f"Data saved to {output_path}")

def save_to_csv(data, output_path):
    """Saves data to a CSV file."""
    with open(output_path, "w", newline="", encoding="utf-8") as f:
        writer = csv.DictWriter(f, fieldnames=["serial", "title", "language", "info_url"])
        writer.writeheader()
        writer.writerows(data)
    print(f"Data saved to {output_path}")

def get_index_pages():
    """Fetches index pages from database"""
    conn = get_db_connection()
    cursor = conn.cursor(dictionary=True)
    
    cursor.execute("SELECT id, url FROM index_pages")
    pages = cursor.fetchall()
    
    cursor.close()
    conn.close()
    
    if not pages:
        raise Exception("No index pages found in database")
    
    return pages

def main(output_path=None, output_type='json', use_db=False):
    """Main function with configurable parameters"""
    try:
        index_pages = get_index_pages()
        print(f"Found {len(index_pages)} pages to scrape")
        
        scraped_data = scrape_psx_data(index_pages)
        print(f"Scraped {len(scraped_data)} games")
        
        if use_db:
            save_to_database(scraped_data)
        
        if output_path:
            if output_type.lower() == 'json':
                save_to_json(scraped_data, output_path)
            elif output_type.lower() == 'csv':
                save_to_csv(scraped_data, output_path)
    
    except Exception as e:
        print(f"Error: {str(e)}")
        exit(1)

if __name__ == "__main__":
    import argparse
    
    parser = argparse.ArgumentParser(description='Scrape PSX game data')
    parser.add_argument('--output', help='Output file path')
    parser.add_argument('--type', choices=['json', 'csv'], default='json',
                        help='Output file type (json or csv)')
    parser.add_argument('--use-db', action='store_true',
                        help='Save data to database using Laravel settings')
    
    args = parser.parse_args()
    main(args.output, args.type, args.use_db)
