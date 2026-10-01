<?php

namespace Database\Seeders;

use App\Models\Link;
use Illuminate\Database\Seeder;

class LinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $links = [
            ['label' => 'GitHub', 'display' => 'github.com/noctidev', 'href' => '#'],
            ['label' => 'Email', 'display' => 'hi@noctidev.sh', 'href' => 'mailto:hi@noctidev.sh'],
            ['label' => 'X', 'display' => 'x.com/noctidev', 'href' => '#'],
        ];

        foreach ($links as $index => $link) {
            Link::query()->updateOrCreate(
                ['label' => $link['label']],
                [...$link, 'sort_order' => $index]
            );
        }
    }
}
