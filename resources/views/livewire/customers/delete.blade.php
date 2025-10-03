<x-confirmation-modal wire:model="showModal" maxWidth="md">
  <x-slot name="title">Confirm Deletion</x-slot>
  <x-slot name="content">Are you sure you want to delete this customer?</x-slot>
  <x-slot name="footer">
    <x-secondary-button wire:click="$set('showModal', false)" class="me-2">Cancel</x-secondary-button>
    <x-danger-button wire:click="delete">Delete</x-danger-button>
  </x-slot>
</x-confirmation-modal>