<div>
    @unless($posts->isEmpty())
        <div class="mt-10 grid grid-cols-3 gap-4">
            @foreach($posts as $post)
                @include($theme.'.partial.sticky')
            @endforeach
        </div>
    @endunless
</div>
