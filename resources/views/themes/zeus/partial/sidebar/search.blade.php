<div class="my-4">
    <h1 class="mb-4 text-xl font-bold text-gray-700">{{ __('Search') }}</h1>
    <div class="flex flex-col max-w-sm px-2 py-4 mx-auto bg-white rounded-lg shadow-md bord">
        <form method="GET">
            <input class="w-full px-3 py-1.5 rounded" type="text" name="search" value="{{ request()->get('search') }}">
        </form>
    </div>
</div>
