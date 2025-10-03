<div class="mx-auto px-4 sm:px-6 lg:px-8 h-vh">
  <x-title title="Create New Customer" :backUrl="route('customers')" />
  <div class="mt-0 mx-auto">
    <form wire:submit="save">
      <div class="px-4 py-5 bg-white sm:p-6 shadow overflow-y-auto">
        <div class="grid grid-cols-1 gap-3">
          <div class="w-full sm:w-1/2">
            <x-filepond::upload wire:model="profile_photo" allowImagePreview allowMultiple="false"
              placeholder="Drop photo or " />
            <x-input-error for="profile_photo" />
          </div>
          <!-- name -->
          <div class="mt-2">
            <x-label for="name" value="Name" />
            <x-input id="name" wire:model.defer="name" type="text" class="w-full" />
            <x-input-error for="name" />
          </div>

          <!-- Phone -->
          <div class="mt-2">
            <x-label for="phone" value="Phone" />
            <x-input id="phone" wire:model.defer="phone" type="text" class="w-full" />
            <x-input-error for="phone" />
          </div>

          <!-- Dob -->
          <div class="mt-2">
            <x-label for="dob" value="Date of Birth" />
            <x-input id="dob" wire:model.defer="dob" type="date" class="w-full" max="{{ now()->format('Y-m-d') }}" />
            <x-input-error for="dob" />
          </div>

          <!-- NRC -->
          <div class="mt-2">
            <x-label for="nrc" value="NRC" />
            <x-input id="nrc" wire:model.defer="nrc" type="text" class="w-full" />
            <x-input-error for="nrc" />
          </div>
          <!-- Passport -->
          <div class="mt-2">
            <x-label for="passport" value="Passport" />
            <x-input id="passport" wire:model.defer="passport" type="text" class="w-full" />
            <x-input-error for="passport" />
          </div>

          <!-- Email -->
          <div class="mt-2">
            <x-label for="email" value="Email" />
            <x-input id="email" wire:model.defer="email" type="email" class="w-full" />
            <x-input-error for="email" />
          </div>
        </div>
        <div class="mt-2">
          <x-label for="documents" value="Attached Documents" />
          <x-filepond::upload wire:model="documents" allowImagePreview allowMultiple="true" />
          <x-input-error for="documents" />
        </div>

      </div>
      <!-- actions -->
      <div
        class="flex items-center justify-end px-4 py-3 bg-gray-50 text-end sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
        <x-secondary-button wire:click="cancel">
          Cancel
        </x-secondary-button>
        <x-button type="submit" class="ml-2">
          Save
        </x-button>
      </div>
    </form>
  </div>
</div>