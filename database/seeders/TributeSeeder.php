<?php

namespace Database\Seeders;

use App\Models\Tribute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tribute::factory(15)->hasInstallments(rand(1,6))->create();
    }
}
