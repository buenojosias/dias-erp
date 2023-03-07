<?php

namespace App\Http\Livewire\Employee;

use App\Models\Employee;
use Livewire\Component;

class EmployeeShow extends Component
{
    public $employee;
    public $address;
    public $contact;

    public function mount(Employee $employee)
    {
        $this->employee = $employee;
        $this->address = $employee->address;
        $this->contact = $employee->contact;
    }

    public function render()
    {
        $payments = $this->employee->payments()->with('service')->paginate();
        return view('livewire.employee.employee-show', compact(['payments']));
    }
}
