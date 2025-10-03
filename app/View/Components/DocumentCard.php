<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\View\Component;

class DocumentCard extends Component
{
    /**
     * Create a new component instance.
     */
    public $documentAction; 
    public $renameAction;
    public $document;
    public $showRename;
    public $renameDocumentId;
    public $saveAction;
    public function __construct($document, $documentAction, $renameAction, $showRename, $renameDocumentId = null, $saveAction=null)
    {

        $this->document = $document;
        $this->documentAction = $documentAction;
        $this->renameAction = $renameAction;
        $this->showRename = $showRename;
        $this->renameDocumentId = $renameDocumentId;
        $this->saveAction = $saveAction;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.document-card');
    }
}