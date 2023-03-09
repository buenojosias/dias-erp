<?php

namespace App\Http\Livewire\Installment;

use App\Models\Installment;
use Livewire\Component;

class InstallmentIndex extends Component
{
    public function render()
    {
        $installments = Installment::query()
            ->with('purchase.service')
            ->whereIn('status', ['Pendente','Atrasada'])
            ->orderBy('expiration_date', 'asc')
            ->paginate();

        return view('livewire.installment.installment-index', compact(['installments']));
    }
}
