<div x-data class="space-y-4 my-6 mx-4 ">

    <x-slot name="header">
        <h2>{{ $libraryTag->name }} </h2>
    </x-slot>

    <x-slot name="breadcrumbs">
        <li class="flex items-center">
            <a href="{{ route('library') }}">{{ __('libraries') }}</a>
            @svg('iconpark-rightsmall-o','fill-current w-4 h-4 mx-3')
        </li>

        <li class="flex items-center">
            {{ __('Viewing') }} {{ $libraryTag->name }}
        </li>
    </x-slot>

    <h1 class="text-primary-600 text-3xl font-bold">{{ $libraryTag->name }}</h1>

    @if($libraryTag->description === null)
        <p>
            {{ $libraryTag->description }}
        </p>
    @endif

    <div class="my-2 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-2">
        @foreach($libraryTag->library as $lib)
            <x-filament::section>
                <div>
                    <h2 class="text-secondary-600 text-xl font-semibold">
                        <a href="{{ route('library.item', $lib->slug) }}">
                            {{ $lib->title ?? '' }}
                        </a>
                    </h2>
                    <div class="space-y-2">
                        {{ $lib->description ?? '' }}
                    </div>
                </div>
            </x-filament::section>
        @endforeach
    </div>
</div>
