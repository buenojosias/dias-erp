<?php

namespace App\Http\Livewire\Renter;

use App\Models\Renter;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class RenterForm extends Component
{
    public $action;
    public $renter;
    public $company_name, $fantasy_name, $cnpj;
    public $address, $street_name, $number, $complement, $district, $zip_code, $city, $state = 'PR';
    public $contact, $representative, $phone, $whatsapp, $email;

    public function mount($renter = null)
    {
        if ($renter) {
            $this->action = 'edit';
            $this->renter = Renter::findOrFail($renter);
            $this->company_name = $this->renter->company_name;
            $this->fantasy_name = $this->renter->fantasy_name;
            $this->cnpj = $this->renter->cnpj;

            $this->address = $this->renter->address;
            $this->street_name = $this->address->street_name;
            $this->number = $this->address->number;
            $this->complement = $this->address->complement;
            $this->district = $this->address->district;
            $this->zip_code = $this->address->zip_code;
            $this->city = $this->address->city;
            $this->state = $this->address->state;

            $this->contact = $this->renter->contact;
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
        $validateRenter = $this->validate([
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
                $renter = renter::create($validateRenter);
                $address = $renter->address()->create($validateAddress);
                $contact = $renter->contact()->create($validateContact);
            } catch (\Throwable $th) {
                session()->flash('error', 'Ocorreu um erro ao cadastrar locador.');
                dd($th);
            }
            if ($renter && $address && $contact) {
                DB::commit();
                return redirect()->route('renters.show', $renter)->with('success', 'Locador cadastrado com sucesso.');
            } else {
                DB::rollback();
                session()->flash('error', 'Ocorreu um erro ao cadastrar locador.');
            }
        } else if ($this->action === 'edit') {
            try {
                $this->renter->update($validateRenter);
                $this->address->update($validateAddress);
                $this->contact->update($validateContact);
                return redirect()->route('renters.show', $this->renter)->with('success', 'Locador atualizado com sucesso.');
            } catch (\Throwable $th) {
                session()->flash('error', 'Ocorreu um erro ao atualizar locador.');
                dd($th);
            }
        }
    }

    public function render()
    {
        return view('livewire.renter.renter-form');
    }
}
