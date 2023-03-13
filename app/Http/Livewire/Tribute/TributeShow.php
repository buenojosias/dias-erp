<?php

namespace App\Http\Livewire\Tribute;

use App\Models\Tribute;
use App\Models\TributeInstallment;
use Livewire\Component;

class TributeShow extends Component
{
    public $tribute;
    public $service;
    public $installments;
    public $title;
    public $installmentModal;
    public $form;

    public function mount(Tribute $tribute)
    {
        $this->tribute = $tribute;
        $this->service = $tribute->service()->with('client')->first();
        $this->title = $tribute->title;
        // $this->installments = $tribute->installments()->orderBy('expiration_date', 'asc')->get();
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
            $save = TributeInstallment::findOrFail($this->form['id'])->update($validate['form']);
            $this->installments = [];
            session()->flash('success', 'Parcela atualizada com sucesso.');
            $this->installmentModal = false;
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    public function render()
    {
        $this->installments = $this->tribute->installments()->orderBy('expiration_date', 'asc')->get();
        return view('livewire.tribute.tribute-show');
    }
}
