<?php
namespace App\Livewire\Customers;

use App\Models\Documents;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage; 
use Livewire\Component;
use Spatie\LivewireFilepond\WithFilePond;

class Document extends Component
{
    use WithFilePond;
    
    public $user;
    public $showModal = false;
    public $showAddModal = false;
    public $showRename = false;
    public $deleteDocumentId; 
    public $renameDocumentId;
    public $document_type;
    public $documents = [];

    public function mount($user){
        $this->user = $user; 
    }

    public function showRenameInput($documentId){
        $this->renameDocumentId = $documentId;
        $document = Documents::find($this->renameDocumentId);
        if(!$document){
            throw new Exception('Document not found', 404);
        }
        $this->document_type = $document->document_type;
        $this->showRename = !$this->showRename; 
    }

    public function renameDocument(){
        $document = Documents::find($this->renameDocumentId);
        if(!$document){
            throw new Exception('Document not found', 404);
        }
        $document->document_type = $this->document_type;
        $document->save();

        $this->showRename = false;
    }

    public function showAddDocument(){
        $this->showAddModal = !$this->showAddModal;
        $this->reset(['documents']);
    }

    public function saveDocument(){

        foreach($this->documents as $document) {
            // Store the uploaded file in the "photos" directory within the "public" disk
            $path = $document->store('documents', 'public');

            // Create a new document record
            Documents::create([
                'customer_id'   => $this->user->customer->id,
                'document_type' => $document->getClientOriginalName(),
                'file_path'     => $path,
            ]);
        }

        $this->reset(['showAddModal', 'documents']);

        // $this->deleteUploadedFiles('documents');
        
        $this->dispatch('filepondClear', 'documents');
        
        $this->dispatch('createdDocument', 'Document is created successfully.');
    }

    public function cancelAddModal(){
        $this->reset(['showAddModal']);
    }

    public function showDeleteModal($documentId){
        $this->deleteDocumentId = $documentId;
        $this->showModal = true;
    }

    public function deleteDocument()
    {
        $document = Documents::find($this->deleteDocumentId);

        if (!$document) {
            session()->flash('error', 'Document not found.');
            return;
        }

        // Delete the file from storage
        if (Storage::disk('public')->exists($document->file_path)) {
            Storage::disk('public')->delete($document->file_path);
        }

        $document->delete();

        // Refresh data
        $this->user->refresh();

        // Reset modal
        $this->reset(['showModal', 'deleteDocumentId']);

        session()->flash('success', 'Document deleted successfully.');
    }

    public function cancelDelete()
    {
        $this->reset(['showModal', 'deleteDocumentId']);
    }

    public function render()
    {
        return view('livewire.customers.document');
    }
}