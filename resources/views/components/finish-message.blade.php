@props([
'on' => null, // Livewire event name (optional)
'type' => 'success', // success | error | info | warning
])

@php
$colors = [
'success' => 'bg-green-100 text-green-800 border-green-300',
'error' => 'bg-red-100 text-red-800 border-red-300',
'info' => 'bg-blue-100 text-blue-800 border-blue-300',
'warning' => 'bg-yellow-100 text-yellow-800 border-yellow-300',
];
@endphp

<div x-data="{ show: false, message: '{{ session('message') ?? '' }}', timeout: null }" x-init="
        if (message) {
            show = true;
            timeout = setTimeout(() => show = false, 3000);
        }

        @if ($on)
            Livewire.on('{{ $on }}', msg => {
                clearTimeout(timeout);
                message = msg || 'Success';
                show = true;
                timeout = setTimeout(() => show = false, 3000);
            });
        @endif
    " x-show="show" x-transition style="display: none;"
  class="fixed top-5 right-5 max-w-sm w-full border px-4 py-3 rounded shadow {{ $colors[$type] }} z-[9999]" role="alert"
  role="alert">
  <div x-text="message"></div>
</div>