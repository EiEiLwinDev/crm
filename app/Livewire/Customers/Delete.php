<?php

namespace App\Livewire\Customers;

use App\Models\User; 
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Component;

class Delete extends Component
{
    public $showModal = false; 
    public $user;
 
    #[On('deleteCustomer')]
    public function loadUser($userId)
    {
        $user = User::find($userId);

        if(!$user){
            throw new \Exception("User not found");
        }
        $this->user = $user;
        $this->showModal = true;
    }


    public function delete()
    {   
        $user = User::find($this->user->id);

        if(!$user){
            throw new \Exception("User not found");
        }
        $user->delete();
        
        $this->showModal = false;
        $this->reset('user');
        $this->dispatch('customerDeleted', 'Customer deleted successfully.');
    }

    public function render()
    {
        return view('livewire.customers.delete');
    }
}