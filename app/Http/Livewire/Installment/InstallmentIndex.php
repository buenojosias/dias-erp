<?php

namespace App\Http\Livewire\Installment;

use App\Models\Installment;
use Livewire\Component;

class InstallmentIndex extends Component
{
    public $installmentModal;
    public $form;

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
        $validate['form']['amount'] = intval($this->form['amount'] * 100);
        try {
            $save = Installment::findOrFail($this->form['id'])->update($validate['form']);
            session()->flash('success', 'Parcela atualizada com sucesso.');
            $this->installmentModal = false;
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function render()
    {
        $installments = Installment::query()
            ->with('purchase.service')
            ->whereIn('status', ['Pendente','Atrasada'])
            ->orderBy('expiration_date', 'asc')
            ->paginate();

        return view('livewire.installment.installment-index', compact(['installments']));
    }
}
