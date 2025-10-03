<div class="mx-auto">
  <x-section-header header="Personal Information" icon="edit" action="editCustomer" />
  <div class="sm:flex-row items-start sm:items-center rounded-br-lg rounded-bl-lg shadow-sm p-4 mb-5 bg-white">
    <!-- Profile Photo -->
    <div class="py-2">
      <img src="{{ Storage::url($user->profile_photo_path) }}" alt="{{ $user->name }}'s Profile Photo"
        class="w-32 h-32 object-cover rounded-full border border-gray-200 shadow-sm" loading="lazy" />
    </div>
    <!-- Profile Details -->
    <div class="flex flex-col gap-6 lg:flex-row lg:items-start lg:justify-between">
      <div>
        <div class="grid grid-cols-1 gap-4 lg:grid-cols-2 lg:gap-7 2xl:gap-x-32">
          <div>
            <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">
              ID
            </p>
            <p class="text-sm font-medium text-gray-800 dark:text-white/90">
              {{$user->customer_id}}
            </p>
          </div>
          <div>
            <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">
              Status
            </p>
            <div>
              <x-status-badge :status="$user->customer->applications[0]->status" />
            </div>
          </div>
          <div>
            <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">
              Name
            </p>
            <p class="text-sm font-medium text-gray-800 dark:text-white/90">
              {{ $user->name }}
            </p>
          </div>
          <div>
            <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">
              Date of Birth
            </p>
            <p class="text-sm font-medium text-gray-800 dark:text-white/90">
              {{ $user->customer->dob ?? '-'}}
            </p>
          </div>
          <div>
            <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">
              Phone
            </p>
            <p class="text-sm font-medium text-gray-800 dark:text-white/90">
              {{ $user->customer->phone ?? '-' }}
            </p>
          </div>

          <div>
            <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">
              NRC
            </p>
            <p class="text-sm font-medium text-gray-800 dark:text-white/90">
              {{ $user->customer->nrc ?? '-'}}
            </p>
          </div>

          <div>
            <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">
              Passport
            </p>
            <p class="text-sm font-medium text-gray-800 dark:text-white/90">
              {{ $user->customer->passport ?? '-'}}
            </p>
          </div>


        </div>
      </div>
    </div>
  </div>
</div>