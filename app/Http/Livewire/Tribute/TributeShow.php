<?php

namespace App\Http\Livewire\Tribute;

use App\Models\Tribute;
use Livewire\Component;

class TributeShow extends Component
{
    public $tribute;
    public $service;
    public $installments;
    public $title;

    public function mount(Tribute $tribute)
    {
        $this->tribute = $tribute;
        $this->service = $tribute->service()->with('client')->first();
        $this->title = $tribute->title;
        $this->installments = $tribute->installments;
    }

    public function render()
    {
        return view('livewire.tribute.tribute-show');
    }
}
