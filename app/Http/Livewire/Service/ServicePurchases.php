<?php

namespace App\Http\Livewire\Service;

use App\Models\Service;
use Livewire\Component;

class ServicePurchases extends Component
{
    public $service;
    public $purchases;
    public $sum_purchases;

    public function mount(Service $service)
    {
        $this->service = $service;
        $this->purchases = $service->purchases()->with('supplier')->get();
        $this->sum_purchases = number_format($this->purchases->sum('amount')/100,2,",",".");
    }

    public function render()
    {
        return view('livewire.service.service-purchases');
    }
}
