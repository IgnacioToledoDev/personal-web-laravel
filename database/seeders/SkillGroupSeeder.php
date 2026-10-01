<?php

namespace Database\Seeders;

use App\Models\SkillGroup;
use Illuminate\Database\Seeder;

class SkillGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Design decision: each skill item is stored as an associative array
        // (name/level/note) instead of a positional tuple, so the Filament
        // Repeater can bind to it directly without custom mutators.
        $groups = [
            [
                'group' => 'Languages',
                'items' => [
                    ['name' => 'Rust', 'level' => 5, 'note' => 'daily driver'],
                    ['name' => 'PHP', 'level' => 4, 'note' => '8+ years'],
                    ['name' => 'SQL', 'level' => 4, 'note' => 'postgres'],
                    ['name' => 'Bash', 'level' => 4, 'note' => 'glue everything'],
                    ['name' => 'TypeScript', 'level' => 3, 'note' => 'when needed'],
                ],
            ],
            [
                'group' => 'Backend & APIs',
                'items' => [
                    ['name' => 'Axum / Actix', 'level' => 5, 'note' => 'rust web'],
                    ['name' => 'Tokio', 'level' => 4, 'note' => 'async runtime'],
                    ['name' => 'Laravel', 'level' => 4, 'note' => 'php'],
                    ['name' => 'REST · gRPC', 'level' => 4, 'note' => ''],
                ],
            ],
            [
                'group' => 'Infra & Data',
                'items' => [
                    ['name' => 'Linux', 'level' => 5, 'note' => 'arch btw'],
                    ['name' => 'PostgreSQL', 'level' => 4, 'note' => ''],
                    ['name' => 'Docker', 'level' => 4, 'note' => ''],
                    ['name' => 'Redis', 'level' => 4, 'note' => ''],
                    ['name' => 'Nginx', 'level' => 3, 'note' => ''],
                ],
            ],
            [
                'group' => 'Tooling',
                'items' => [
                    ['name' => 'Neovim', 'level' => 5, 'note' => 'lua-pilled'],
                    ['name' => 'Git', 'level' => 5, 'note' => ''],
                    ['name' => 'CI/CD', 'level' => 4, 'note' => 'gh actions'],
                    ['name' => 'Nix', 'level' => 3, 'note' => 'learning'],
                ],
            ],
        ];

        foreach ($groups as $index => $group) {
            SkillGroup::query()->updateOrCreate(
                ['group' => $group['group']],
                [...$group, 'sort_order' => $index]
            );
        }
    }
}
