<?php

namespace App\Http\Livewire\Renter;

use App\Models\Renter;
use Livewire\Component;

class RenterShow extends Component
{
    public $renter;
    public $address;
    public $contact;

    public function mount(Renter $renter)
    {
        $this->renter = $renter;
        $this->address = $renter->address;
        $this->contact = $renter->contact;
    }

    public function render()
    {
        $rents = $this->renter->rents()->with('service.client')->paginate();
        return view('livewire.renter.renter-show', compact(['rents']));
    }
}
