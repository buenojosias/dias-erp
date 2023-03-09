<?php

namespace App\Http\Livewire\Purchase;

use App\Models\Purchase;
use Livewire\Component;

class PurchaseShow extends Component
{
    public $purchase;
    public $service;
    public $supplier;
    public $installments;

    public function mount(Purchase $purchase)
    {
        $this->purchase = $purchase;
        $this->service = $purchase->service()->with('client')->first();
        $this->supplier = $purchase->supplier;
        if($purchase->payment_method === 'Parcelado')
        {
            $this->installments = $purchase->installments;
        }
    }

    public function render()
    {
        return view('livewire.purchase.purchase-show');
    }
}
