<?php

namespace App\Http\Livewire\Service;

use App\Models\Service;
use Livewire\Component;

class ServiceTributes extends Component
{
    public $service;
    public $tributes;
    public $sum_tributes;

    public function mount(Service $service)
    {
        $this->service = $service;
        $this->tributes = $service->tributes()->with('title')->withCount('installments')->get();
        $this->sum_tributes = number_format($this->tributes->sum('amount')/100,2,",",".");
    }
    public function render()
    {
        return view('livewire.service.service-tributes');
    }
}
