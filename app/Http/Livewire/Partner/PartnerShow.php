<?php

namespace App\Http\Livewire\Partner;

use App\Models\Partner;
use Livewire\Component;

class PartnerShow extends Component
{
    public $partner;
    public $address;
    public $contact;

    public function mount(Partner $partner)
    {
        $this->partner = $partner;
        $this->address = $partner->address;
        $this->contact = $partner->contact;
    }

    public function render()
    {
        $payments = $this->partner->payments()->with('service')->paginate();
        return view('livewire.partner.partner-show', compact(['payments']));
    }
}
