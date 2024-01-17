<?php

namespace App\Http\Livewire\Purchase;

use App\Models\Installment;
use App\Models\Purchase;
use App\Models\Service;
use App\Models\Supplier;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PurchaseForm extends Component
{
    public $action;
    public $purchase;
    public $client;
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
            $this->client = $this->purchase->service->client->company_name;
            $this->supplier_id = $this->purchase->supplier_id;
            $this->date = $this->purchase->date;
            $this->products = $this->purchase->products;
            $this->amount = $this->purchase->amount / 100;
            $this->payment_method = $this->purchase->payment_method;
            $this->installments_count = $this->purchase->installments->count();
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
        if($this->action === 'create' && $this->payment_method === 'Parcelado') {
            $this->installments_value = intval($this->amount / $this->installments_count * 100);
        }

        try {
            if ($this->action === 'create') {
                $purchase = Purchase::create($validate);
            } else if($this->action === 'edit') {
                Purchase::query()->findOrFail($this->purchase['id'])->update($validate);
            }
            if($this->action === 'create' && $this->payment_method === 'Parcelado') {
                for($i = 1; $i <= $this->installments_count; $i++) {
                    $purchase->installments()->create([
                        'number' => $i,
                        'amount' => $this->installments_value,
                        'status' => 'Pendente',
                    ]);
                }
            } else if($this->action === 'edit' && $this->payment_method === 'À vista') {
                $installments = $this->purchase->installments->pluck('id');
                DB::table('installments')->whereIn('id', $installments)->delete();
            }
            return redirect()->route('purchases.show', $purchase ?? $this->purchase)->with('success', 'Compra '. $this->action === 'create' ? 'cadastrada' : 'atualizada' .' com sucesso.');
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
