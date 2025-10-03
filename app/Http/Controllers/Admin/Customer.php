<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class Customer extends Controller
{
    public function index()
    {
        return view('customers.index');
    }

    public function create(){
        return view('customers.create');
    }

    public function edit($id){
        $user = User::with('customer')->find($id);
        return view('customers.edit', compact('user'));
    }

    public function view($id){
        $user = User::with('customer.documents')->find($id);
        return view('customers.view', compact('user'));
    }
     
}