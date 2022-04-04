<div class="px-8 mt-10">
    <h1 class="mb-4 text-xl font-bold text-gray-700">Categories</h1>
    <div class="flex flex-col max-w-sm px-4 py-6 mx-auto bg-white rounded-lg shadow-md">
        <ul>
            @foreach($tags as $tag)
                <li class="px-1 py-4 border-b border-t border-white hover:border-gray-200 transition duration-300">
                    <a href="{{ url('/blog/tag/'.$tag->slug) }}" class="flex items-center text-gray-600 cursor-pointer">
                        {{ $tag->name }}
                        <span class="text-gray-500 ml-auto">{{ $tag->posts_count }} Post</span>
                        <i class='text-gray-500 bx bx-right-arrow-alt ml-1'></i>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
