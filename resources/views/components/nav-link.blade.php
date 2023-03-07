@props(['active'])

@php
$classes = ($active ?? false)
            ? 'my-1.5 text-base text-gray-900 font-normal rounded bg-slate-200 hover:bg-gray-300 group transition duration-75 flex items-center p-2'
            : 'my-1.5 text-base text-gray-900 font-normal rounded hover:bg-gray-100 group transition duration-75 flex items-center p-2';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
