<a href="{{ route('page',$post->slug) }}">
    <div class="flex space-x-3 rtl:space-x-reverse">
        @if($post->image() !== null)
            <img alt="{{ $post->title }}" src="{{ $post->image() }}" class="h-6 w-6 shadow-md rounded-[2rem] rounded-bl-none z-0 object-cover"/>
        @endif
        <div class="w-full">
            <div class="flex items-center justify-between">
                <span class="text-lg">{{ $post->title ?? '' }}</span>
            </div>
        </div>
    </div>
</a>
