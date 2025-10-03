@php
$path = Storage::url($document->file_path);
$name = $document->document_type;
$ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
$isImage = in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp']);
@endphp

<div class="relative rounded-xl border bg-white shadow-sm hover:shadow-md transition duration-200 flex flex-col">
  {{-- Preview Area --}}
  <div class="w-full h-40 rounded-t-xl bg-gray-50 flex items-center justify-center overflow-hidden">
    @if ($isImage)
    <img src="{{ $path }}" alt="{{ $name }}" class="object-cover w-full h-full" loading="lazy" />
    @elseif ($ext === 'pdf')
    <x-svg-icon name="pdf" class="w-1/2 h-full text-red-500" />
    @elseif (in_array($ext, ['doc', 'docx']))
    <x-svg-icon name="word" class="w-1/2 h-full text-blue-500" />
    @elseif (in_array($ext, ['xls', 'xlsx']))
    <x-svg-icon name="excel" class="w-1/2 h-full text-green-500" />
    @else
    <x-svg-icon name="file" class="w-12 h-12 text-gray-400" />
    @endif
  </div>

  {{-- File Info --}}
  <div class="p-3 flex-1 flex flex-col justify-between">
    @if($showRename && $document->id === $renameDocumentId)
    <div class="text-sm font-semibold text-gray-800 flex justify-start items-center gap-1">
      <x-input type="text" wire:model="document_type" wire:keyup.enter="{{ $saveAction }}"
        class="w-full border-0 border-b-1 focus:underline focus:ring-0 shadow-none p-0 m-0" />
      <x-svg-icon class="text-green-600 w-4 h-4 hover:text-green-800" name="check" wire:click="{{ $saveAction }}" />
    </div>
    @else
    <div class="text-sm font-semibold text-gray-800 truncate mb-1" title="{{ $name }}"
      wire:click="{{ $renameAction }}({{ $document->id }})">
      {{ $name }}
    </div>
    @endif

    {{-- Actions --}}
    <div class="flex justify-center items-center mt-2 text-xs text-gray-600 space-x-4">
      <a href="{{ $path }}" target="_blank"
        class="hover:text-indigo-600 transition font-medium flex items-center gap-1">
        <x-svg-icon name="open-external" class="w-4 h-4" />
      </a>

      <a href="{{ $path }}" download class="hover:text-gray-800 transition font-medium flex items-center gap-1">
        <x-svg-icon name="download" class="w-4 h-4" />
      </a>

      <button type="button" wire:click="{{ $documentAction }}({{ $document->id }})"
        class="text-red-500 hover:text-red-700 transition font-medium flex items-center gap-1">
        <x-svg-icon name="delete" class="w-4 h-4" />
      </button>

    </div>
  </div>
</div>