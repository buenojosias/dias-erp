<?php

namespace App\Http\Livewire\Service;

use App\Models\Receipt;
use App\Models\Service;
use Livewire\Component;
use WireUi\Traits\Actions;

class ServiceReceipts extends Component
{
    use Actions;

    public $service;
    public $receipts;
    public $sgl_receipt;
    public $sum_receipts;
    public $receiptModal;

    protected $listeners = [
        'savedReceipt',
    ];

    public function mount(Service $service)
    {
        $this->service = $service;
    }

    public function openReceiptModal($receipt = null)
    {
        $this->sgl_receipt = $receipt;
        $this->receiptModal = true;
    }

    public function closingModal()
    {
        $this->reset('sgl_receipt');
    }

    public function savedReceipt($receipt)
    {
        session()->flash('success', 'Recebimento salvo com sucesso.');
        $this->receiptModal = false;
        $this->closingModal();
    }

    public function delete($receipt_id): void
    {
        $this->dialog()->confirm([
            'title'       => 'Excluir recebimento',
            'description' => 'Tem certeza que deseja excluir este lançamento?',
            'acceptLabel' => 'Confirmar',
            'rejectLabel' => 'Cancelar',
            'method'      => 'confirmDelete',
            'params'      => $receipt_id,
        ]);
    }

    public function confirmDelete($receipt_id) {
        Receipt::query()->findOrFail($receipt_id)->delete();
        session()->flash('success', 'Recebimento excluído com sucesso.');
    }

    public function render()
    {
        $this->receipts = $this->service->receipts()->orderByDesc('date')->get();
        return view('livewire.service.service-receipts');
    }
}
