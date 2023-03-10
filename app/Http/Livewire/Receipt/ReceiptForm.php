<?php

namespace App\Http\Livewire\Receipt;

use Livewire\Component;

class ReceiptForm extends Component
{
    public $service;
    public $receipt, $date, $amount, $note;

    public function mount($service) {
        $this->service = $service;
        $this->date = date('Y-m-d');
    }

    public function submit()
    {
        $validate = $this->validate([
            'date' => 'required|date',
            'amount' => 'required|numeric',
            'note' => 'nullable|string'
        ]);
        $validate['amount'] = intval($this->amount * 100);

        try {
            $payment = $this->service->receipts()->create($validate);
            $this->emit('savedReceipt', $payment);
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function render()
    {
        return view('livewire.receipt.receipt-form');
    }
}
