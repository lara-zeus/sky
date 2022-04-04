<div class="px-8 my-4">
    <h1 class="mb-4 text-xl font-bold text-gray-700">Recent Post</h1>
    <div class="flex flex-col gap-4 max-w-sm px-4 py-6 mx-auto bg-white rounded-lg shadow-md shadow-secondary-600/50">
        @foreach($recent as $post)
            <a href="{{ route('post',$post->slug) }}">
                <div class="flex space-x-3 rtl:space-x-reverse">
                    @if(!$post->getMedia('posts')->isEmpty())
                        <img src="{{ $post->getFirstMediaUrl('posts') }}" class="h-6 w-6 shadow-md rounded-[2rem] rounded-bl-none z-0 object-cover"/>
                    @else
                        <img src="https://images.unsplash.com/photo-1492562080023-ab3db95bfbce?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=731&amp;q=80" class="h-6 w-6 shadow-md rounded-[2rem] rounded-bl-none z-0 object-cover"/>
                    @endif
                    <div class="w-full">
                        <div class="flex items-center justify-between">
                            <span class="text-lg">{{ $post->title ?? '' }}</span>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</div>
