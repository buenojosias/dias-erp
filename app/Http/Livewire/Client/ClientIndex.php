<?php

namespace App\Http\Livewire\Client;

use App\Models\Client;
use Livewire\Component;

class ClientIndex extends Component
{
    public function render()
    {
        $clients = Client::query()
            ->withCount('services')
            ->orderBy('company_name', 'asc')
            ->paginate(10);

        return view('livewire.client.client-index', compact(['clients']));
    }
}
