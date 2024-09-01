@props(['active', 'dropdownItems' => []])

@php
    $classes =
        $active ?? false
            ? 'inline-flex items-center px-1 pt-6 text-sm font-medium leading-5 text-gray-900 dark:text-gray-100 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-6 text-sm font-medium leading-5 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700 focus:outline-none focus:text-gray-700 dark:focus:text-gray-300 focus:border-gray-300 dark:focus:border-gray-700 transition duration-150 ease-in-out';
@endphp

<div class="dropdown dropdown-hover relative">
    <a {{ $attributes->merge(['class' => $classes]) }} role="button" tabindex="0">
        {{ $slot }}
        <svg class="ml-2 w-4 h-4 fill-current" viewBox="0 0 20 20">
            <path
                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
        </svg>
    </a>
    @if (count($dropdownItems))
        <ul tabindex="0" class="dropdown-content menu bg-base-100 rounded-box z-[1] w-52 p-2 shadow absolute mt-2">
            @foreach ($dropdownItems as $item)
                <li><a href="{{ $item['href'] }}">{{ $item['label'] }}</a></li>
            @endforeach
        </ul>
    @endif
</div>
