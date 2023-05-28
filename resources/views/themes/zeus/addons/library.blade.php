<div class="mx-4">

    <x-slot name="header">
        <h1>{{ __('Libraries') }}</h1>
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-2">
        @foreach($categories as $category)
            <x-filament::card>
                <h2>{{ $category->name }}</h2>
                <div class="space-y-2">
                    @foreach($category->library as $library)
                        <div>
                            <a href="{{ route('library.item', ['slug' => $library->slug]) }}" class="flex flex-col py-2 px-1.5 hover:bg-gray-100 dark:hover:bg-gray-600 rounded-md transition ease-in-out duration-500 block cursor-pointer">
                                <div x-data class="flex items-center justify-between text-primary-600 dark:text-primary-400 hover:dark:text-primary-300">
                                    <h3>{{ $library->title ?? '' }}</h3>
                                    @if($library->type === 'IMAGE')
                                        <x-heroicon-o-photograph x-tooltip.raw="{{ __('Image') }}" class="w-4 h-4 text-gray-400 dark:text-gray-500" />
                                    @endif

                                    @if($library->type === 'FILE')
                                        <x-heroicon-o-document x-tooltip.raw="{{ __('File') }}" class="w-4 h-4 text-gray-400 dark:text-gray-500" />
                                    @endif

                                    @if($library->type === 'VIDEO')
                                        <x-heroicon-o-film x-tooltip.raw="{{ __('Video') }}" class="w-4 h-4 text-gray-400 dark:text-gray-500" />
                                    @endif
                                </div>
                                <cite class="text-sm text-secondary-600 dark:text-secondary-500 hover:dark:text-secondary-300">
                                    {{ $library->description }}
                                </cite>
                            </a>
                        </div>
                    @endforeach
                </div>
            </x-filament::card>
        @endforeach
    </div>

</div>
