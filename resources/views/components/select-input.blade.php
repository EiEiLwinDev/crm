@props([
'options' => [], // Array of options [value => label]
'selected' => null, // Currently selected value
'name' => null, // Name attribute
'id' => null, // Id attribute
'placeholder' => null, // Optional placeholder like "Select an option"
'disabled' => false, // Disable select
])

<select name="{{ $name }}" id="{{ $id ?? $name }}" {{ $disabled ? 'disabled' : '' }}
  {{ $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) }}>
  @if($placeholder)
  <option value="" disabled {{ is_null($selected) ? 'selected' : '' }}>
    {{ $placeholder }}
  </option>
  @endif

  @foreach ($options as $value => $label)
  <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>
    {{ $label }}
  </option>
  @endforeach
</select>