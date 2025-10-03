<x-app-layout>
  <x-slot name="header">
    <div class="flex justify-start items-center">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Customers') }}
      </h2>
    </div>
  </x-slot>
  <x-slot name="slot">
    <div class="mx-auto py-6 sm:px-6 lg:px-8 space-y-5">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <!-- Customer Profile - Span 1 column -->
        <div class="md:col-span-1">
          <livewire:customers.detail :user="$user" />
        </div>
        <!-- Payment Section -->
        <div class="md:col-span-2">
          <livewire:payments.manage :user="$user" />
        </div>
      </div>

      <livewire:customers.document :user="$user" />
    </div>
  </x-slot>
</x-app-layout>