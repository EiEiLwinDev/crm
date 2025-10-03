@props(['id', 'maxWidth'])

@php
$id = $id ?? md5($attributes->wire('model'));

$maxWidth = [
'sm' => 'sm:max-w-sm',
'md' => 'sm:max-w-md',
'lg' => 'sm:max-w-lg',
'xl' => 'sm:max-w-xl',
'2xl' => 'sm:max-w-2xl',
][$maxWidth ?? '2xl'];
@endphp

<div class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto px-4 py-6 sm:px-0"
  x-data="{ show: @entangle($attributes->wire('model')) }" x-show="show" x-on:close.stop="show = false"
  x-on:keydown.escape.window="show = false" style="display: none;">
  <!-- Background Overlay -->
  <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" x-show="show"
    x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
    x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
    x-on:click="show = false"></div>

  <!-- Modal Panel -->
  <div class="bg-white rounded-lg shadow-xl transform transition-all sm:w-full {{ $maxWidth }} sm:mx-auto" x-show="show"
    x-trap.inert.noscroll="show" x-transition:enter="ease-out duration-300"
    x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-95">
    {{ $slot }}
  </div>
</div>