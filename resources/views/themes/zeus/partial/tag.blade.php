<a href="{{ route('tags',[$tag->type,$tag->slug]) }}" class="text-gray-400">
    {{ $tag->name ?? '' }}
    @if(!$loop->last) - @endif
</a>
