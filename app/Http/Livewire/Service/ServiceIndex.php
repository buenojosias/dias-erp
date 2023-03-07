<?php

namespace App\Http\Livewire\Service;

use App\Models\Service;
use Livewire\Component;

class ServiceIndex extends Component
{
    public function render()
    {
        $services = Service::query()
            ->with('client')
            ->paginate(10);

        return view('livewire.service.service-index', compact(['services']));
    }
}
