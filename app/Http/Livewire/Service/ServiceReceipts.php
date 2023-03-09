<?php

namespace App\Http\Livewire\Service;

use App\Models\Service;
use Livewire\Component;

class ServiceReceipts extends Component
{
    public $service;
    public $receipts;
    public $sum_receipts;

    public function mount(Service $service)
    {
        $this->service = $service;
        $this->receipts = $service->receipts;
        $this->sum_receipts = number_format($this->receipts->sum('amount')/100,2,",",".");
    }

    public function render()
    {
        return view('livewire.service.service-receipts');
    }
}
