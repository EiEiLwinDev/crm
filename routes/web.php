<?php

use App\Http\Controllers\Admin\Customer;
use App\Livewire\Customers\Create as CustomerCreate;
use App\Livewire\Customers\Update;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
 
    Route::get('/customers', [Customer::class, 'index'])->name('customers');
    Route::get('/customers/create', [Customer::class, 'create'])->name('customers.create');
    Route::get('/customers/edit/{id}', [Customer::class, 'edit'])->name('customers.edit');
    Route::get('/customers/view/{id}', [Customer::class, 'view'])->name('customers.view');
});