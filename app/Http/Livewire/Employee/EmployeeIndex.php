<?php

namespace App\Http\Livewire\Employee;

use App\Models\Employee;
use Livewire\Component;

class EmployeeIndex extends Component
{
    public function render()
    {
        $employees = Employee::query()
            ->orderBy('name', 'asc')
            ->paginate(10);

        return view('livewire.employee.employee-index', compact(['employees']));
    }
}
