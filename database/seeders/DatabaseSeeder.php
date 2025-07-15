<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $role = Role::create(['name' => 'Sekretaris']);
        $role2 = Role::create(['name' => 'Bendahara']);
        
        $user = User::factory()->create([
            'name' => 'Sekretaris Krebet',
            'email' => 'sekre@gmail.com',
            'password' => 'admin123',
        ]);

        $user2 = User::factory()->create([
            'name' => 'Bendahara Krebet',
            'email' => 'bendahara@gmail.com',
            'password' => 'admin123',
        ]);

        $user->assignRole('Sekretaris');
        $user2->assignRole('Bendahara');

        $this->call([
            BatikSeeder::class,
            KesenianSeeder::class,
            CocokTanamSeeder::class,
            PermainanSeeder::class,
            KulinerSeeder::class,
            GuideSeeder::class,
            HomestaySeeder::class,
            StudyBandingSeeder::class,
        ]);
    }
}
