<a href="{{ route('tags',['category',$tag->slug]) }}" class="px-4 py-1 bg-primary-600 text-gray-200 inline-flex items-center justify-center mb-2 shadow-sm shadow-primary-600/50 rounded-[10px_20px_30px_40px/30px]">
    {{ $tag->name ?? '' }}
</a>
