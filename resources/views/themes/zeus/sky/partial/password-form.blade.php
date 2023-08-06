<div class="max-w-3xl mx-auto">
    <x-filament::section>
        <x-filament-panels::form method="post" action="{{ route('passwordConfirmation',[$post]) }}">
            @csrf
            <div class="flex flex-col gap-4">
                <label for="password">{{ __('Password') }}:</label>
                <input type="text" name="password" id="password" class="filament-forms-input block w-full mx-auto rounded-lg shadow-sm outline-none transition duration-75 focus:ring-1 focus:ring-inset disabled:opacity-70 dark:bg-gray-700 dark:text-white border-gray-300 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:focus:border-primary-500">
                @if (session('status'))
                    <div class="py-1 text-red-600">
                        {{ session('status') }}
                    </div>
                @endif
            </div>
            <x-filament::button type="submit">
                {{ __('Send') }}
            </x-filament::button>
        </x-filament-panels::form>
    </x-filament::section>
</div>
