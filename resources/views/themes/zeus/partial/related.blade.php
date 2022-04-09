<div class="block md:flex md:space-x-2 rtl:space-x-reverse px-2 lg:p-0 w-full">
    <div class="mb-4 md:mb-0 w-full relative h-[24em]" href="{{ route('post',$post->slug) }}">
        <div class="absolute inset-0 w-full h-full z-10 shadow-md rounded-[2rem] @if($loop->odd) ltr:rounded-br-none rtl:rounded-bl-none @else ltr:rounded-bl-none rtl:rounded-br-none @endif bg-gradient-to-b from-transparent to-gray-700"></div>

        @if(!$post->getMedia('posts')->isEmpty())
            <img src="{{ $post->getFirstMediaUrl('posts') }}" class="absolute ltr:left-0 rtl:right-0 top-0 w-full h-full shadow-md rounded-[2rem] @if($loop->odd) ltr:rounded-br-none rtl:rounded-bl-none @else ltr:rounded-bl-none rtl:rounded-br-none @endif z-0 object-cover"/>
        @endif

        <div class="p-4 absolute bottom-0 ltr:left-0 rtl:right-0 z-20">
            <div>
                @unless ($post->tags->isEmpty())
                    @each('zeus-sky::themes.'.config('zeus-sky.theme').'.partial.tag', $post->tags->where('type','category'), 'tag')
                @endunless
            </div>
            <a href="{{ route('post',$post->slug) }}" class="text-4xl font-semibold text-gray-100 leading-tight">
                {{ $post->title ?? '' }}
            </a>
            <div class="flex mt-3">
                <img src="{{ \Filament\Facades\Filament::getUserAvatarUrl($post->auther) }}" class="h-10 w-10 rounded-full ltr:mr-2 rtl:ml-2 object-cover"/>
                <div>
                    <p class="font-semibold text-gray-200 text-sm">{{ $post->auther->name ?? '' }}</p>
                    <p class="font-semibold text-gray-400 text-xs">{{ optional($post->published_at)->diffForHumans() ?? '' }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
