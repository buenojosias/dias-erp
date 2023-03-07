<?php

namespace App\Http\Livewire\Supplier;

use App\Models\Supplier;
use Livewire\Component;

class SupplierShow extends Component
{
    public $supplier;
    public $address;
    public $contact;

    public function mount(Supplier $supplier)
    {
        $this->supplier = $supplier;
        $this->address = $supplier->address;
        $this->contact = $supplier->contact;
    }

    public function render()
    {
        $purchases = $this->supplier->purchases()->with('service.client')->paginate();
        return view('livewire.supplier.supplier-show', compact(['purchases']));
    }
}
