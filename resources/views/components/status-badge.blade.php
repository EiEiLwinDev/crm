@props(['status' => 'new'])

@php
$colors = [
'new' => 'bg-gray-200 text-gray-800',
'namelist' => 'bg-blue-100 text-blue-800',
'medical_checkup' => 'bg-purple-100 text-purple-800',
'buy_insurance' => 'bg-yellow-100 text-yellow-800',
'wp_fee' => 'bg-green-100 text-green-800',
'bt50' => 'bg-pink-100 text-pink-800',
'wp_permit' => 'bg-indigo-100 text-indigo-800',
];

$class = $colors[$status] ?? 'bg-gray-100 text-gray-700';

$label = ucwords(str_replace('_', ' ', $status));
@endphp

<span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold {{ $class }}">
  {{ $label }}
</span>