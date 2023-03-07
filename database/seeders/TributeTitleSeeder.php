<?php

namespace Database\Seeders;

use App\Models\TributeTitle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TributeTitleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TributeTitle::create(['title' => 'ISS', 'type' => 'Municipal']);
        TributeTitle::create(['title' => 'Licenciamento', 'type' => 'Municipal']);
        TributeTitle::create(['title' => 'ICMS', 'type' => 'Estadual']);
        TributeTitle::create(['title' => 'PIS', 'type' => 'Federal']);
        TributeTitle::create(['title' => 'IRPJ', 'type' => 'Federal']);
    }
}
