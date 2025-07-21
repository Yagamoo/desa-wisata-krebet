<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GuideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('guides')->insert([
            [
                'name' => 'Guide Satu',
                'no_telp' => '08123456789',
                'user_id' => 3
            ],
            [
                'name' => 'Guide Dua',
                'no_telp' => '08987654321',
                'user_id' => 4
            ],
        ]);
    }
}
