<?php

namespace App\Http\Livewire\Employee;

use App\Models\Employee;
use Livewire\Component;

class EmployeeShow extends Component
{
    public $employee;
    public $address;
    public $contact;
    public $paymentModal;

    protected $listeners = [
        'savedPayment',
    ];

    public function mount(Employee $employee)
    {
        $this->employee = $employee;
        $this->address = $employee->address;
        $this->contact = $employee->contact;
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
        $payments = $this->employee->payments()->with('service')->orderByDesc('date')->paginate();
        return view('livewire.employee.employee-show', compact(['payments']));
    }
}
