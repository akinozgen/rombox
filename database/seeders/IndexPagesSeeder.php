<?php

namespace Database\Seeders;

use App\Models\IndexPages;
use Illuminate\Database\Seeder;

class IndexPagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $links = [
            "https://psxdatacenter.com/ulist.html",
            "https://psxdatacenter.com/plist.html",
            "https://psxdatacenter.com/jlist.html",
            "https://psxdatacenter.com/psx2/jlist2.html",
            "https://psxdatacenter.com/psx2/ulist2.html",
            "https://psxdatacenter.com/psx2/plist2.html",
            "https://psxdatacenter.com/psp/plist.html",
            "https://psxdatacenter.com/psp/ulist.html",
            "https://psxdatacenter.com/psp/jlist.html",
        ];

        foreach ($links as $link) {
            IndexPages::create([
                'url' => $link,
            ]);
        }
    }
}
