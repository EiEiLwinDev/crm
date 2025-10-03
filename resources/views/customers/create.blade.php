<x-app-layout>
  <x-slot name="header">
    <div class="flex justify-start items-center">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Customers') }}
      </h2>
    </div>
  </x-slot>
  <x-slot name="slot">
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
      <livewire:customers.create />
    </div>
  </x-slot>
</x-app-layout>