<?php

namespace App\Livewire\Customers;

use Livewire\Component;

class Detail extends Component
{
    public $user;
    
    public function mount($user){
        $this->user = $user;
    }

    public function editCustomer(){
        return redirect()->route('customers.edit', ['id' => $this->user->id]);
    }

    public function render()
    {
        return view('livewire.customers.detail');
    }
}