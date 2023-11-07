@unless($pages->isEmpty())
    <div class="my-4">
        <h4 class="mb-4 text-xl font-bold text-gray-700 dark:text-gray-200">Pages</h4>
        <div class="flex flex-col max-w-sm px-4 py-6 mx-auto bg-white dark:bg-gray-800 rounded-[2rem] ltr:rounded-br-none rtl:rounded-bl-none shadow-md">
            @foreach($pages as $post)
                <a href="{{ route('page',$post->slug) }}" class="border-b border-t border-white hover:border-primary-600 transition duration-300 px-1 py-4">
                    <div class="flex items-center space-x-3 rtl:space-x-reverse">
                        @if($post->image('pages') !== null)
                            <img alt="{{ $post->title }}" src="{{ $post->image('pages') }}" class="h-6 w-6 shadow-md rounded-[2rem] rounded-bl-none z-0 object-cover"/>
                        @endif
                        <div class="w-full text-lg">{!! $post->title !!}</div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endunless
