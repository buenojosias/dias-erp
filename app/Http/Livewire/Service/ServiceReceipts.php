<?php

namespace App\Http\Livewire\Service;

use App\Models\Service;
use Livewire\Component;

class ServiceReceipts extends Component
{
    public $service;
    public $receipts;
    public $sum_receipts;
    public $receiptModal;

    protected $listeners = [
        'savedReceipt',
    ];

    public function mount(Service $service)
    {
        $this->service = $service;
    }

    public function openReceiptModal()
    {
        $this->receiptModal = true;
    }

    public function savedReceipt($receipt)
    {
        session()->flash('success', 'Recebimento registrado com sucesso.');
        $this->receiptModal = false;
    }

    public function render()
    {
        $this->receipts = $this->service->receipts()->orderByDesc('date')->get();
        return view('livewire.service.service-receipts');
    }
}
