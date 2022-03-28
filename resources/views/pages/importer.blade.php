<x-filament::page>
    <form wire:submit.prevent="submit" class="space-y-6">
        {{ $this->form }}
        <div class="flex flex-wrap items-center gap-4 justify-center">
            <x-filament::button type="submit">
                Submit
            </x-filament::button>
        </div>
    </form>
</x-filament::page>
