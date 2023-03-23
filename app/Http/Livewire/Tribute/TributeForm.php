<?php

namespace App\Http\Livewire\Tribute;

use App\Models\Service;
use App\Models\Tribute;
use App\Models\TributeTitle;
use Livewire\Component;

class TributeForm extends Component
{
    public $action;
    public $tribute;
    public $service_id, $title_id, $date, $amount, $note;
    public $installments_count, $installments_value;
    public $services;
    public $titleModal;
    public $tform;

    public function mount($tribute = null)
    {
        if ($tribute) {
            $this->action = 'edit';
            $this->tribute = Tribute::findOrFail($tribute);
            $this->service_id = $this->tribute->service_id;
            $this->title_id = $this->tribute->title_id;
            $this->date = $this->tribute->date;
            $this->amount = $this->tribute->amount;
            $this->note = $this->tribute->note;
        } else {
            $this->action = 'create';
            $this->date = date('Y-m-d');
            $this->installments_count = 1;
            $this->services = Service::select('id', 'title', 'client_id')->with('client:id,company_name,fantasy_name')->orderBy('title', 'asc')->get();
        }
    }

    public function openTitleModal()
    {
        $this->titleModal = true;
    }

    public function submit()
    {
        $validate = $this->validate([
            'service_id' => 'required|integer',
            'title_id' => 'required|integer',
            'date' => 'required|date',
            'amount' => 'required|numeric',
            'note' => 'nullable|string',
            'installments_count' => 'required|integer',
        ]);
        $validate['amount'] = intval($this->amount * 100);
        $this->installments_value = intval($this->amount / $this->installments_count * 100);
        try {
            $tribute = Tribute::create($validate);
            for($i = 1; $i <= $this->installments_count; $i++) {
                $tribute->installments()->create([
                    'number' => $i,
                    'amount' => $this->installments_value,
                    'status' => 'Pendente',
                ]);
            }
            return redirect()->route('tributes.show', $tribute)->with('success', 'Lançamento registrado com sucesso.');
        } catch (\Throwable $th) {
            session()->flash('error', 'Ocorreu um erro ao registrar lançamento.');
            dump($th);
        }
    }

    public function submitTitle()
    {
        $validate = $this->validate([
            'tform.title' => 'required|string',
            'tform.type' => 'required|string',
        ]);
        try {
            $title = TributeTitle::create($validate['tform']);
            $this->title_id = $title->id;
            session()->flash('success', 'Título adicionado com sucesso.');
            $this->titleModal = false;
        } catch (\Throwable $th) {
            session()->flash('error', 'Erro ao adicionar título.');
            dd($th);
        }
    }

    public function render()
    {
        $titles = TributeTitle::orderBy('title', 'asc')->get();
        return view('livewire.tribute.tribute-form', compact('titles'));
    }
}
