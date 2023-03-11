<?php

namespace App\Http\Livewire\Purchase;

use App\Models\Installment;
use App\Models\Purchase;
use Livewire\Component;

class PurchaseShow extends Component
{
    public $purchase;
    public $service;
    public $supplier;
    public $installments;
    public $installmentModal;
    public $form;

    public function mount(Purchase $purchase)
    {
        $this->purchase = $purchase;
        $this->service = $purchase->service()->with('client')->first();
        $this->supplier = $purchase->supplier;
    }

    public function openInstallmentModal($installment)
    {
        $this->form = $installment;
        $this->form['amount'] = $installment['amount'] / 100;
        $this->installmentModal = true;
    }

    public function submit()
    {
        $validate = $this->validate([
            'form.amount' => 'required|numeric',
            'form.expiration_date' => 'required|date',
            'form.status' => 'required|string',
            'form.payment_date' => 'nullable|required_if:form.status,Paga'
        ]);
        $validate['form']['amount'] = $this->form['amount'] * 100;
        try {
            $save = Installment::findOrFail($this->form['id'])->update($validate['form']);
            $this->installments = [];
            session()->flash('success', 'Parcela atualizada com sucesso.');
            $this->installmentModal = false;
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function render()
    {
        if($this->purchase->payment_method === 'Parcelado')
        {
            $this->installments = $this->purchase->installments()->orderBy('expiration_date', 'asc')->get();
        }
        return view('livewire.purchase.purchase-show');
    }
}
