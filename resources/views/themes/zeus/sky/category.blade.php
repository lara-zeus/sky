<div>
    @unless($posts->isEmpty())
        <div class="mt-10 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            @foreach($posts as $post)
                @include($skyTheme.'.partial.sticky')
            @endforeach
        </div>
    @endunless
</div>
