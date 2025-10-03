<?php

namespace App\Livewire\Customers;

use App\Models\Application;
use App\Models\Customer;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Spatie\LivewireFilepond\WithFilePond;

class Edit extends Component
{ 

   use WithFilePond;
   
    public $name;
    public $phone;
    public $dob;
    public $nrc;
    public $passport;
    public $email;
    public $customerId; 
    public $user;
    public $status;
    public $application;

    public $previousUrl;
    
    public $statuses = ['new' => 'New Customer', 'namelist' => 'Name List', 'medical_checkup' => 'Medical Check', 'buy_insurance' => 'Buy Insurance', 'wp_fee' => 'WP Fee', 'bt50' => 'BT-50', 'wp_permit', 'WP Permit'];
    
    public $profile_photo;
     
    public function mount($user){
        $this->previousUrl = url()->previous() !== url()->current() ? url()->previous() : 'customers';
        $this->user = $user;
        $this->customerId = $user->customer->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->customer->phone ?? '';
        $this->dob = $user->customer->dob ?? '';
        $this->nrc = $user->customer->nrc ?? ''; 
        $this->passport = $user->customer->passport ?? '';

        $applications = $user->customer->applications;

        $this->application = $applications->firstWhere('type', 'new_customer');

        $this->status = $this->application->status;
        
        if($user->profile_photo_path){
            $this->profile_photo = Storage::url($user->profile_photo_path);
        }
         
    }

    public function cancel(){
        return redirect($this->previousUrl);
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string',
            'dob' => 'required|date|before_or_equal:today',
            'nrc' => 'nullable|string|max:20',
            'passport' => 'nullable|string|max:10',
            'status' => 'required',
        ]);
        
        $updateData = [
            'name' => $this->name,
            'email' => $this->email
        ];

        // update photo path
        if ($this->profile_photo && is_object($this->profile_photo)) {
            if ($this->user->profile_photo_path && Storage::disk('public')->exists($this->user->profile_photo_path)) {
                Storage::disk('public')->delete($this->user->profile_photo_path);
            }

            $profilePath = $this->profile_photo->store('photos', 'public');
            $updateData['profile_photo_path'] = $profilePath;
        }

        // Update User
        $this->user->update($updateData);

        // Update the customer
        $customer = Customer::find($this->customerId);

        if(!$customer){
            throw new \Exception("Customer not found");
        }
        
        $customer->update([
            'nrc' => $this->nrc,
            'passport' => $this->passport,
            'dob' => $this->dob,
            'phone' => $this->phone
        ]);

        $updateApplication = Application::find($this->application->id);
        
        $updateApplication->status = $this->status;
        $updateApplication->save();

        // Redirect or show a success message
        return redirect($this->previousUrl);
    }
    
    public function render()
    {
        return view('livewire.customers.edit');
    }
}