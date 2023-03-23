<?php

namespace App\Http\Livewire\Renter;

use App\Models\Renter;
use Livewire\Component;

class RenterIndex extends Component
{
    public function render()
    {
        $renters = Renter::query()
            ->with('contact')
            ->orderBy('fantasy_name')
            ->paginate(10);

            return view('livewire.renter.renter-index', compact(['renters']));
    }
}
