<?php

namespace App\Http\Livewire\Payment;

use App\Models\Service;
use Livewire\Component;

class PaymentForm extends Component
{
    public $model;
    public $payment, $service_id, $date, $amount, $note;
    public $services;

    public function mount($model) {
        $this->model = $model;
        $this->date = date('Y-m-d');
        $this->services = Service::with('client:id,company_name')->orderBy('title', 'asc')->get();
    }

    public function submit()
    {
        $validate = $this->validate([
            'service_id' => 'required|integer',
            'date' => 'required|date',
            'amount' => 'required|numeric',
            'note' => 'nullable|string'
        ]);
        $validate['amount'] = intval($this->amount * 100);

        try {
            $payment = $this->model->payments()->create($validate);
            $this->emit('savedPayment', $payment);
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function render()
    {
        return view('livewire.payment.payment-form');
    }
}
