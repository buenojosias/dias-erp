<?php

namespace App\Http\Livewire\Partner;

use App\Models\Partner;
use Livewire\Component;

class PartnerIndex extends Component
{
    public function render()
    {
        $partners = Partner::query()
            ->orderBy('company_name', 'asc')
            ->paginate(10);

        return view('livewire.partner.partner-index', compact(['partners']));
    }
}
