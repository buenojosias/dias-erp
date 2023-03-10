<?php

namespace App\Http\Livewire\Service;

use App\Models\Client;
use App\Models\Service;
use Carbon\Carbon;
use Livewire\Component;

class ServiceForm extends Component
{
    public $action;
    public $service, $client_id, $title, $contract_number, $start_date, $end_date, $amount, $installments, $status, $note;
    public $clients;

    public function mount($service = null)
    {
        $this->clients = Client::query()->orderBy('company_name', 'asc')->get();
        if($service) {
            $this->action = 'edit';
            $this->service = Service::findOrFail($service);
            $this->client_id = $this->service->client_id;
            $this->title = $this->service->title;
            $this->contract_number = $this->service->contract_number;
            $this->start_date = Carbon::parse($this->service->start_date)->format('Y-m-d');
            $this->end_date = Carbon::parse($this->service->end_date)->format('Y-m-d');
            $this->amount = $this->service->amount / 100;
            $this->installments = $this->service->installments;
            $this->status = $this->service->status;
            $this->note = $this->service->note;
        } else {
            $this->action = 'create';
        }
    }

    public function submit()
    {
        $validate = $this->validate([
            'client_id' => 'required|integer',
            'title' => 'required|string|max:200',
            'contract_number' => 'nullable|string|max:12',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
            'amount' => 'required|numeric',
            'installments' => 'required|integer',
            'status' => 'required|string',
            'note' => 'nullable|string',
        ]);
        $validate['amount'] = intval($this->amount * 100);

        if($this->action === 'create') {
            try {
                $service = Service::create($validate);
                return redirect()->route('services.show', $service)->with('success', 'Obra salva com sucesso.');
            } catch (\Throwable $th) {
                session()->flash('error', 'Ocorreu um erro ao salvar obra.');
                dd($th);
            }
        } else if($this->action === 'edit') {
            try {
                $this->service->update($validate);
                return redirect()->route('services.show', $this->service)->with('success', 'Obra atualizada com sucesso.');
            } catch (\Throwable $th) {
                session()->flash('error', 'Ocorreu um erro ao atualizar obra.');
                dd($th);
            }
        }
    }

    public function render()
    {
        return view('livewire.service.service-form');
    }
}
