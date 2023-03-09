<?php

namespace Database\Seeders;

use App\Models\Tribute;
use App\Models\TributeInstallment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TributeInstallmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tributes = Tribute::all();
        foreach ($tributes as $tribute) {
            $installments = rand(1,6);
            TributeInstallment::factory($installments)->create([
                'tribute_id' => $tribute->id,
                'amount' => $tribute->amount / $installments,
            ]);
        }
    }
}
