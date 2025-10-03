<?php

namespace App\Livewire\Payments;

use App\Models\Payment;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Spatie\LivewireFilepond\WithFilePond;

class Create extends Component
{
    use WithFilePond;
    public $amount;
    public $payment_date;
    public $payment_type = 'bank';
    public $remark;
    public $evidence;
    public $user;
    public $application;

    public $payment_types = [
        'bank' => 'Bank',
        'cash' => 'Cash',
    ];

    public function mount($user)
    {
        $this->user = $user;

        $this->application = $this->user->customer->applications->firstWhere('type', 'new_customer');
    }

    public function cancelAddPayment(){
        $this->dispatch('finishUpdate');
    }

    public function save(){
        $this->validate([
            'amount' => 'required|numeric',
            'payment_type' => 'required',
            'payment_date' => 'required|date|before_or_equal:today'
        ]);

        if($this->evidence){
            $path = $this->evidence->store('evidences', 'public');
        }else{
            $path = null;
        }
        Payment::create([
            'amount' => $this->amount,
            'payment_date' => $this->payment_date,
            'payment_type' => $this->payment_type,
            'remark' => $this->remark,
            'evidence' => $path, 
            'application_id' => $this->application->id, 
        ]);

        $this->dispatch('finishUpdate');
    }

    public function render()
    {
        return view('livewire.payments.create');
    }
}