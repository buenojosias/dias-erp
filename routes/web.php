<?php

use App\Http\Controllers\ProfileController;
use App\Http\Livewire\Client\{ClientIndex, ClientShow};
use App\Http\Livewire\Employee\{EmployeeIndex, EmployeeShow};
use App\Http\Livewire\Partner\{PartnerIndex, PartnerShow};
use App\Http\Livewire\Proposal\{ProposalIndex, ProposalShow};
use App\Http\Livewire\Purchase\{PurchaseIndex, PurchaseShow};
use App\Http\Livewire\Service\{ServiceIndex, ServiceShow, ServicePurchases, ServiceReceipts, ServicePayments, ServiceTributes};
use App\Http\Livewire\Supplier\{SupplierIndex, SupplierShow};
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

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/clientes', ClientIndex::class)->name('clients.index');
    Route::get('/clientes/{client}', ClientShow::class)->name('clients.show');

    Route::get('/fornecedores', SupplierIndex::class)->name('suppliers.index');
    Route::get('/fornecedores/{supplier}', SupplierShow::class)->name('suppliers.show');

    Route::get('/funcionarios', EmployeeIndex::class)->name('employees.index');
    Route::get('/funcionarios/{employee}', EmployeeShow::class)->name('employees.show');

    Route::get('/prestadores', PartnerIndex::class)->name('partners.index');
    Route::get('/prestadores/{partner}', PartnerShow::class)->name('partners.show');

    Route::get('/propostas', ProposalIndex::class)->name('proposals.index');
    Route::get('/propostas/{proposal}', ProposalShow::class)->name('proposals.show');

    Route::get('/obras', ServiceIndex::class)->name('services.index');
    Route::get('/obras/{service}', ServiceShow::class)->name('services.show');
    Route::get('/obras/{service}/compras', ServicePurchases::class)->name('services.purchases');
    Route::get('/obras/{service}/recebimentos', ServiceReceipts::class)->name('services.receipts');
    Route::get('/obras/{service}/pagamentos', ServicePayments::class)->name('services.payments');
    Route::get('/obras/{service}/tributos', ServiceTributes::class)->name('services.tributes');

    Route::get('/compras', PurchaseIndex::class)->name('purchases.index');
    Route::get('/compras/{purchase}', PurchaseShow::class)->name('purchases.show');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
