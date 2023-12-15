<div class="mx-4">

    <x-slot name="header">
        <h1>{{ __('Libraries') }}</h1>
    </x-slot>

    <x-slot name="breadcrumbs">
        <li class="flex items-center">
            {{ __('libraries') }}
        </li>
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-2">
        @foreach($categories as $category)
            <x-filament::section>
                <h2><a href="{{ route('library.tag',$category->slug ) }}" class="text-secondary-600">{{ $category->name }}</a></h2>
                <div class="space-y-2">
                    @foreach($category->library as $library)
                        <div>
                            <a href="{{ route('library.item', ['slug' => $library->slug]) }}" class="flex flex-col py-2 px-1.5 hover:bg-gray-100 dark:hover:bg-gray-600 rounded-md transition ease-in-out duration-500 block cursor-pointer">
                                <div x-data class="flex items-center justify-between text-primary-600 dark:text-primary-400 hover:dark:text-primary-300">
                                    <h3>{{ $library->title ?? '' }}</h3>
                                    @if($library->type === 'IMAGE')
                                        <span x-tooltip.raw="{{ __('Image') }}">
                                            @svg('heroicon-o-photo','w-4 h-4 text-gray-400 dark:text-gray-500')
                                        </span>
                                    @endif

                                    @if($library->type === 'FILE')
                                        <span x-tooltip.raw="{{ __('FILE') }}">
                                            @svg('heroicon-o-document','w-4 h-4 text-gray-400 dark:text-gray-500')
                                        </span>
                                    @endif

                                    @if($library->type === 'VIDEO')
                                        <span x-tooltip.raw="{{ __('VIDEO') }}">
                                            @svg('heroicon-o-film','w-4 h-4 text-gray-400 dark:text-gray-500')
                                        </span>
                                    @endif
                                </div>
                                <cite class="text-sm text-primary-600 dark:text-primary-500 hover:dark:text-primary-300">
                                    {{ $library->description }}
                                </cite>
                            </a>
                        </div>
                    @endforeach
                </div>
            </x-filament::section>
        @endforeach
    </div>

</div>
