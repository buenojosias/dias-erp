<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Josias Bueno',
            'email' => 'josias.jpb@gmail.com',
            'password' => bcrypt('JPB@2019'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);
        User::create([
            'name' => 'Cleoni Anjos',
            'email' => 'cleonidiasanjos@gmail.com',
            'password' => bcrypt('rpdm009'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);
    }
}
