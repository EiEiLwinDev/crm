<div class="flex space-x-2">
  <a wire:navigate href="{{ route('customers.view', $user->id) }}" class="text-blue-500 hover:underline">
    View
  </a>
  <a wire:navigate href="{{ route('customers.edit', $user->id) }}" class="text-indigo-500 hover:underline">
    Edit
  </a>
  <button wire:click="deleteCustomer({{ $user->id }})" class="text-red-500 hover:underline">
    Delete
  </button>
</div>