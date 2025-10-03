<x-app-layout>
  <x-slot name="header">
    <div class="flex justify-between items-center">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Customers') }}
      </h2>
      <!-- <x-button>{{_('Create Customer')}}</x-button> -->
      <x-link-button :href="route('customers.create')">
        {{_('Create Customer')}}
      </x-link-button>

    </div>

  </x-slot>
  <x-slot name="slot">
    <div class="mx-auto py-6 sm:px-6 lg:px-8">
      <livewire:customers.table />
      <livewire:customers.delete />
    </div>
  </x-slot>
</x-app-layout>