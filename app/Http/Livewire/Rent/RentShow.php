<?php

namespace App\Http\Livewire\Rent;

use App\Models\Rent;
use Livewire\Component;

class RentShow extends Component
{
    public $rent;
    public $service;
    public $renter;

    public function mount(Rent $rent)
    {
        $this->rent = $rent;
        $this->service = $rent->service()->with('client')->first();
        $this->renter = $rent->renter;
    }

    public function render()
    {
        return view('livewire.rent.rent-show');
    }
}
