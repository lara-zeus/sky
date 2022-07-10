<div class="px-8">
    <h1 class="mb-4 text-xl font-bold text-gray-700">Search</h1>
    <div class="flex flex-col max-w-sm px-6 py-4 mx-auto bg-white rounded-lg shadow-md">
        <form method="GET">
            <input type="text" name="search" value="{{ request()->get('search') }}">
        </form>
    </div>
</div>
