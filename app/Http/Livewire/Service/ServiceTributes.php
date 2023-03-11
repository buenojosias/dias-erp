<?php

namespace App\Http\Livewire\Service;

use App\Models\Service;
use App\Models\Tribute;
use App\Models\TributeTitle;
use Livewire\Component;

class ServiceTributes extends Component
{
    public $service;
    public $sum_tributes;
    public $tributeModal;
    public $titles;
    public $form;

    public function mount(Service $service)
    {
        $this->service = $service;
    }

    public function openTributeModal($tribute = null)
    {
        if(!$this->titles) {
            $this->titles = TributeTitle::orderBy('title','asc')->get();
        }
        // $this->form = $tribute;
        $this->form['installments_count'] = 1;
        $this->form['amount'] = '';
        $this->form['date'] = date('Y-m-d');
        $this->tributeModal = true;
    }

    public function submit()
    {
        $validate = $this->validate([
            'form.title_id' => 'required|integer',
            'form.amount' => 'required|numeric',
            'form.date' => 'required|date',
            'form.note' => 'nullable|string',
            'form.installments_count' => 'required|integer',
        ]);
        $validate['form']['amount'] = intval($this->form['amount'] * 100);
        try {
            $tribute = $this->service->tributes()->create($validate['form']);
            $installments_value = intval($validate['form']['amount'] / $this->form['installments_count']);
            for($i = 1; $i <= $this->form['installments_count']; $i++) {
                $tribute->installments()->create([
                    'number' => $i,
                    'amount' => $installments_value,
                    'status' => 'Pendente',
                ]);
            }
            session()->flash('success', 'Tributo salvo com sucesso.');
            $this->tributeModal = false;
        } catch (\Throwable $th) {
            session()->flash('error', 'Erro ao salvar tributo.');
            dd($th);
        }
    }

    public function render()
    {
        $tributes = $this->service->tributes()->with('title')->withCount('installments')->orderBy('date', 'desc')->get();
        return view('livewire.service.service-tributes', compact('tributes'));
    }
}
