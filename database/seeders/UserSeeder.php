<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Stefan Rubelov',
            'email' => 'stefanrubelov@gmail.com',
            'password' => bcrypt('asdQWE123!'),

        ]);
    }
}
