<?php

namespace App\Http\Livewire\Service;

use App\Models\Service;
use Livewire\Component;

class ServicePayments extends Component
{
    public $service;
    public $payments;
    public $sum_payments;

    public function mount(Service $service)
    {
        $this->service = $service;
        $this->payments = $service->payments()->with('paymentable')->get();
        $this->sum_payments = number_format($this->payments->sum('amount')/100,2,",",".");
    }

    public function render()
    {
        return view('livewire.service.service-payments');
    }
}
