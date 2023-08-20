@props(['disabled' => false, 'invalid' => false])

@php
    $classes = 'form-control';
    if ($invalid) {
        $classes .= ' is-invalid';
    }
@endphp

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => $classes]) !!}>
