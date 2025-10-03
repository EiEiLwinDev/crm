<div class="rounded-lg p-3 mb-4 w-full">
  <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <div>
      <x-label for="amount" value="Amount" />
      <x-input id="amount" wire:model.defer="amount" type="number" class="w-full" />
      <x-input-error for="amount" />
    </div>
    <div>
      <x-label for="payment_type" value="Bank/Cash" />
      <x-select-input wire:model="payment_type" :options="$payment_types" selected="bank" placeholder="payment_type"
        class="w-full" />
      <x-input-error for="payment_type" />
    </div>
    <div class="w-full">
      <x-label for="payment_date" value="Paid Date" />
      <x-input id="payment_date" wire:model.defer="payment_date" type="date" class="w-full"
        max="{{ now()->toDateString() }}" />
      <x-input-error for="payment_date" />
    </div>
  </div>
  <div class="mt-2">
    <x-label for="remark" value="Remark" />
    <textarea id="remark" wire:model.defer="remark" type="text"
      class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
      rows="3"></textarea>
    <x-input-error for="remark" />
  </div>
  <div class="mt-2">
    <x-label for="evidence" value="Evidence (Bank transfer screen shot or photo)" />
    <x-filepond::upload wire:model="evidence" allowImagePreview />
    <x-input-error for="evidence" />
  </div>
  <div class="flex justify-end space-x-2">
    <x-secondary-button wire:click="cancelEditPayment">
      Cancel
    </x-secondary-button>
    <x-button wire:click="save">
      Save
    </x-button>
  </div>
</div>