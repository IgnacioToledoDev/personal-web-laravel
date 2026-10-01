<?php

namespace Database\Seeders;

use App\Models\TechCategory;
use Illuminate\Database\Seeder;

class TechCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['category' => 'Languages', 'items' => ['PHP', 'Rust', 'JavaScript', 'TypeScript']],
            ['category' => 'Backend', 'items' => ['Symfony', 'Laravel', 'Express', 'Node.js']],
            ['category' => 'Databases', 'items' => ['SQL', 'PostgreSQL']],
            ['category' => 'Frontend', 'items' => ['React', 'Stimulus', 'CSS', 'Tailwind']],
            ['category' => 'DevOps', 'items' => ['Docker', 'GitHub Actions']],
        ];

        foreach ($categories as $index => $data) {
            TechCategory::query()->updateOrCreate(
                ['category' => $data['category']],
                [
                    'items' => $data['items'],
                    'sort_order' => $index,
                ]
            );
        }
    }
}
