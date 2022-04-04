<div class="mt-6 max-w-7xl mx-auto">

    @if(!$post->getMedia('posts')->isEmpty())
        <img src="{{ $post->getFirstMediaUrl('posts') }}" class="my-10 w-full h-full shadow-md rounded-[2rem] rounded-bl-none z-0 object-cover"/>
    @endif

    <div class="bg-white rounded-[2rem] rounded-tl-none shadow-md px-10 pb-6 ">
        <div class="flex items-center justify-between">
            <span class="font-light text-gray-600">{{ optional($post->published_at)->diffForHumans() ?? '' }}</span>
            <div>
                @unless ($post->tags->isEmpty())
                    @each('zeus-sky::components.tag', $post->tags->where('type','category'), 'tag')
                @endunless
            </div>
        </div>

        <div class="flex items-center justify-between mt-4">
            <div>
                <a href="#" class="text-2xl font-bold text-gray-700 hover:underline">
                    {{ $post->title ?? '' }}
                </a>
                <p class="mt-2 text-gray-600">
                    {{ $post->description ?? '' }}
                </p>
            </div>

            <div>
                <a href="#" class="flex items-center">
                    <img src="{{ \Filament\Facades\Filament::getUserAvatarUrl($post->auther) }}" alt="avatar" class="hidden object-cover w-10 h-10 mx-4 rounded-full sm:block">
                    <h1 class="font-bold text-gray-700 hover:underline">{{ $post->auther->name ?? '' }}</h1>
                </a>
            </div>
        </div>

        <div class="mt-12">
            {!! html_entity_decode($post->content) !!}
        </div>
    </div>

    <div class="py-6 flex flex-col mt-4 gap-4">
        <h1 class="text-xl font-bold text-gray-700 md:text-2xl">related posts</h1>

        <div class="grid grid-cols-3 gap-4">
            @foreach($related as $post)
                @include('zeus-sky::blogs.partial.related')
            @endforeach
        </div>
    </div>
</div>
