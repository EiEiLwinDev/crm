<?php

namespace App\Livewire\Customers;

use App\Models\Application;
use App\Models\Customer;
use App\Models\Documents;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Spatie\LivewireFilepond\WithFilePond; 

class Create extends Component
{
    use WithFilePond;

    public $profile_photo;
    public $showModal = false;
    public $name;
    public $phone;
    public $dob;
    public $nrc;
    public $email;
    public $passport;
    public $documents = [];
   
    public function save()
    {
        $this->validate([
            'profile_photo' => 'required|mimetypes:image/jpg,image/jpeg,image/png|max:1024',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'dob' => 'required|date|before_or_equal:today',
            'nrc' => 'nullable|string|max:20',
            'passport' => 'nullable|string|max:10'
        ]);
        
        // Save image
        $profilePath = $this->profile_photo->store('photos', 'public');

        // Create User
        $user = User::create([
            'customer_id' => generateUniqueId('ZY'),
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt('password'),
            'profile_photo_path' => $profilePath
        ]);

        // Create the customer
        $customer = Customer::create([
            'passport' => $this->passport,
            'nrc' => $this->nrc,
            'dob' => $this->dob,
            'phone' => $this->phone,
            'user_id' => $user->id
        ]); 

        // create New Non-LA customer
        Application::create([
            'customer_id' => $customer->id,
            'type' => 'new_customer',
            'status' => 'new'
        ]);

        foreach($this->documents as $document) {
            // Store the uploaded file in the "photos" directory within the "public" disk
            $path = $document->store('documents', 'public');

            // Create a new document record
            Documents::create([
                'customer_id'   => $customer->id,
                'document_type' => $document->getClientOriginalName(), // Corrected this line
                'file_path'     => $path,
            ]);
        }

        // Reset the form
        $this->reset();

        // Redirect or show a success message
        $this->dispatch('customerCreated', 'Customer created successfully.');

        return $this->redirectRoute('customers');
    }

    public function cancel(){
        return $this->redirectRoute('customers');
    }

    public function render()
    {
        return view('livewire.customers.create');
    }
}