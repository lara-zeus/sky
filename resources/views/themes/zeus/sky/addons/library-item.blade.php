<div x-data class="space-y-4 my-6 mx-4 ">

    <x-slot name="header">
        <h2>{{ $item->title }}</h2>
    </x-slot>

    <x-slot name="breadcrumbs">
        <li class="flex items-center">
            <a href="{{ route('library') }}">{{ __('libraries') }}</a>
            @svg('iconpark-rightsmall-o','fill-current w-4 h-4 mx-3')
        </li>

        <li class="flex items-center">
            {{ __('Viewing') }} {{ $item->title }}
        </li>
    </x-slot>

    <x-filament::section>
        <h1>{{ $item->title }}</h1>

        <p>
            {{ $item->description }}
        </p>

        <p class="text-base font-light text-gray-500">
            <span>{{ __('created at') }}</span>:
            <span>{{ $item->created_at->format('Y.m/d') }}-{{ $item->created_at->format('h:i a') }}</span>
        </p>

        <div class="grid grid-cols-1 @if($item->getFiles()->count() > 1) sm:grid-cols-2 lg:grid-cols-3 @endif gap-2 justify-items-stretch content-stretch">
            @foreach($item->getFiles() as $file)
                @include($skyTheme.'.addons.library-types.'.strtolower($item->type))
            @endforeach
        </div>
    </x-filament::section>
</div>
