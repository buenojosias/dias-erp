<?php

namespace App\Http\Livewire\Partner;

use App\Models\Partner;
use Livewire\Component;

class PartnerShow extends Component
{
    public $partner;
    public $address;
    public $contact;
    public $paymentModal;

    protected $listeners = [
        'savedPayment',
    ];

    public function mount(Partner $partner)
    {
        $this->partner = $partner;
        $this->address = $partner->address;
        $this->contact = $partner->contact;
    }

    public function openPaymentModal()
    {
        $this->paymentModal = true;
    }

    public function savedPayment($payment)
    {
        session()->flash('success', 'Pagamento registrado com sucesso.');
        $this->paymentModal = false;
    }

    public function render()
    {
        $payments = $this->partner->payments()->with('service')->orderByDesc('date')->paginate();
        return view('livewire.partner.partner-show', compact(['payments']));
    }
}
