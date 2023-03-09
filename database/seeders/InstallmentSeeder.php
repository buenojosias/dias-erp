<?php

namespace Database\Seeders;

use App\Models\Purchase;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class InstallmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $purchases = Purchase::query()->where('payment_method', 'Parcelado')->get();
        foreach($purchases as $purchase) {
            $installments_count = rand(1, 12);
            for($i = 1; $i <= $installments_count; $i++) {
                $status = Arr::random(['Pendente','Paga','Atrasada']);
                $expiration_date = Carbon::parse($purchase->date)->addMonths($i)->format('Y-m-d');
                $installment = [
                    // 'purchase_id' => $purchase->id,
                    'number' => $i,
                    'amount' => $purchase->amount / $installments_count,
                    'expiration_date' => $expiration_date,
                    'payment_date' => $status === 'Paga' ? Carbon::parse($expiration_date)->subDays(rand(0, 7))->format('Y-m-d') : null,
                    'status' => $status,
                ];
                $purchase->installments()->create($installment);
            }
        }
    }
}
