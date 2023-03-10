<?php

namespace App\Http\Livewire\Purchase;

use App\Models\Purchase;
use Livewire\Component;

class PurchaseIndex extends Component
{
    public function render()
    {
        $purchases = Purchase::query()
            ->with(['service.client','supplier'])
            ->orderByDesc('date')
            ->paginate(10);

        return view('livewire.purchase.purchase-index', compact(['purchases']));
    }
}
