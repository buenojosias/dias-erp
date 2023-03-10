<?php

namespace App\Http\Livewire\Proposal;

use App\Models\Client;
use App\Models\Proposal;
use Carbon\Carbon;
use Livewire\Component;

class ProposalForm extends Component
{
    public $action;
    public $proposal, $client_id, $date, $amount, $status, $note;
    public $clients;

    public function mount($proposal = null)
    {
        $this->clients = Client::query()->orderBy('company_name', 'asc')->get();
        if($proposal) {
            $this->action = 'edit';
            $this->proposal = Proposal::findOrFail($proposal);
            $this->client_id = $this->proposal->client_id;
            $this->date = Carbon::parse($this->proposal->date)->format('Y-m-d');
            $this->amount = $this->proposal->amount / 100;
            $this->status = $this->proposal->status;
            $this->note = $this->proposal->note;
        } else {
            $this->action = 'create';
            $this->date = date('Y-m-d');
        }
    }

    public function submit()
    {
        $validate = $this->validate([
            'client_id' => 'required|integer',
            'date' => 'required|date',
            'amount' => 'required|numeric',
            'status' => 'required|string',
            'note' => 'nullable|string',
        ]);
        $validate['amount'] = intval($this->amount * 100);

        if($this->action === 'create') {
            try {
                $proposal = Proposal::create($validate);
                return redirect()->route('proposals.show', $proposal)->with('success', 'Orçamento salvo com sucesso.');
            } catch (\Throwable $th) {
                session()->flash('error', 'Ocorreu um erro ao salvar orçamento.');
                dd($th);
            }
        } else if($this->action === 'edit') {
            try {
                $this->proposal->update($validate);
                return redirect()->route('proposals.show', $this->proposal)->with('success', 'Orçamento atualizado com sucesso.');
            } catch (\Throwable $th) {
                session()->flash('error', 'Ocorreu um erro ao atualizar orçamento.');
                dd($th);
            }
        }
    }

    public function render()
    {
        return view('livewire.proposal.proposal-form');
    }
}
