<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = [
            ['nama' => 'Admin', 'email' => 'admin@gmail.com', 'role' => 'admin'],
            ['nama' => 'Sandro', 'email' => 'sandr0@gmail.com', 'role' => 'user'],
            ['nama' => 'Figo', 'email' => 'figo@gmail.com', 'role' => 'user'],
            ['nama' => 'Sipa', 'email' => 'sipa@gmail.com', 'role' => 'user'],
            ['nama' => 'Sabil', 'email' => 'sabil@gmail.com', 'role' => 'user'],
            ['nama' => 'Kapi', 'email' => 'kapi@gmail.com', 'role' => 'user'],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']], // cari berdasarkan email
                [
                    'nama' => $user['nama'],
                    'password' => bcrypt('K@33ford'), // update password juga jika diubah
                    'role' => $user['role'],
                ]
            );
        }
    }
}