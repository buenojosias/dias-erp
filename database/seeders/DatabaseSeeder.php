<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ClientSeeder::class,
            ServiceSeeder::class,
            SupplierSeeder::class,
            EmployeeSeeder::class,
            PartnerSeeder::class,
            ProposalSeeder::class,
            PurchaseSeeder::class,
            ReceiptSeeder::class,
            TributeTitleSeeder::class,
            TributeSeeder::class,
            InstallmentSeeder::class,
        ]);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
