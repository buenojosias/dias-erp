<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Livewire\Client\{ClientIndex, ClientShow, ClientForm};
use App\Http\Livewire\Employee\{EmployeeIndex, EmployeeShow, EmployeeForm};
use App\Http\Livewire\Installment\{InstallmentIndex};
use App\Http\Livewire\Partner\{PartnerIndex, PartnerShow, PartnerForm};
use App\Http\Livewire\Proposal\{ProposalIndex, ProposalShow, ProposalForm};
use App\Http\Livewire\Purchase\{PurchaseIndex, PurchaseShow, PurchaseForm};
use App\Http\Livewire\Rent\{RentIndex, RentShow, RentForm};
use App\Http\Livewire\Service\{ServiceIndex, ServiceShow, ServiceForm, ServicePurchases, ServiceRents, ServiceReceipts, ServicePayments, ServiceTributes};
use App\Http\Livewire\Supplier\{SupplierIndex, SupplierShow, SupplierForm};
use App\Http\Livewire\Renter\{RenterIndex, RenterShow, RenterForm};
use App\Http\Livewire\Tribute\{TributeIndex, TributeShow};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', DashboardController::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/clientes', ClientIndex::class)->name('clients.index');
    Route::get('/clientes/novo', ClientForm::class)->name('clients.create');
    Route::get('/clientes/{client}', ClientShow::class)->name('clients.show');
    Route::get('/clientes/{client}/editar', ClientForm::class)->name('clients.edit');

    Route::get('/fornecedores', SupplierIndex::class)->name('suppliers.index');
    Route::get('/fornecedores/novo', SupplierForm::class)->name('suppliers.create');
    Route::get('/fornecedores/{supplier}', SupplierShow::class)->name('suppliers.show');
    Route::get('/fornecedores/{supplier}/editar', SupplierForm::class)->name('suppliers.edit');

    Route::get('/funcionarios', EmployeeIndex::class)->name('employees.index');
    Route::get('/funcionarios/novo', EmployeeForm::class)->name('employees.create');
    Route::get('/funcionarios/{employee}', EmployeeShow::class)->name('employees.show');
    Route::get('/funcionarios/{employee}/editar', EmployeeForm::class)->name('employees.edit');

    Route::get('/prestadores', PartnerIndex::class)->name('partners.index');
    Route::get('/prestadores/novo', PartnerForm::class)->name('partners.create');
    Route::get('/prestadores/{partner}', PartnerShow::class)->name('partners.show');
    Route::get('/prestadores/{partner}/editar', PartnerForm::class)->name('partners.edit');

    Route::get('/locatarios', RenterIndex::class)->name('renters.index');
    Route::get('/locatarios/novo', RenterForm::class)->name('renters.create');
    Route::get('/locatarios/{renter}', RenterShow::class)->name('renters.show');
    Route::get('/locatarios/{renter}/editar', RenterForm::class)->name('renters.edit');

    Route::get('/orcamentos', ProposalIndex::class)->name('proposals.index');
    Route::get('/orcamentos/novo', ProposalForm::class)->name('proposals.create');
    Route::get('/orcamentos/{proposal}', ProposalShow::class)->name('proposals.show');
    Route::get('/orcamentos/{proposal}/editar', ProposalForm::class)->name('proposals.edit');

    Route::get('/obras', ServiceIndex::class)->name('services.index');
    Route::get('/obras/nova', ServiceForm::class)->name('services.create');
    Route::get('/obras/{service}', ServiceShow::class)->name('services.show');
    Route::get('/obras/{service}/editar', ServiceForm::class)->name('services.edit');
    Route::get('/obras/{service}/compras', ServicePurchases::class)->name('services.purchases');
    Route::get('/obras/{service}/locacoes', ServiceRents::class)->name('services.rents');
    Route::get('/obras/{service}/recebimentos', ServiceReceipts::class)->name('services.receipts');
    Route::get('/obras/{service}/pagamentos', ServicePayments::class)->name('services.payments');
    Route::get('/obras/{service}/tributos', ServiceTributes::class)->name('services.tributes');

    Route::get('/compras', PurchaseIndex::class)->name('purchases.index');
    Route::get('/compras/nova', PurchaseForm::class)->name('purchases.create');
    Route::get('/compras/{purchase}', PurchaseShow::class)->name('purchases.show');
    Route::get('/compras/{purchase}/editar', PurchaseForm::class)->name('purchases.edit');

    Route::get('/locacoes', RentIndex::class)->name('rents.index');
    Route::get('/locacoes/nova', RentForm::class)->name('rents.create');
    Route::get('/locacoes/{rent}', RentShow::class)->name('rents.show');
    Route::get('/locacoes/{rent}/editar', RentForm::class)->name('rents.edit');

    Route::get('/tributos', TributeIndex::class)->name('tributes.index');
    Route::get('/tributos/{tribute}', TributeShow::class)->name('tributes.show');

    Route::get('/parcelamentos', InstallmentIndex::class)->name('installments.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
