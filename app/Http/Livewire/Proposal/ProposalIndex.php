<?php

namespace App\Http\Livewire\Proposal;

use App\Models\Proposal;
use Livewire\Component;

class ProposalIndex extends Component
{
    public function render()
    {
        $proposals = Proposal::query()
            ->with('client')
            ->paginate();

        return view('livewire.proposal.proposal-index', compact(['proposals']));
    }
}
