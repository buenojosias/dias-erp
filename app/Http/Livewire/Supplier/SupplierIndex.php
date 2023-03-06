<?php

namespace App\Http\Livewire\Supplier;

use App\Models\Supplier;
use Livewire\Component;

class SupplierIndex extends Component
{
    public function render()
    {
        $suppliers = Supplier::query()
            ->orderBy('fantasy_name')
            ->paginate(10);

        return view('livewire.supplier.supplier-index', compact(['suppliers']));
    }
}
