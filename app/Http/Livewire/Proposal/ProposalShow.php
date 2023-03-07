<?php

namespace App\Http\Livewire\Proposal;

use App\Models\Proposal;
use Livewire\Component;

class ProposalShow extends Component
{
    public $proposal;
    public $client;

    public function mount(Proposal $proposal)
    {
        $this->proposal = $proposal;
        $this->client = $proposal->client;
    }

    public function render()
    {
        return view('livewire.proposal.proposal-show');
    }
}
