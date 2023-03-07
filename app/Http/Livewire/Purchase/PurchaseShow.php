<?php

namespace App\Http\Livewire\Purchase;

use App\Models\Purchase;
use Livewire\Component;

class PurchaseShow extends Component
{
    public $purchase;
    public $service;
    public $supplier;

    public function mount(Purchase $purchase)
    {
        $this->purchase = $purchase;
        $this->service = $purchase->service()->with('client')->get();
        $this->supplier = $purchase->supplier;
    }

    public function render()
    {
        return view('livewire.purchase.purchase-show');
    }
}
