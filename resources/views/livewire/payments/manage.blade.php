 <!-- Header Section -->
 <div>
   <!-- <h2 class="text-xl font-semibold text-gray-800">Payments</h2> -->
   <h4
     class="flex justify-start items-center gap-1 text-lg font-semibold text-gray-800 dark:text-white/90 px-4 py-3 rounded-tl-lg rounded-tr-lg bg-gray-50 w-full">
     Payments
     <x-svg-icon name="add" class="w-5 h-5 text-indigo-500 cursor-pointer hover:text-indigo-800"
       wire:click="showCreateForm" />
   </h4>

   <!-- Content Section -->
   <div class="sm:flex-row items-start sm:items-center rounded-br-lg rounded-bl-lg shadow p-4 bg-white">
     <!-- Create Form -->
     @if($showCreate)
     <div>
       <livewire:payments.create :user="$user" wire:key="create-form" />
     </div>
     <!-- Edit form -->
     @elseif($showEdit)
     <div>
       <livewire:payments.edit :id="$editingPaymentId" wire:key="edit-form" />
     </div>
     @else
     <!-- Payments Table -->
     <div>
       <livewire:payments.payment-table :user="$user" wire:key="payment-table" />
     </div>
     @endif

   </div>
   <x-confirmation-modal wire:model="showDeleteModal" maxWidth="md">
     <x-slot name="title">Confirm Deletion</x-slot>
     <x-slot name="content">Are you sure you want to delete this payment?</x-slot>
     <x-slot name="footer">
       <x-secondary-button wire:click="$set('showDeleteModal', false)" class="me-2">Cancel</x-secondary-button>
       <x-danger-button wire:click="delete">Delete</x-danger-button>
     </x-slot>
   </x-confirmation-modal>
 </div>