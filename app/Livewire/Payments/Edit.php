<?php

namespace App\Livewire\Payments;

use App\Models\Payment;
use Error;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage; 
use Livewire\Component;
use Spatie\LivewireFilepond\WithFilePond;

class Edit extends Component
{
    use WithFilePond;
    
    public $paymentId;
    public $amount;
    public $payment_date;
    public $payment_type;
    public $remark;
    public $evidence; 
    
    public $payment_types = [
        'bank' => 'Bank',
        'cash' => 'Cash',
    ];

    public function mount($id){
        $payment = Payment::find($id);
        
        if(!$payment){
            throw new Error('Payment not found', 404);
        }
        if($payment->evidence){
            $this->evidence = Storage::url($payment->evidence);
        }
        $this->paymentId = $payment->id;
        $this->amount = $payment->amount;
        $this->payment_date = $payment->payment_date;
        $this->payment_type = $payment->payment_type;
        $this->remark = $payment->remark;
        
    }

    public function cancelEditPayment(){
        Log::info('cancle form');
       $this->dispatch('finishUpdate');
    }
    
    public function save(){
        
        $this->validate([
            'amount' => 'required|numeric',
            'payment_type' => 'required',
            'payment_date' => 'required|date|before_or_equal:today'
        ]);
        
        $payment = Payment::find($this->paymentId);
        
        if(!$payment){
            throw new Exception('Payment not found', 404);
        }

        $updateData = [
            'amount' => $this->amount,
            'payment_date' => $this->payment_date,
            'payment_type' => $this->payment_type,
            'remark' => $this->remark
        ];
        
        if($this->evidence && $this->evidence instanceof UploadedFile){
            if ($payment->evidence && Storage::disk('public')->exists($payment->evidence)) {
                Storage::disk('public')->delete($payment->evidence);
            }
            $path = $this->evidence->store('evidences', 'public');
            $updateData['evidence'] = $path;
        } 
        
        $payment->update($updateData);
        $this->dispatch('finishUpdate');
    }

    public function render()
    {
        return view('livewire.payments.edit');
    }
}