<div class="mt-6 container mx-auto px-2 md:px-4">
    <x-slot name="header">
        <span class="capitalize">{{ $post->title }}</span>
    </x-slot>

    <x-slot name="breadcrumps">
        <li>
            <a class="text-gray-500 capitalize" aria-current="page">{{ $post->title }}</a>
        </li>
    </x-slot>

    @if(!$post->getMedia('posts')->isEmpty())
        <img src="{{ $post->getFirstMediaUrl('posts') }}" class="my-10 w-full h-full shadow-md rounded-[2rem] rounded-bl-none z-0 object-cover"/>
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

        <div class="flex flex-col items-start justify-start gap-4">
            <div>
                <a href="#" class="text-2xl font-bold text-gray-700 hover:underline">
                    {{ $post->title ?? '' }}
                </a>
                <p class="mt-2 text-gray-600">
                    {{ $post->description ?? '' }}
                </p>
            </div>
            <a href="#" class="flex items-center gap-2">
                <img src="{{ \Filament\Facades\Filament::getUserAvatarUrl($post->author) }}" alt="avatar" class="object-cover w-10 h-10 rounded-full sm:block">
                <h1 class="font-bold text-gray-700 hover:underline">{{ $post->author->name ?? '' }}</h1>
            </a>
        </div>

        <div class="mt-6 lg:mt-12">
            {!! html_entity_decode($post->content) !!}
        </div>
    </div>

    <div class="py-6 flex flex-col mt-4 gap-4">
        <h1 class="text-xl font-bold text-gray-700 md:text-2xl">{{ __('Related Posts') }}</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($related as $post)
                @include($theme.'.partial.related')
            @endforeach
        </div>
    </div>
</div>
