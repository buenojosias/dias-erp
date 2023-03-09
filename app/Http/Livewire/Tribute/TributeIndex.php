<?php

namespace App\Http\Livewire\Tribute;

use App\Models\Tribute;
use Livewire\Component;

class TributeIndex extends Component
{
    public function render()
    {
        $tributes = Tribute::query()
            ->with(['service.client','title'])
            ->withCount('installments')
            ->paginate(10);

        return view('livewire.tribute.tribute-index', compact(['tributes']));
    }
}
