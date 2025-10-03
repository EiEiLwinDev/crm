<?php

namespace App\Livewire\Payments;

use App\Models\Payment;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Component;

class Delete extends Component
{
    public $showModal;
    public $paymentId;

    #[On('deletePaymentModal')]
    public function loadPayment($paymentId){
        $this->paymentId = $paymentId;
        $this->showModal = true;
    }

    public function delete($id){
        $this->reset('showModal'); 
    }

    public function render()
    {
        return view('livewire.payments.delete');
    }
}