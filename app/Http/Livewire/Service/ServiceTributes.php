<?php

namespace App\Http\Livewire\Service;

use App\Models\Service;
use App\Models\Tribute;
use App\Models\TributeTitle;
use Livewire\Component;

class ServiceTributes extends Component
{
    public $service;
    public $sum_tributes;
    public $titles;
    public $form;

    public function mount(Service $service)
    {
        $this->service = $service;
    }

    public function render()
    {
        $tributes = $this->service->tributes()->with('title')->withCount('installments')->orderBy('date', 'desc')->get();
        return view('livewire.service.service-tributes', compact('tributes'));
    }
}
