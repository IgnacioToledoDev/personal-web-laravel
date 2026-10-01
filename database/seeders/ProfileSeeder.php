<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Profile::query()->updateOrCreate(
            ['id' => 1],
            [
                'user' => 'noctidev',
                'host' => 'arch',
                'path' => '~',
                'ascii' => " _   _    ___     ____  _____  ___ \n| \\ | |  / _ \\   / ___||_   _||_ _|\n|  \\| | | | | | | |      | |   | | \n| |\\  | | |_| | | |___   | |   | | \n|_| \\_|  \\___/   \\____|  |_|  |___|\n      n  i  g  h  t   ·   s  h  i  f  t   ·   d  e  v",
                'neofetch_title_name' => 'noctidev',
                'neofetch_title_host' => 'arch',
                // Design decision: stored as associative rows (label/value) instead of
                // positional tuples so the Filament Repeater can bind directly without
                // custom mutators. Multi-value entries are joined with ", ".
                'neofetch_rows' => [
                    ['label' => 'OS', 'value' => 'Arch Linux x86_64'],
                    ['label' => 'Host', 'value' => 'personal-rig / ThinkPad'],
                    ['label' => 'Kernel', 'value' => '6.9-zen'],
                    ['label' => 'Shell', 'value' => 'zsh + starship'],
                    ['label' => 'Editor', 'value' => 'neovim'],
                    ['label' => 'WM', 'value' => 'Hyprland'],
                    ['label' => 'Langs', 'value' => 'Rust, PHP, Bash, SQL'],
                    ['label' => 'Focus', 'value' => 'Backend, Systems, APIs'],
                    ['label' => 'Uptime', 'value' => '~7 yrs in the trenches'],
                ],
                'about_lead' => 'Hey — soy **NoctiDev**, backend developer y <hl>Rust enthusiast</hl>. Vivo en la terminal: construyo servicios rápidos, fiables y bien tipados, casi siempre sobre Linux. Vengo del mundo PHP y hoy paso la mayor parte del tiempo escribiendo Rust — me obsesionan los sistemas que no se caen a las 3 a.m. y el código que se lee como prosa.',
                // Same associative-row decision as neofetch_rows.
                'about_meta' => [
                    ['key' => 'Role', 'value' => 'Backend Developer', 'isAccent' => true],
                    ['key' => 'Stack', 'value' => 'Rust · PHP · Linux', 'isAccent' => false],
                    ['key' => 'Based in', 'value' => 'Remote / CET', 'isAccent' => false],
                    ['key' => 'Status', 'value' => 'Open to projects', 'isAccent' => true],
                ],
            ]
        );
    }
}
