<div>
    @if(!$faqs->isEmpty())
        <div class="bg-gray-50">
            <div class="max-w-7xl mx-auto py-12 px-4 sm:py-16 sm:px-6 lg:px-8">
                <div class="max-w-4xl mx-auto">
                    <h2 class="text-center text-3xl font-extrabold tracking-tight sm:text-4xl text-primary-500">
                        {{ __('question and answer') }}
                    </h2>
                    <div class="space-y-8 mt-10">
                        @foreach($faqs as $faq)
                            <div class="bg-white rounded-[2rem] rounded-bl-none rounded-tr-none shadow-md group">
                                <h5>
                                    <a class="flex items-center justify-between w-full px-6 py-4 text-xl font-medium tracking-tight text-secondary-600">
                                        <span class="underline">
                                            {{ $faq->question }}
                                        </span>
                                    </a>
                                </h5>
                                <div>
                                    <div class="pb-4 px-6">
                                        {!! $faq->answer !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
