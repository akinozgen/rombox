ROMbox
======

A community-driven platform for indexing and discovering abandonware games.

------------------------------------------------------------------------------

Description
----------
ROMbox is a modern platform that helps retro gaming enthusiasts discover and
share information about classic games. We provide a comprehensive index and
community features while ensuring users maintain control of their content.

Features
--------
* Game Indexing
  - Multi-platform catalog
  - User-provided mirrors
  - Version tracking
  - Compatibility info

* Community
  - User profiles
  - Game reviews
  - Mirror stats
  - Achievement system
  - Game requests

* Technical
  - Search & filters
  - Dark/light theme
  - Email notifications
  - Mobile responsive

Tech Stack
----------
| Component  | Technology        |
|------------|------------------|
| Backend    | Laravel 10       |
| Frontend   | Livewire        |
| Database   | MySQL           |
| Cache      | Redis           |
| Mail       | Mailpit (Dev)   |
| Container  | Docker + Sail   |

Quick Start
-----------
1. Clone repository:
   ```
   git clone https://github.com/akinozgen/rombox.git
   ```

2. Start containers:
   ```
   ./vendor/bin/sail up -d
   ```

3. Install dependencies:
   ```
   ./vendor/bin/sail composer install
   ```

4. Run migrations:
   ```
   ./vendor/bin/sail artisan migrate
   ```

Development
-----------
- Follow Laravel conventions
- Use Livewire for interactivity
- Support dark mode
- Write tests
- Document changes

Roadmap
-------
[x] Project setup
[x] Docker environment
[ ] User system
[ ] Game indexing
[ ] Platform pages
[ ] Community features
[ ] API development

Legal Notice
-----------
ROMbox is an indexing service and does not host any game files. Users are
responsible for:
- Providing their own storage/mirrors
- Verifying legal status of content
- Compliance with local laws
- Safe execution of any downloaded software

ROMbox is not responsible for:
- Content hosted on external mirrors
- User-provided download links
- Software compatibility
- Any damages from downloaded content

Contributing
-----------
See CONTRIBUTING.md for guidelines.

License
-------
MIT License. See LICENSE file.
