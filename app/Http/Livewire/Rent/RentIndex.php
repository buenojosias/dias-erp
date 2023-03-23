<?php

namespace App\Http\Livewire\Rent;

use App\Models\Rent;
use Livewire\Component;

class RentIndex extends Component
{
    public function render()
    {
        $rents = Rent::query()
            ->with(['service.client','renter'])
            ->orderByDesc('date')
            ->paginate(10);

        return view('livewire.rent.rent-index', compact(['rents']));
    }
}
