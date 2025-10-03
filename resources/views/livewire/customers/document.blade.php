<div class="mx-auto">
  <x-section-header header="Documents" icon="clip" action="showAddDocument" />

  <div class="rounded-br-lg rounded-bl-lg shadow-sm p-4 mb-5 bg-white">
    <!-- Add Document Modal -->
    @if($showAddModal)
    <div class="rounded-lg p-3 mb-4 w-full">
      <x-filepond::upload wire:model="documents" allowImagePreview allowMultiple="true" />
      <x-input-error for="documents" />
      <div class="flex justify-end space-x-2">
        <x-secondary-button wire:click="cancelAddModal">
          Cancel
        </x-secondary-button>
        <x-button wire:click="saveDocument">
          Save
        </x-button>
      </div>
    </div>
    @else
    @if($user?->customer?->documents && $user?->customer?->documents->count())
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
      @foreach($user->customer->documents as $document)
      <x-document-card :document="$document" document-action="showDeleteModal" rename-action="showRenameInput"
        :showRename="$showRename" :renameDocumentId="$renameDocumentId" save-action="renameDocument" />
      @endforeach
    </div>
    @else
    <p class="text-gray-500 text-sm">No documents available.</p>
    @endif
    @endif
  </div>

  {{-- Confirmation Modal --}}
  <x-confirmation-modal wire:model="showModal" maxWidth="md">
    <x-slot name="title">Confirm Deletion</x-slot>
    <x-slot name="content">
      Are you sure you want to delete this document?
    </x-slot>
    <x-slot name="footer">
      <x-secondary-button wire:click="cancelDelete" class="me-2">Cancel</x-secondary-button>
      <x-danger-button wire:click="deleteDocument">Delete</x-danger-button>
    </x-slot>
  </x-confirmation-modal>
</div>
</div>