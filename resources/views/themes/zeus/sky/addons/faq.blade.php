@if(!$faqs->isEmpty())
    <x-slot name="header">
        <h1>{{ __('FAQs') }}</h1>
    </x-slot>

    <x-slot name="breadcrumbs">
        <li class="flex items-center">
            {{ __('FAQs') }}
        </li>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-center text-3xl font-extrabold tracking-tight sm:text-4xl text-primary-600 dark:text-primary-400">
                {{ __('frequently asked questions') }}
            </h2>
            <div class="space-y-8 mt-10">
                @foreach($faqs as $faq)
                    <div class="bg-white dark:bg-gray-800 rounded-[2rem] rounded-bl-none rounded-tr-none shadow-md group">
                        <h5>
                            <a class="flex items-center justify-between w-full px-6 py-4 text-xl font-medium tracking-tight text-primary-600 dark:text-primary-200">
                                <span class="underline">
                                    {{ $faq->question }}
                                </span>
                            </a>
                        </h5>
                        <div class="pb-4 px-6 prose dark:prose-invert max-w-none">
                            {!! $faq->answer !!}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
