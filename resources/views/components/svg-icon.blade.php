@php
$svg = config("icons.{$name}");
@endphp

@if ($svg)
{!! str_replace('<svg', '<svg ' . $attributes, $svg) !!} @endif