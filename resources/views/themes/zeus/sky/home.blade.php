<div>
    @unless($stickies->isEmpty())
        <section class="mt-10 grid @if($stickies->count() > 1) grid-cols-3 @endif gap-4">
            @foreach($stickies as $post)
                @include($skyTheme.'.partial.sticky')
            @endforeach
        </section>
    @endunless

    <main class="flex flex-col sm:flex-row justify-between mx-auto gap-3 md:gap-6 px-3 md:px-6 py-4 md:py-8">
        <section class="w-full sm:w-2/3 lg:w-3/4">
            @if(request()->filled('search'))
                <div class="py-4">
                    {{ __('Showing Search result of') }}: <span class="highlight">{{ request('search') }}</span>
                    <a title="{{ __('clear') }}" href="{{ route('blogs') }}">
                        @svg('heroicon-o-backspace','text-primary-500 dark:text-primary-100 w-4 h-4 inline-flex align-middle')
                    </a>
                </div>
            @endif

            @unless ($posts->isEmpty())
                <h1 class="text-xl font-bold text-gray-700 dark:text-gray-100 md:text-2xl">{{ __('Posts') }}</h1>
                @each($skyTheme.'.partial.post', $posts, 'post')
            @else
                @include($skyTheme.'.partial.empty')
            @endunless
        </section>
        <nav class="w-full sm:w-1/3 lg:w-1/4">
            @include($skyTheme.'.partial.sidebar')
        </nav>
    </main>
</div>
