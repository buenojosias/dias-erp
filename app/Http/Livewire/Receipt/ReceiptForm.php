<?php

namespace App\Http\Livewire\Receipt;

use App\Models\Receipt;
use Livewire\Component;

class ReceiptForm extends Component
{
    public $service;
    public $receipt, $date, $amount, $note;

    public function mount($service, $sgl_receipt = null)
    {
        $this->service = $service;
        if ($sgl_receipt) {
            $this->receipt = $sgl_receipt;
            $this->date = $this->receipt['date'];
            $this->amount = $this->receipt['amount'] / 100;
            $this->note = $this->receipt['note'];
        } else {
            $this->date = date('Y-m-d');
        }
    }

    public function submit()
    {
        $validate = $this->validate([
            'date' => 'required|date',
            'amount' => 'required|numeric',
            'note' => 'nullable|string'
        ]);
        $validate['amount'] = intval($this->amount * 100);

        if($this->receipt) {
            $receipt = $this->receipt;
            Receipt::query()->findOrFail($this->receipt['id'])->update($validate);
            $this->reset();
        } else {
            $receipt = $this->service->receipts()->create($validate);
            $this->reset();
        }
        $this->emit('savedReceipt', $receipt);

    }

    public function render()
    {
        return view('livewire.receipt.receipt-form');
    }
}
