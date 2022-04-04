<x-zeus::layouts.app>
    <div>
        @unless($stickies->isEmpty())
            <div class="mt-32 grid @if($stickies->count() > 1) grid-cols-3 @endif gap-4">
                @foreach($stickies as $post)
                    @include('zeus-sky::blogs.partial.sticky')
                @endforeach
            </div>
        @endunless

        <div class="overflow-x-hidden">
            <div class="px-6 py-8">
                <div class="container flex justify-between mx-auto">
                    <div class="w-full lg:w-8/12">
                        <div class="flex items-center justify-between">
                            <h1 class="text-xl font-bold text-gray-700 md:text-2xl">Post</h1>
                        </div>
                        @unless ($posts->isEmpty())
                            @each('zeus-sky::blogs.partial.post', $posts, 'post')
                        @endunless
                    </div>
                    <div class="hidden w-4/12 -mx-8 lg:block">
                        {{--@include('zeus-sky::blogs.partial.authors')--}}
                        @include('zeus-sky::blogs.partial.categories')
                        @include('zeus-sky::blogs.partial.recent')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-zeus::layouts.app>
