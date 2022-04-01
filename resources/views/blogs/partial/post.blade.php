<div class="w-full mx-auto overflow-hidden bg-white rounded-lg shadow-md dark:bg-gray-800">
    <img class="object-cover w-full h-64" src="{{ $post->getFirstMediaUrl('posts') ?? 'https://images.unsplash.com/photo-1550439062-609e1531270e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=60' }}" alt="Article">

    <div class="p-6">
        <div>
            <span class="text-xs font-medium text-blue-600 uppercase dark:text-blue-400">
                {{ $post->tags->where('type','category')->first()->name }}
            </span>
            <a href="#" class="block mt-2 text-2xl font-semibold text-gray-800 transition-colors duration-200 transform dark:text-white hover:text-gray-600 hover:underline">
                {{ $post->title ?? '' }}
            </a>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                {{ $post->description ?? '' }}
            </p>
        </div>

        <div class="mt-4">
            <div class="flex items-center">
                <div class="flex items-center">
                    <img class="object-cover h-10 rounded-full" src="{{ \Filament\Facades\Filament::getUserAvatarUrl($post->auther) }}" alt="Avatar">
                    <a href="#" class="mx-2 font-semibold text-gray-700 dark:text-gray-200">{{ $post->auther->name ?? '' }}</a>
                </div>
                <span class="mx-1 text-xs text-gray-600 dark:text-gray-300">{{ optional($post->published_at)->diffForHumans() ?? '' }}</span>
            </div>
        </div>
    </div>
</div>
