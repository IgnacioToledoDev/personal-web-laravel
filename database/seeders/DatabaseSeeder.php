<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Preserve the existing admin user's credentials (name/email/password hash)
        // instead of the factory default, so `migrate:fresh --seed` doesn't lock
        // the admin out of the already-configured Filament panel.
        User::query()->updateOrCreate(
            ['email' => 'itoledo@ninjaexcel.com'],
            [
                'name' => 'Ignacio Toledo',
                'password' => '$2y$12$oiTGR8eauDfpR8eRd1UseuMoAzv87EvW.ykL6/FU7U3M12PkIrSey',
                'email_verified_at' => null,
            ]
        );

        $this->call([
            ProfileSeeder::class,
            ProjectSeeder::class,
            ExperienceSeeder::class,
            SkillGroupSeeder::class,
            LinkSeeder::class,
        ]);
    }
}
