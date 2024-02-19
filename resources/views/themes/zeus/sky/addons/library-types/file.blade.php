<x-filament::button tag="a" target="_blank" href="{{ $file->getFullUrl() }}" class="mx-auto">
    {{ $file->getFullUrl() }} {{ __('Show File') }}
</x-filament::button>