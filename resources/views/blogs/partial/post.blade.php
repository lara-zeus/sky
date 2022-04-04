<div class="mt-6">
    <div class="max-w-4xl px-6 pb-6 mx-auto bg-white rounded-[2rem] rounded-bl-none rounded-tr-none shadow-md">
        <div class="flex items-center justify-between">
            <span class="font-light text-sm text-gray-600">{{ optional($post->published_at)->diffForHumans() ?? '' }}</span>
            <div>
                @unless ($post->tags->isEmpty())
                    @each('zeus-sky::components.tag', $post->tags->where('type','category'), 'tag')
                @endunless
            </div>
        </div>
        <div class="mt-2">
            <a href="{{ route('post',$post->slug) }}" class="text-2xl md:text-3xl font-bold text-gray-700 hover:underline">
                {{ $post->title ?? '' }}
            </a>
            <p class="mt-2 text-gray-600">
                {{ $post->description ?? '' }}
            </p>
        </div>
        <div class="flex items-center justify-between mt-4">
            <a href="{{ route('post',$post->slug) }}" class="text-blue-500 hover:underline">Read more</a>
            <div>
                <a class="flex items-center gap-2">
                    <img src="{{ \Filament\Facades\Filament::getUserAvatarUrl($post->auther) }}" alt="avatar" class="hidden object-cover w-8 h-8 rounded-full sm:block">
                    <p class="text-gray-700 hover:underline">{{ $post->auther->name ?? '' }}</p>
                </a>
            </div>
        </div>
    </div>
</div>
