<?php

namespace App\Http\Livewire\Supplier;

use App\Models\Supplier;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SupplierForm extends Component
{
    public $action;
    public $supplier;
    public $company_name, $fantasy_name, $cnpj;
    public $address, $street_name, $number, $complement, $district, $zip_code, $city, $state = 'PR';
    public $contact, $representative, $phone, $whatsapp, $email;

    public function mount($supplier = null)
    {
        if ($supplier) {
            $this->action = 'edit';
            $this->supplier = Supplier::findOrFail($supplier);
            $this->company_name = $this->supplier->company_name;
            $this->fantasy_name = $this->supplier->fantasy_name;
            $this->cnpj = $this->supplier->cnpj;

            $this->address = $this->supplier->address;
            $this->street_name = $this->address->street_name;
            $this->number = $this->address->number;
            $this->complement = $this->address->complement;
            $this->district = $this->address->district;
            $this->zip_code = $this->address->zip_code;
            $this->city = $this->address->city;
            $this->state = $this->address->state;

            $this->contact = $this->supplier->contact;
            $this->representative = $this->contact->representative;
            $this->phone = $this->contact->phone;
            $this->whatsapp = $this->contact->whatsapp;
            $this->email = $this->contact->email;
        } else {
            $this->action = 'create';
        }
    }

    public function submit()
    {
        $validateSupplier = $this->validate([
            'company_name' => 'required|string|max:120',
            'fantasy_name' => 'required|string|max:120',
            'cnpj' => 'required|string|size:14',
        ]);
        $validateAddress = $this->validate([
            'street_name' => 'required|string|max:100',
            'number' => 'required|string|max:10',
            'complement' => 'nullable|string|max:30',
            'district' => 'required|string|max:50',
            'zip_code' => 'nullable|string|min:9|max:9',
            'city' => 'required|string|max:50',
            'state' => 'required|string|min:2|max:2',
        ]);
        $validateContact = $this->validate([
            'representative' => 'required|string|max:100',
            'phone' => 'nullable|string|min:14|max:15',
            'whatsapp' => 'nullable|string|min:14|max:15',
            'email' => 'nullable|email',
        ]);

        if ($this->action === 'create') {
            DB::beginTransaction();
            try {
                $supplier = Supplier::create($validateSupplier);
                $address = $supplier->address()->create($validateAddress);
                $contact = $supplier->contact()->create($validateContact);
            } catch (\Throwable $th) {
                session()->flash('error', 'Ocorreu um erro ao cadastrar fornecedor.');
                dd($th);
            }
            if ($supplier && $address && $contact) {
                DB::commit();
                return redirect()->route('suppliers.show', $supplier)->with('success', 'Fornecedor cadastrado com sucesso.');
            } else {
                DB::rollback();
                session()->flash('error', 'Ocorreu um erro ao cadastrar fornecedor.');
            }
        } else if ($this->action === 'edit') {
            try {
                $this->supplier->update($validateSupplier);
                $this->address->update($validateAddress);
                $this->contact->update($validateContact);
                return redirect()->route('suppliers.show', $this->supplier)->with('success', 'Fornecedor atualizado com sucesso.');
            } catch (\Throwable $th) {
                session()->flash('error', 'Ocorreu um erro ao atualizar fornecedor.');
                dd($th);
            }
        }
    }

    public function render()
    {
        return view('livewire.supplier.supplier-form');
    }
}
