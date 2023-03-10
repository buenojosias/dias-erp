<?php

namespace App\Http\Livewire\Partner;

use App\Models\Partner;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PartnerForm extends Component
{
    public $action;
    public $partner;
    public $company_name, $fantasy_name, $person_type, $document_number;
    public $address, $street_name, $number, $complement, $district, $zip_code, $city, $state = 'PR';
    public $contact, $representative, $phone, $whatsapp, $email;

    public function mount($partner = null)
    {
        if ($partner) {
            $this->action = 'edit';
            $this->partner = Partner::findOrFail($partner);
            $this->person_type = $this->partner->person_type;
            $this->company_name = $this->partner->company_name;
            $this->fantasy_name = $this->partner->fantasy_name;
            $this->document_number = $this->partner->document_number;

            $this->address = $this->partner->address;
            $this->street_name = $this->address->street_name;
            $this->number = $this->address->number;
            $this->complement = $this->address->complement;
            $this->district = $this->address->district;
            $this->zip_code = $this->address->zip_code;
            $this->city = $this->address->city;
            $this->state = $this->address->state;

            $this->contact = $this->partner->contact;
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
        $validatePartner = $this->validate([
            'person_type' => 'required|string',
            'company_name' => 'required|string|max:120',
            'fantasy_name' => 'required_if:person_type,PJ|max:120',
            'document_number' => 'required|string|min:11|max:14',
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
            'representative' => 'nullable|required_if:person_type,PJ|string|max:100',
            'phone' => 'nullable|string|min:14|max:15',
            'whatsapp' => 'nullable|string|min:14|max:15',
            'email' => 'nullable|email',
        ]);

        if ($this->action === 'create') {
            DB::beginTransaction();
            try {
                $partner = Partner::create($validatePartner);
                $address = $partner->address()->create($validateAddress);
                $contact = $partner->contact()->create($validateContact);
            } catch (\Throwable $th) {
                session()->flash('error', 'Ocorreu um erro ao cadastrar prestador.');
                dd($th);
            }
            if ($partner && $address && $contact) {
                DB::commit();
                return redirect()->route('partners.show', $partner)->with('success', 'Prestador cadastrado com sucesso.');
            } else {
                DB::rollback();
                session()->flash('error', 'Ocorreu um erro ao cadastrar prestador.');
            }
        } else if ($this->action === 'edit') {
            try {
                $this->partner->update($validatePartner);
                $this->address->update($validateAddress);
                $this->contact->update($validateContact);
                return redirect()->route('partners.show', $this->partner)->with('success', 'Prestador atualizado com sucesso.');
            } catch (\Throwable $th) {
                session()->flash('error', 'Ocorreu um erro ao atualizar prestador.');
                dd($th);
            }
        }
    }

    public function render()
    {
        return view('livewire.partner.partner-form');
    }
}
