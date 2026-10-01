<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            ['name' => 'ferro-queue', 'lang' => 'Rust', 'color' => 'var(--c-orange)', 'stars' => 642, 'desc' => 'Cola de trabajos distribuida y persistente sobre Postgres. Reintentos con backoff, prioridades y dead-letter, con un cliente async de cero dependencias pesadas.', 'tags' => ['tokio', 'sqlx', 'async', 'jobs'], 'url' => '#'],
            ['name' => 'nocti-cli', 'lang' => 'Rust', 'color' => 'var(--c-orange)', 'stars' => 318, 'desc' => 'Mi navaja suiza de terminal: scaffolding de proyectos, snippets y automatizaciones de dotfiles. Binario único, arranque instantáneo.', 'tags' => ['clap', 'tui', 'dx'], 'url' => '#'],
            ['name' => 'phpx-router', 'lang' => 'PHP', 'color' => 'var(--c-purple)', 'stars' => 271, 'desc' => 'Router HTTP minimalista para PHP moderno (8.3+): atributos, middleware tipado y matching compilado. Pensado para microservicios ligeros.', 'tags' => ['php8', 'psr', 'router'], 'url' => '#'],
            ['name' => 'lumen-logs', 'lang' => 'Rust', 'color' => 'var(--c-orange)', 'stars' => 156, 'desc' => 'Agregador de logs estructurados con parsing en streaming y consultas tipo SQL sobre stdin. Pensado para depurar en producción sin salir de la shell.', 'tags' => ['streaming', 'observability', 'cli'], 'url' => '#'],
        ];

        foreach ($projects as $index => $project) {
            Project::query()->updateOrCreate(
                ['name' => $project['name']],
                [...$project, 'sort_order' => $index]
            );
        }
    }
}
