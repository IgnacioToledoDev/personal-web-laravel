<?php

namespace Database\Seeders;

use App\Models\Experience;
use Illuminate\Database\Seeder;

class ExperienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $experiences = [
            [
                'hash' => 'a1f9c2e',
                'role' => 'Senior Backend Engineer',
                'company' => 'Lumina Systems',
                'when' => '2023 — present',
                'what' => [
                    'Lidero la migración de servicios críticos de PHP a Rust (Axum), bajando p99 de 480ms a 70ms.',
                    'Diseño de APIs internas gRPC y una capa de colas propia sobre Postgres.',
                ],
                'stack' => ['Rust', 'Axum', 'Postgres', 'gRPC', 'Docker'],
            ],
            [
                'hash' => '7b3d0a4',
                'role' => 'Backend Developer',
                'company' => 'Adriatic Labs',
                'when' => '2020 — 2023',
                'what' => [
                    'Construí y mantuve APIs en Laravel para una plataforma SaaS con +200k usuarios.',
                    'Introduje testing, CI y observabilidad; reduje incidencias en producción ~40%.',
                ],
                'stack' => ['PHP', 'Laravel', 'MySQL', 'Redis'],
            ],
            [
                'hash' => '3e8f1b9',
                'role' => 'Full-Stack Developer',
                'company' => 'Freelance',
                'when' => '2018 — 2020',
                'what' => [
                    'Entregué webs y APIs a medida para pymes, de principio a fin sobre VPS Linux.',
                ],
                'stack' => ['PHP', 'Linux', 'Nginx', 'JS'],
            ],
        ];

        foreach ($experiences as $index => $experience) {
            Experience::query()->updateOrCreate(
                ['hash' => $experience['hash']],
                [...$experience, 'sort_order' => $index]
            );
        }
    }
}
