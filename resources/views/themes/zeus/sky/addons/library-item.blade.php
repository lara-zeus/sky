<div x-data class="space-y-4 my-6 mx-4 ">

    <x-slot name="header">
        <h2>{{ $item->title }}</h2>
    </x-slot>

    <x-slot name="breadcrumps">
        <li class="flex items-center">
            <a href="{{ route('library') }}">{{ __('library') }}</a>
            <x-iconpark-rightsmall-o class="fill-current w-4 h-4 mx-3" />
        </li>

        <li class="flex items-center">
            Viewing {{ $item->title }}
        </li>
    </x-slot>

    <x-filament::card>
        <h1>{{ $item->title }}</h1>

        <p>
            {{ $item->description }}
        </p>

        <p class="text-base font-light text-gray-500">
            <span>{{ __('created at') }}</span>:
            <span>{{ $item->created_at->format('Y.m/d') }}-{{ $item->created_at->format('h:i a') }}</span>
        </p>

        @if($item->type === 'IMAGE')
            <img class="mx-auto" src="{{ $item->theFile() }}">
        @endif

        @if($item->type === 'FILE')
            <div class="text-center">
                <x-filament::button tag="a" target="_blank" href="{{ $item->theFile() }}" class="mx-auto">
                    {{ __('Show File') }}
                </x-filament::button>
            </div>
        @endif

        @if($item->type === 'VIDEO')
            <video width="100%" class="w-full" controls>
                <source src="{{ $item->theFile() }}">
                Your browser does not support HTML video.
            </video>
        @endif
    </x-filament::card>
</div>
