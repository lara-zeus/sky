<div>
    @unless($stickies->isEmpty())
        <div class="mt-10 grid @if($stickies->count() > 1) grid-cols-3 @endif gap-4">
            @foreach($stickies as $post)
                @include($theme.'.partial.sticky')
            @endforeach
        </div>
    @endunless

    <div class="overflow-x-hidden">
        <div class="px-6 py-8">
            <div class="container flex justify-between mx-auto gap-6">
                <div class="w-3/4">
                    @unless ($posts->isEmpty())
                        <div class="flex items-center justify-between">
                            <h1 class="text-xl font-bold text-gray-700 md:text-2xl">{{ __('Posts') }}</h1>
                        </div>
                    @if(request()->filled('search'))
                        {{ __('Showing Search result of') }}: <span class="highlight">{{ request('search') }}</span>
                        <a title="{{ __('clear') }}" href="{{ route('blogs') }}"><x-heroicon-o-backspace class="text-secondary-500 w-4 h-4 inline-flex align-middle"/></a>
                    @endif
                        @each($theme.'.partial.post', $posts, 'post')
                    @else
                        @include($theme.'.partial.empty')
                    @endunless
                </div>
                <div class="w-1/4">
                    @include($theme.'.partial.sidebar')
                </div>
            </div>
        </div>
    </div>
</div>
