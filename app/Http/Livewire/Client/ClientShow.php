<?php

namespace App\Http\Livewire\Client;

use App\Models\Client;
use Livewire\Component;

class ClientShow extends Component
{
    public $client;
    public $address;
    public $contact;
    public $services;
    public $proposals;

    public function mount(Client $client)
    {
        $this->client = $client;
        $this->address = $client->address;
        $this->contact = $client->contact;
        $this->services = $client->services()->get();
        $this->proposals = $client->proposals()->get();
    }

    public function render()
    {
        return view('livewire.client.client-show');
    }
}
