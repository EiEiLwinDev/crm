<h4
  class="flex justify-start items-center gap-1 text-lg font-semibold text-gray-800 dark:text-white/90 shadow px-4 py-3 rounded-tl-lg rounded-tr-lg bg-gray-50">
  {{ $header }}
  @if($icon && $action)
  <x-svg-icon :name="$icon" class="w-5 h-5 text-indigo-500 cursor-pointer hover:text-indigo-800"
    wire:click="{{ $action }}" />
  @endif
</h4>