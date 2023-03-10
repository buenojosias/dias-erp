<?php

namespace App\Http\Livewire\Employee;

use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class EmployeeForm extends Component
{
    public $action;
    public $employee;
    public $name, $cpf, $rg, $birthday, $role;
    public $address, $street_name, $number, $complement, $district, $zip_code, $city, $state = 'PR';
    public $contact, $phone, $whatsapp, $email;

    public function mount($employee = null)
    {
        if ($employee) {
            $this->action = 'edit';
            $this->employee = Employee::findOrFail($employee);
            $this->name = $this->employee->name;
            $this->cpf = $this->employee->cpf;
            $this->rg = $this->employee->rg;
            $this->birthday = Carbon::parse($this->employee->birthday)->format('Y-m-d');
            $this->role = $this->employee->role;

            $this->address = $this->employee->address;
            $this->street_name = $this->address->street_name;
            $this->number = $this->address->number;
            $this->complement = $this->address->complement;
            $this->district = $this->address->district;
            $this->zip_code = $this->address->zip_code;
            $this->city = $this->address->city;
            $this->state = $this->address->state;

            $this->contact = $this->employee->contact;
            $this->phone = $this->contact->phone;
            $this->whatsapp = $this->contact->whatsapp;
            $this->email = $this->contact->email;
        } else {
            $this->action = 'create';
        }
    }

    public function submit()
    {
        $validateEmployee = $this->validate([
            'name' => 'required|string|max:120',
            'cpf' => 'required|string|size:11',
            'rg' => 'nullable|string|max:20',
            'birthday' => 'required|date',
            'role' => 'required|string|max:100',
        ]);
        $validateAddress = $this->validate([
            'street_name' => 'required|string|max:100',
            'number' => 'required|string|max:10',
            'complement' => 'nullable|string|max:30',
            'district' => 'required|string|max:50',
            'zip_code' => 'nullable|string|min:9|max:9',
            'city' => 'required|string|max:50',
            'state' => 'required|string|min:2|max:2',
        ]);
        $validateContact = $this->validate([
            'phone' => 'nullable|string|min:14|max:15',
            'whatsapp' => 'nullable|string|min:14|max:15',
            'email' => 'nullable|email',
        ]);

        if ($this->action === 'create') {
            DB::beginTransaction();
            try {
                $employee = Employee::create($validateEmployee);
                $address = $employee->address()->create($validateAddress);
                $contact = $employee->contact()->create($validateContact);
            } catch (\Throwable $th) {
                session()->flash('error', 'Ocorreu um erro ao cadastrar funcionário.');
                dd($th);
            }
            if ($employee && $address && $contact) {
                DB::commit();
                return redirect()->route('employees.show', $employee)->with('success', 'Funcionário cadastrado com sucesso.');
            } else {
                DB::rollback();
                session()->flash('error', 'Ocorreu um erro ao cadastrar funcionário.');
            }
        } else if ($this->action === 'edit') {
            try {
                $this->employee->update($validateEmployee);
                $this->address->update($validateAddress);
                $this->contact->update($validateContact);
                return redirect()->route('employees.show', $this->employee)->with('success', 'Funcionário atualizado com sucesso.');
            } catch (\Throwable $th) {
                session()->flash('error', 'Ocorreu um erro ao atualizar funcionário.');
                dd($th);
            }
        }
    }

    public function render()
    {
        return view('livewire.employee.employee-form');
    }
}
