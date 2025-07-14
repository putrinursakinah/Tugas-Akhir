<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         User::create([
            'name' => 'bendahara',
            'email' => 'bendahara@gmail.com',
            'password' => bcrypt('bendahara123'),
        ]);
        User::create([
            'name' => 'kepala sekolah',
            'email' => 'kepalasekolah@gmail.com',
            'password' => bcrypt('kepala123'),
        ]);
    }
}
