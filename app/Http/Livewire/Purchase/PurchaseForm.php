<?php

namespace App\Http\Livewire\Purchase;

use App\Models\Purchase;
use App\Models\Service;
use App\Models\Supplier;
use Livewire\Component;

class PurchaseForm extends Component
{
    public $action;
    public $purchase;
    public $service_id, $supplier_id, $date, $products, $amount, $payment_method, $note;
    public $installments_count, $installments_value;
    public $services;
    public $suppliers;

    public function mount($purchase = null)
    {
        if ($purchase) {
            $this->action = 'edit';
            $this->purchase = Purchase::findOrFail($purchase);
            $this->service_id = $this->purchase->service_id;
            $this->supplier_id = $this->purchase->supplier_id;
            $this->date = $this->purchase->date;
            $this->products = $this->purchase->products;
            $this->amount = $this->purchase->amount;
            $this->payment_method = $this->purchase->payment_method;
            $this->note = $this->purchase->note;
        } else {
            $this->action = 'create';
            $this->date = date('Y-m-d');
            $this->suppliers = Supplier::select('id', 'fantasy_name')->orderBy('fantasy_name', 'asc')->get();
            $this->services = Service::select('id', 'title', 'client_id')->with('client:id,company_name,fantasy_name')->orderBy('title', 'asc')->get();
        }
    }

    public function submit()
    {
        $validate = $this->validate([
            'service_id' => 'required|integer',
            'supplier_id' => 'required|integer',
            'date' => 'required|date',
            'products' => 'required|string',
            'amount' => 'required|numeric',
            'payment_method' => 'required|string',
            'note' => 'nullable|string',
            'installments_count' => 'nullable|required_if:payment_method,Parcelado|integer',
        ]);
        $validate['amount'] = intval($this->amount * 100);
        if($this->payment_method === 'Parcelado') {
            $this->installments_value = intval($this->amount / $this->installments_count * 100);
        }

        try {
            $purchase = Purchase::create($validate);
            if($this->payment_method === 'Parcelado') {
                for($i = 1; $i <= $this->installments_count; $i++) {
                    $purchase->installments()->create([
                        'number' => $i,
                        'amount' => $this->installments_value,
                        'status' => 'Pendente',
                    ]);
                }
            }
            return redirect()->route('purchases.show', $purchase)->with('success', 'Compra cadastrada com sucesso.');
        } catch (\Throwable $th) {
            session()->flash('error', 'Ocorreu um erro ao cadastrar compra.');
            dump($th);
        }
    }

    public function render()
    {
        return view('livewire.purchase.purchase-form');
    }
}
