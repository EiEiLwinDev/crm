 <div class="flex gap-2">
   <!-- Edit Button -->
   <button wire:click="showEditForm({{ $payment->id }})" class="text-blue-600 hover:underline">
     Edit
   </button>

   <!-- Delete Button -->
   <button wire:click="deletePayment({{ $payment->id }})" class="text-red-500 hover:underline">
     Delete
   </button>
 </div>