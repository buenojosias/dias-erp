<?php

use App\Http\Controllers\ProfileController;
use App\Http\Livewire\Client\{ClientIndex};
use App\Http\Livewire\Employee\{EmployeeIndex};
use App\Http\Livewire\Partner\{PartnerIndex};
use App\Http\Livewire\Proposal\{ProposalIndex};
use App\Http\Livewire\Purchase\{PurchaseIndex};
use App\Http\Livewire\Service\{ServiceIndex};
use App\Http\Livewire\Supplier\{SupplierIndex};
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

    Route::get('/fornecedores', SupplierIndex::class)->name('suppliers.index');

    Route::get('/funcionarios', EmployeeIndex::class)->name('employees.index');

    Route::get('/prestadores', PartnerIndex::class)->name('partners.index');

    Route::get('/propostas', ProposalIndex::class)->name('proposals.index');

    Route::get('/obras', ServiceIndex::class)->name('services.index');

    Route::get('/compras', PurchaseIndex::class)->name('purchase.index');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
