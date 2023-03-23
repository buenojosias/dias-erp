<?php

namespace App\Http\Livewire\Service;

use App\Models\Service;
use Livewire\Component;

class ServiceRents extends Component
{
    public $service;
    public $rents;
    public $sum_rents;

    public function mount(Service $service)
    {
        $this->service = $service;
        $this->rents = $service->rents()->with('renter')->get();
    }

    public function render()
    {
        return view('livewire.service.service-rents');
    }
}
