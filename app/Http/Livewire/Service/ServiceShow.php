<?php

namespace App\Http\Livewire\Service;

use App\Models\Service;
use Livewire\Component;

class ServiceShow extends Component
{
    public $service;
    public $receipts;
    public $purchases;
    public $rents;
    public $payments;
    public $tributes;
    public $prevProfit;
    public $realProfit;

    public function mount(Service $service)
    {
        $this->service = $service;
        $this->service->load('client');
        $this->receipts = $service->receipts()->sum('amount');
        $this->purchases = $service->purchases()->sum('amount');
        $this->rents = $service->rents()->sum('amount');
        $this->payments = $service->payments()->sum('amount');
        $this->tributes = $service->tributes()->sum('amount');
        $this->prevProfit = $this->service->amount - $this->purchases - $this->rents - $this->payments - $this->tributes;
        $this->realProfit = $this->receipts - $this->purchases - $this->rents - $this->payments - $this->tributes;
    }

    public function render()
    {
        return view('livewire.service.service-show');
    }
}
