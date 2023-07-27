<div x-data class="space-y-4 my-6 mx-4 ">

    <x-slot name="header">
        <h2>{{ $libraryTag->title }}</h2>
    </x-slot>

    <x-slot name="breadcrumps">
        <li class="flex items-center">
            <a href="{{ route('library') }}">{{ __('library') }}</a>
            @svg('iconpark-rightsmall-o','fill-current w-4 h-4 mx-3')
        </li>

        <li class="flex items-center">
            Viewing {{ $libraryTag->title }}
        </li>
    </x-slot>

    <x-filament::card>
        <h1 class="text-primary-500 text-xl">{{ $libraryTag->name }}</h1>

        @if($libraryTag->description === null)
            <p>
                {{ $libraryTag->description }}
            </p>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-2">
            @foreach($libraryTag->library as $item)
                <x-filament::card>
                    <div
                        x-cloak x-show="show"
                        x-transition.duration.500ms.opacity.scale x-init="$nextTick(() => show = true)"
                    >
                        <h2>{{ $item->name }}</h2>
                        <div class="space-y-2">
                            @php
                                $file = $item->getFiles()->first();
                            @endphp
                            @include($skyTheme.'.addons.library-types.'.strtolower($item->type))
                        </div>
                    </div>
                </x-filament::card>
            @endforeach
        </div>
    </x-filament::card>
</div>
