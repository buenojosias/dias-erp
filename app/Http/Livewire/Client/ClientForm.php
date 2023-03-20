<?php

namespace App\Http\Livewire\Client;

use App\Models\Client;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ClientForm extends Component
{
    public $action;
    public $client;
    public $company_name, $fantasy_name, $person_type, $document_number;
    public $address, $street_name, $number, $complement, $district, $zip_code, $city, $state = 'PR';
    public $contact, $representative, $phone, $whatsapp, $email;

    public function mount($client = null)
    {
        if ($client) {
            $this->action = 'edit';
            $this->client = Client::findOrFail($client);
            $this->person_type = $this->client->person_type;
            $this->company_name = $this->client->company_name;
            $this->fantasy_name = $this->client->fantasy_name;
            $this->document_number = $this->client->document_number;

            $this->address = $this->client->address;
            $this->street_name = $this->address->street_name;
            $this->number = $this->address->number;
            $this->complement = $this->address->complement;
            $this->district = $this->address->district;
            $this->zip_code = $this->address->zip_code;
            $this->city = $this->address->city;
            $this->state = $this->address->state;

            $this->contact = $this->client->contact;
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
        $validateClient = $this->validate([
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
                $client = Client::create($validateClient);
                $address = $client->address()->create($validateAddress);
                $contact = $client->contact()->create($validateContact);
            } catch (\Throwable $th) {
                session()->flash('error', 'Ocorreu um erro ao cadastrar cliente.');
                dd($th);
            }
            if ($client && $address && $contact) {
                DB::commit();
                return redirect()->route('clients.show', $client)->with('success', 'Cliente cadastrado com sucesso.');
            } else {
                DB::rollback();
                session()->flash('error', 'Ocorreu um erro ao cadastrar cliente.');
            }
        } else if ($this->action === 'edit') {
            try {
                $this->client->update($validateClient);
                $this->address->update($validateAddress);
                $this->contact->update($validateContact);
                return redirect()->route('clients.show', $this->client)->with('success', 'Cliente atualizado com sucesso.');
            } catch (\Throwable $th) {
                session()->flash('error', 'Ocorreu um erro ao atualizar cliente.');
                dd($th);
            }
        }
    }

    public function render()
    {
        return view('livewire.client.client-form');
    }
}
