@props(['submit'])

<div {{ $attributes->merge(['class' => 'container mx-auto px-4 sm:px-6 lg:px-8 py-6']) }}>
  <x-section-title>
    <x-slot name="title">{{ $title }}</x-slot>
    <x-slot name="description">{{ $description }}</x-slot>
  </x-section-title>

  <div class="mt-5 mx-auto max-w-7xl">
    <form wire:submit="{{ $submit }}">
      <div
        class="px-4 py-5 bg-white sm:p-6 shadow {{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">
        <div class="grid grid-cols-12 gap-3">
          {{ $form }}
        </div>
      </div>

      @if (isset($actions))
      <div
        class="flex items-center justify-end px-4 py-3 bg-gray-50 text-end sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
        {{ $actions }}
      </div>
      @endif
    </form>
  </div>
</div>