<?php

namespace App\Http\Livewire\Rent;

use App\Models\Rent;
use App\Models\Renter;
use App\Models\Service;
use Livewire\Component;

class RentForm extends Component
{
    public $action;
    public $rent;
    public $service_id, $renter_id, $date, $item, $amount, $note;
    public $services;
    public $renters;

    public function mount($rent = null)
    {
        if ($rent) {
            $this->action = 'edit';
            $this->rent = Rent::findOrFail($rent);
            $this->service_id = $this->rent->service_id;
            $this->renter_id = $this->rent->renter_id;
            $this->date = $this->rent->date;
            $this->item = $this->rent->item;
            $this->amount = $this->rent->amount / 100;
            $this->note = $this->rent->note;
        } else {
            $this->action = 'create';
            $this->date = date('Y-m-d');
        }
        $this->renters = Renter::select('id', 'fantasy_name')->orderBy('fantasy_name', 'asc')->get();
        $this->services = Service::select('id', 'title', 'client_id')->with('client:id,company_name,fantasy_name')->orderBy('title', 'asc')->get();
    }

    public function submit()
    {
        $validate = $this->validate([
            'service_id' => 'required|integer',
            'renter_id' => 'required|integer',
            'date' => 'required|date',
            'item' => 'required|string',
            'amount' => 'required|numeric',
            'note' => 'nullable|string',
        ]);
        $validate['amount'] = intval($this->amount * 100);

        try {
            $rent = Rent::updateOrCreate(['id' => $this->rent->id ?? null], $validate);
            return redirect()->route('rents.show', $rent)->with('success', 'Locação cadastrada com sucesso.');
        } catch (\Throwable $th) {
            session()->flash('error', 'Ocorreu um erro ao cadastrar locação.');
            dump($th);
        }
    }

    public function render()
    {
        return view('livewire.rent.rent-form');
    }
}
