<nav x-data="{ open: false }" class="bg-white border-0 border-gray-100">
    <div class="container mx-auto">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="flex-shrink-0 flex items-center">
                    <a class="italic flex gap-2 group" href="{{ url('/') }}">
                        <img class="w-7" src="{{ asset('vendor/zeus/images/zeus-logo.png') }}" alt="{{ config('app.name', 'Laravel') }}">
                        @zeus
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex"></div>

            </div>
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                @auth
                    <div class="ml-3 relative">
                        {{--account--}}
                    </div>
                @else
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                        @endif
                    @endif
                @endauth
            </div>
        </div>
    </div>
</nav>
