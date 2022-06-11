<div class="mt-6 max-w-7xl mx-auto">

    <x-slot name="breadcrumps">
        @if($post->parent !== null)
            <li class="flex items-center">
                <a href="{{ route('page',[$post->parent->slug]) }}" class="text-gray-400 capitalize" aria-current="page">{{ $post->parent->title }}</a>
                <x-iconpark-rightsmall-o class="fill-current w-4 h-4 mx-3" />
            </li>
        @endif
        <li>
            <a class="text-gray-500 capitalize" aria-current="page">{{ $post->title }}</a>
        </li>
    </x-slot>

    @if(!$post->getMedia('posts')->isEmpty())
        <img src="{{ $post->getFirstMediaUrl('posts') }}" class="my-10 w-full aspect-video shadow-md rounded-[2rem] rounded-bl-none z-0 object-cover"/>
    @endif

    <div class="bg-white rounded-[2rem] rounded-tl-none shadow-md px-10 pb-6 ">
        <div class="flex items-center justify-between">
            <span class="font-light text-gray-600">{{ optional($post->published_at)->diffForHumans() ?? '' }}</span>
            <div>
                @unless ($post->tags->isEmpty())
                    @each($theme.'.partial.tag', $post->tags->where('type','category'), 'tag')
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
                    <img src="{{ \Filament\Facades\Filament::getUserAvatarUrl($post->author) }}" alt="avatar" class="hidden object-cover w-10 h-10 mx-4 rounded-full sm:block">
                    <h1 class="font-bold text-gray-700 hover:underline">{{ $post->author->name ?? '' }}</h1>
                </a>
            </div>
        </div>

        <div class="mt-12">
            {!! html_entity_decode($post->content) !!}
        </div>

        @if(!$children->isEmpty())
            <div class="py-6 flex flex-col mt-4 gap-4">
                <h1 class="text-xl font-bold text-gray-700 md:text-2xl">children pages</h1>

                <div class="grid grid-cols-3 gap-4">
                    @foreach($children as $post)
                        @include($theme.'.partial.children-pages')
                    @endforeach
                </div>
            </div>
        @endif

    </div>
</div>
