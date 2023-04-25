<div class="flex sm:space-x-2 rtl:space-x-reverse px-2 lg:p-4 @if($loop->first) sm:col-span-2 @endif w-full">
    <a class="mb-4 md:mb-0 w-full relative h-[16em] sm:h-[20em] md:h-[22em] lg:h-[24em]" href="{{ route('post',$post->slug) }}">
        <div class="absolute inset-0 w-full h-full z-10 shadow-md rounded-[2rem] @if($loop->first) md:ltr:rounded-br-none md:rtl:rounded-bl-none @else md:ltr:rounded-bl-none md:rtl:rounded-br-none @endif bg-gradient-to-b from-transparent to-gray-700"></div>

        @if($post->image() !== null)
            <img alt="{{ $post->title }}" src="{{ $post->image() }}" class="absolute ltr:left-0 rtl:right-0 top-0 w-full h-full shadow-md rounded-[2rem] @if($loop->first) md:ltr:rounded-br-none md:rtl:rounded-bl-none @else md:ltr:rounded-bl-none md:rtl:rounded-br-none @endif z-0 object-cover"/>
        @endif

        <div class="p-4 absolute bottom-0 ltr:left-0 rtl:right-0 z-20">
            <h2 class="text-2xl lg:text-4xl font-semibold text-gray-100 leading-tight">
                {{ $post->title ?? '' }}
            </h2>
            <div class="flex mt-3">
                <img src="{{ \Filament\Facades\Filament::getUserAvatarUrl($post->author) }}" class="h-10 w-10 rounded-full mx-2 object-cover"/>
                <div>
                    <p class="font-semibold text-gray-200 text-sm">{{ $post->author->name ?? '' }}</p>
                    <p class="font-semibold text-gray-400 text-xs">{{ optional($post->published_at)->diffForHumans() ?? '' }}</p>
                </div>
            </div>
        </div>
    </a>
</div>
