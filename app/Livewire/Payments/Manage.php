<?php

namespace App\Livewire\Payments;

use App\Models\Payment;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;

class Manage extends Component
{
    public User $user;
    public $showCreate = false;
    public $showEdit = false;
    public $editingPaymentId = null;
    public $showDeleteModal = false;
    public $deletedId;

    #[On('editPayment')]
    public function editPayment($id)
    {
        $this->editingPaymentId = $id;
        $this->showEdit = true;
        $this->showCreate = false; 
    }

    #[On('deletePayment')]
    public function deletePayment($id){
        $this->deletedId = $id;
        $this->showDeleteModal = true;
    }

    #[On('finishUpdate')]
    public function update(){
        $this->reset('editingPaymentId');
        $this->showEdit = false;
        $this->showCreate = false;
    }

    public function delete(){
        $payment = Payment::find($this->deletedId);
        if(!$payment){
            throw new Exception('Payment not found', '404');
        }
        if ($payment->evidence && Storage::disk('public')->exists($payment->evidence)) {
                Storage::disk('public')->delete($payment->evidence);
            }
        $payment->delete();
        $this->reset('showDeleteModal', 'deletedId');
        $this->dispatch('updatePayment');
    }

    public function showCreateForm(){
        $this->showCreate = true;
        $this->showEdit = false; 
    }
    
    public function render()
    {
        return view('livewire.payments.manage');
    }
}