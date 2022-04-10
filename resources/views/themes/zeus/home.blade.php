<div>
    @unless($stickies->isEmpty())
        <div class="mt-10 grid @if($stickies->count() > 1) grid-cols-3 @endif gap-4">
            @foreach($stickies as $post)
                @include('zeus-sky::themes.'.config('zeus-sky.theme').'.partial.sticky')
            @endforeach
        </div>
    @endunless

    <div class="overflow-x-hidden">
        <div class="px-6 py-8">
            <div class="container flex justify-between mx-auto gap-6">
                <div class="w-3/4">
                    <div class="flex items-center justify-between">
                        <h1 class="text-xl font-bold text-gray-700 md:text-2xl">Posts</h1>
                    </div>

                    @unless ($posts->isEmpty())
                        @each('zeus-sky::themes.'.config('zeus-sky.theme').'.partial.post', $posts, 'post')
                    @endunless
                </div>
                <div class="w-1/4">
                    @include('zeus-sky::themes.'.config('zeus-sky.theme').'.partial.sidebar')
                </div>
            </div>
        </div>
    </div>
</div>
