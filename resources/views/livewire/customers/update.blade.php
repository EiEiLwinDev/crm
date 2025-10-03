<div class="mb-4">
  <!-- Modal -->
  <x-modal wire:model="showModal" maxWidth="2xl">
    <div class="p-6">
      <h2 class="text-lg font-medium text-gray-900">Update Customer Information</h2>

      <div>
        <!-- Profile photo -->
        <x-filepond::upload wire:model="profile_photo" allowImagePreview allowMultiple="false" :files="[
            [
                'source' => 'http://localhost:8000/storage/photos/pgFK0ee2D5DgRXnVlYeGTMa8wgAiudefvWhPzsd9.jpg',
                'options' => [
                  'type' => 'local'
              ]
            ]
        ]" />
      </div>
      <!-- Name -->
      <div>
        <x-label for="name" value="Name" />
        <x-input id="name" wire:model.defer="name" type="text" class="w-full" />
        <x-input-error for="name" />
      </div>

      <!-- Phone -->
      <div>
        <x-label for="phone" value="Phone" />
        <x-input id="phone" wire:model.defer="phone" type="text" class="w-full" />
        <x-input-error for="phone" />
      </div>

      <!-- Dob -->
      <div>
        <x-label for="dob" value="Date of Birth" />
        <x-input id="dob" wire:model.defer="dob" type="date" class="w-full" max="{{ now()->format('Y-m-d') }}" />
        <x-input-error for="dob" />
      </div>

      <!-- NRC -->
      <div>
        <x-label for="nrc" value="NRC" />
        <x-input id="nrc" wire:model.defer="nrc" type="text" class="w-full" />
        <x-input-error for="nrc" />
      </div>

      <!-- Email -->
      <div>
        <x-label for="email" value="Email" />
        <x-input id="email" wire:model.defer="email" type="email" class="w-full" />
        <x-input-error for="email" />
      </div>
    </div>

    <!-- Actions -->
    <div class="mt-6 flex justify-end">
      <x-secondary-button wire:click="$set('showModal', false)">
        Cancel
      </x-secondary-button>
      <x-button wire:click="save" class="ml-2">
        Save
      </x-button>
    </div>
</div>
</x-modal>
</div>