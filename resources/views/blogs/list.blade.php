<x-zeus::layouts.app>
    {{--<x-slot name="header">
        all my posts
    </x-slot>--}}

    <!-- component -->
    <div class="max-w-screen-xl mx-auto">
        <main class="mt-10">
            <div class="block md:flex md:space-x-2 px-2 lg:p-0">
                <a
                        class="mb-4 md:mb-0 w-full md:w-2/3 relative rounded inline-block"
                        style="height: 24em;"
                        href="./blog.html"
                >
                    <div class="absolute left-0 bottom-0 w-full h-full z-10"
                         style="background-image: linear-gradient(180deg,transparent,rgba(0,0,0,.7));"></div>
                    <img src="https://images.unsplash.com/photo-1493770348161-369560ae357d?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2100&q=80" class="absolute left-0 top-0 w-full h-full rounded z-0 object-cover" />
                    <div class="p-4 absolute bottom-0 left-0 z-20">
                        <span class="px-4 py-1 bg-black text-gray-200 inline-flex items-center justify-center mb-2">Nutrition</span>
                        <h2 class="text-4xl font-semibold text-gray-100 leading-tight">
                            Pellentesque a consectetur velit, ac molestie ipsum. Donec sodales, massa et auctor.
                        </h2>
                        <div class="flex mt-3">
                            <img src="https://randomuser.me/api/portraits/men/97.jpg"
                                 class="h-10 w-10 rounded-full mr-2 object-cover" />
                            <div>
                                <p class="font-semibold text-gray-200 text-sm"> Mike Sullivan </p>
                                <p class="font-semibold text-gray-400 text-xs"> 14 Aug </p>
                            </div>
                        </div>
                    </div>
                </a>

                <a class="w-full md:w-1/3 relative rounded"
                   style="height: 24em;"
                   href="./blog.html"
                >
                    <div class="absolute left-0 top-0 w-full h-full z-10"
                         style="background-image: linear-gradient(180deg,transparent,rgba(0,0,0,.7));"></div>
                    <img src="https://images.unsplash.com/photo-1543362906-acfc16c67564?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1301&q=80" class="absolute left-0 top-0 w-full h-full rounded z-0 object-cover" />
                    <div class="p-4 absolute bottom-0 left-0 z-20">
                        <span class="px-4 py-1 bg-black text-gray-200 inline-flex items-center justify-center mb-2">Science</span>
                        <h2 class="text-3xl font-semibold text-gray-100 leading-tight">Lorem ipsum dolor sit amet, consectetur
                            adipisicing elit.</h2>
                        <div class="flex mt-3">
                            <img
                                    src="https://images-na.ssl-images-amazon.com/images/M/MV5BODFjZTkwMjItYzRhMS00OWYxLWI3YTUtNWIzOWQ4Yjg4NGZiXkEyXkFqcGdeQXVyMTQ0ODAxNzE@._V1_UX172_CR0,0,172,256_AL_.jpg"
                                    class="h-10 w-10 rounded-full mr-2 object-cover" />
                            <div>
                                <p class="font-semibold text-gray-200 text-sm"> Chrishell Staus </p>
                                <p class="font-semibold text-gray-400 text-xs"> 15 Aug </p>
                            </div>
                        </div>
                    </div>
            </div>
            </a>

            <div class="block lg:flex lg:space-x-2 px-2 lg:p-0 mt-10 mb-10">
                <!-- post cards -->
                <div class="w-full lg:w-2/3">

                    <a class="block rounded w-full lg:flex mb-10"
                       href="./blog-single-1.html"
                    >
                        <div
                                class="h-48 lg:w-48 flex-none bg-cover text-center overflow-hidden opacity-75"
                                style="background-image: url('https://images.unsplash.com/photo-1512621776951-a57141f2eefd?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2100&q=80')"
                                title="deit is very important"
                        >
                        </div>
                        <div class="bg-white rounded px-4 flex flex-col justify-between leading-normal">
                            <div>
                                <div class="mt-3 md:mt-0 text-gray-700 font-bold text-2xl mb-2">
                                    Aliquam venenatis nisl id purus rhoncus, in efficitur sem hendrerit.
                                </div>
                                <p class="text-gray-700 text-base">
                                    Duis euismod est quis lacus elementum, eu laoreet dolor consectetur.
                                    Pellentesque sed neque vel tellus lacinia elementum. Proin consequat ullamcorper eleifend.
                                </p>
                            </div>
                            <div class="flex mt-3">
                                <img src="https://randomuser.me/api/portraits/men/86.jpg"
                                     class="h-10 w-10 rounded-full mr-2 object-cover" />
                                <div>
                                    <p class="font-semibold text-gray-700 text-sm capitalize"> eduard franz </p>
                                    <p class="text-gray-600 text-xs"> 14 Aug </p>
                                </div>
                            </div>
                        </div>
                    </a>

                    <div class="rounded w-full lg:flex mb-10">
                        <div class="h-48 lg:w-48 flex-none bg-cover text-center overflow-hidden opacity-75"
                             style="background-image: url('https://images.unsplash.com/photo-1515003197210-e0cd71810b5f?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2100&q=80')" title="deit is very important">
                        </div>
                        <div class="bg-white rounded px-4 flex flex-col justify-between leading-normal">
                            <div>
                                <div class="mt-3 md:mt-0 text-gray-700 font-bold text-2xl mb-2">
                                    Integer commodo, sapien ut vulputate viverra
                                </div>
                                <p class="text-gray-700 text-base">
                                    Nam malesuada aliquet metus, ac commodo augue mollis sit amet.
                                    Nam bibendum risus sit amet metus semper consectetur.
                                    Proin consequat ullamcorper eleifend.
                                    Nam bibendum risus sit amet metus semper consectetur.
                                </p>
                            </div>
                            <div class="flex mt-3">
                                <img src="https://randomuser.me/api/portraits/women/54.jpg"
                                     class="h-10 w-10 rounded-full mr-2 object-cover" />
                                <div>
                                    <p class="font-semibold text-gray-700 text-sm capitalize"> Serenity Hughes </p>
                                    <p class="text-gray-600 text-xs"> 14 Aug </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="rounded w-full lg:flex mb-10">
                        <div class="h-48 lg:w-48 flex-none bg-cover text-center overflow-hidden opacity-75"
                             style="background-image: url('https://images.unsplash.com/photo-1512621776951-a57141f2eefd?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2100&q=80')" title="deit is very important">
                        </div>
                        <div class="bg-white rounded px-4 flex flex-col justify-between leading-normal">
                            <div>
                                <div class="mt-3 md:mt-0 text-gray-700 font-bold text-2xl mb-2">
                                    Suspendisse varius justo eu risus laoreet fermentum non aliquam dolor
                                </div>
                                <p class="text-gray-700 text-base">
                                    Mauris porttitor, velit at tempus vulputate, odio turpis facilisis dui,
                                    vitae eleifend odio ipsum at odio. Phasellus luctus scelerisque felis eget suscipit.
                                </p>
                            </div>
                            <div class="flex mt-3">
                                <img src="https://randomuser.me/api/portraits/men/86.jpg"
                                     class="h-10 w-10 rounded-full mr-2 object-cover" />
                                <div>
                                    <p class="font-semibold text-gray-700 text-sm capitalize"> eduard franz </p>
                                    <p class="text-gray-600 text-xs"> 14 Aug </p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- right sidebar -->
                <div class="w-full lg:w-1/3 px-3">
                    <!-- topics -->
                    <div class="mb-4">
                        <h5 class="font-bold text-lg uppercase text-gray-700 px-1 mb-2"> Popular Topics </h5>
                        <ul>
                            <li class="px-1 py-4 border-b border-t border-white hover:border-gray-200 transition duration-300">
                                <a href="#" class="flex items-center text-gray-600 cursor-pointer">
                                    <span class="inline-block h-4 w-4 bg-green-300 mr-3"></span>
                                    Nutrition
                                    <span class="text-gray-500 ml-auto">23 articles</span>
                                    <i class='text-gray-500 bx bx-right-arrow-alt ml-1'></i>
                                </a>
                            </li>
                            <li class="px-1 py-4 border-b border-t border-white hover:border-gray-200 transition duration-300">
                                <a href="#" class="flex items-center text-gray-600 cursor-pointer">
                                    <span class="inline-block h-4 w-4 bg-indigo-300 mr-3"></span>
                                    Food & Diet
                                    <span class="text-gray-500 ml-auto">18 articles</span>
                                    <i class='text-gray-500 bx bx-right-arrow-alt ml-1'></i>
                                </a>
                            </li>
                            <li class="px-1 py-4 border-b border-t border-white hover:border-gray-200 transition duration-300">
                                <a href="#" class="flex items-center text-gray-600 cursor-pointer">
                                    <span class="inline-block h-4 w-4 bg-yellow-300 mr-3"></span>
                                    Workouts
                                    <span class="text-gray-500 ml-auto">34 articles</span>
                                    <i class='text-gray-500 bx bx-right-arrow-alt ml-1'></i>
                                </a>
                            </li>
                            <li class="px-1 py-4 border-b border-t border-white hover:border-gray-200 transition duration-300">
                                <a href="#" class="flex items-center text-gray-600 cursor-pointer">
                                    <span class="inline-block h-4 w-4 bg-blue-300 mr-3"></span>
                                    Immunity
                                    <span class="text-gray-500 ml-auto">9 articles</span>
                                    <i class='text-gray-500 bx bx-right-arrow-alt ml-1'></i>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- divider -->
                    <div class="border border-dotted"></div>

                    <!-- subscribe -->
                    <div class="p-1 mt-4 mb-4">
                        <h5 class="font-bold text-lg uppercase text-gray-700 mb-2"> Subscribe </h5>
                        <p class="text-gray-600">
                            Subscribe to our newsletter. We deliver the best health related articles to your inbox
                        </p>
                        <input placeholder="your email address"
                               class="text-gray-700 bg-gray-100 rounded-t hover:outline-none p-2 w-full mt-4 border" />
                        <button class="px-4 py-2 bg-indigo-600 text-gray-200 rounded-b w-full capitalize tracking-wide">
                            Subscribe
                        </button>
                    </div>

                    <!-- divider -->
                    <div class="border border-dotted"></div>

                </div>

            </div>
        </main>
    </div>

    <!-- component -->
    <div class="overflow-x-hidden">
        <div class="px-6 py-8">
            <div class="container flex justify-between mx-auto">
                <div class="w-full lg:w-8/12">
                    <div class="flex items-center justify-between">
                        <h1 class="text-xl font-bold text-gray-700 md:text-2xl">Post</h1>
                        <div>
                            <select class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option>Latest</option>
                                <option>Last Week</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-6">
                        <div class="max-w-4xl px-10 py-6 mx-auto bg-white rounded-lg shadow-md">
                            <div class="flex items-center justify-between"><span class="font-light text-gray-600">Jun 1,
                                2020</span><a href="#"
                                              class="px-2 py-1 font-bold text-gray-100 bg-gray-600 rounded hover:bg-gray-500">Laravel</a>
                            </div>
                            <div class="mt-2"><a href="#" class="text-2xl font-bold text-gray-700 hover:underline">Build
                                    Your New Idea with Laravel Freamwork.</a>
                                <p class="mt-2 text-gray-600">Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                                    Tempora expedita dicta totam aspernatur doloremque. Excepturi iste iusto eos enim
                                    reprehenderit nisi, accusamus delectus nihil quis facere in modi ratione libero!</p>
                            </div>
                            <div class="flex items-center justify-between mt-4"><a href="#"
                                                                                   class="text-blue-500 hover:underline">Read more</a>
                                <div><a href="#" class="flex items-center"><img
                                                src="https://images.unsplash.com/photo-1492562080023-ab3db95bfbce?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=731&amp;q=80"
                                                alt="avatar" class="hidden object-cover w-10 h-10 mx-4 rounded-full sm:block">
                                        <h1 class="font-bold text-gray-700 hover:underline">Alex John</h1>
                                    </a></div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-6">
                        <div class="max-w-4xl px-10 py-6 mx-auto bg-white rounded-lg shadow-md">
                            <div class="flex items-center justify-between"><span class="font-light text-gray-600">mar 4,
                                2019</span><a href="#"
                                              class="px-2 py-1 font-bold text-gray-100 bg-gray-600 rounded hover:bg-gray-500">Design</a>
                            </div>
                            <div class="mt-2"><a href="#"
                                                 class="text-2xl font-bold text-gray-700 hover:underline">Accessibility tools for
                                    designers and developers</a>
                                <p class="mt-2 text-gray-600">Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                                    Tempora expedita dicta totam aspernatur doloremque. Excepturi iste iusto eos enim
                                    reprehenderit nisi, accusamus delectus nihil quis facere in modi ratione libero!</p>
                            </div>
                            <div class="flex items-center justify-between mt-4"><a href="#"
                                                                                   class="text-blue-500 hover:underline">Read more</a>
                                <div><a href="#" class="flex items-center"><img
                                                src="https://images.unsplash.com/photo-1464863979621-258859e62245?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=333&amp;q=80"
                                                alt="avatar" class="hidden object-cover w-10 h-10 mx-4 rounded-full sm:block">
                                        <h1 class="font-bold text-gray-700 hover:underline">Jane Doe</h1>
                                    </a></div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-6">
                        <div class="max-w-4xl px-10 py-6 mx-auto bg-white rounded-lg shadow-md">
                            <div class="flex items-center justify-between"><span class="font-light text-gray-600">Feb 14,
                                2019</span><a href="#"
                                              class="px-2 py-1 font-bold text-gray-100 bg-gray-600 rounded hover:bg-gray-500">PHP</a>
                            </div>
                            <div class="mt-2"><a href="#" class="text-2xl font-bold text-gray-700 hover:underline">PHP:
                                    Array to Map</a>
                                <p class="mt-2 text-gray-600">Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                                    Tempora expedita dicta totam aspernatur doloremque. Excepturi iste iusto eos enim
                                    reprehenderit nisi, accusamus delectus nihil quis facere in modi ratione libero!</p>
                            </div>
                            <div class="flex items-center justify-between mt-4"><a href="#"
                                                                                   class="text-blue-500 hover:underline">Read more</a>
                                <div><a href="#" class="flex items-center"><img
                                                src="https://images.unsplash.com/photo-1531251445707-1f000e1e87d0?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=281&amp;q=80"
                                                alt="avatar" class="hidden object-cover w-10 h-10 mx-4 rounded-full sm:block">
                                        <h1 class="font-bold text-gray-700 hover:underline">Lisa Way</h1>
                                    </a></div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-6">
                        <div class="max-w-4xl px-10 py-6 mx-auto bg-white rounded-lg shadow-md">
                            <div class="flex items-center justify-between"><span class="font-light text-gray-600">Dec 23,
                                2018</span><a href="#"
                                              class="px-2 py-1 font-bold text-gray-100 bg-gray-600 rounded hover:bg-gray-500">Django</a>
                            </div>
                            <div class="mt-2"><a href="#" class="text-2xl font-bold text-gray-700 hover:underline">Django
                                    Dashboard - Learn by Coding</a>
                                <p class="mt-2 text-gray-600">Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                                    Tempora expedita dicta totam aspernatur doloremque. Excepturi iste iusto eos enim
                                    reprehenderit nisi, accusamus delectus nihil quis facere in modi ratione libero!</p>
                            </div>
                            <div class="flex items-center justify-between mt-4"><a href="#"
                                                                                   class="text-blue-500 hover:underline">Read more</a>
                                <div><a href="#" class="flex items-center"><img
                                                src="https://images.unsplash.com/photo-1500757810556-5d600d9b737d?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=735&amp;q=80"
                                                alt="avatar" class="hidden object-cover w-10 h-10 mx-4 rounded-full sm:block">
                                        <h1 class="font-bold text-gray-700 hover:underline">Steve Matt</h1>
                                    </a></div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-6">
                        <div class="max-w-4xl px-10 py-6 mx-auto bg-white rounded-lg shadow-md">
                            <div class="flex items-center justify-between"><span class="font-light text-gray-600">Mar 10,
                                2018</span><a href="#"
                                              class="px-2 py-1 font-bold text-gray-100 bg-gray-600 rounded hover:bg-gray-500">Testing</a>
                            </div>
                            <div class="mt-2"><a href="#" class="text-2xl font-bold text-gray-700 hover:underline">TDD
                                    Frist</a>
                                <p class="mt-2 text-gray-600">Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                                    Tempora expedita dicta totam aspernatur doloremque. Excepturi iste iusto eos enim
                                    reprehenderit nisi, accusamus delectus nihil quis facere in modi ratione libero!</p>
                            </div>
                            <div class="flex items-center justify-between mt-4"><a href="#"
                                                                                   class="text-blue-500 hover:underline">Read more</a>
                                <div><a href="#" class="flex items-center"><img
                                                src="https://images.unsplash.com/photo-1502980426475-b83966705988?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=373&amp;q=80"
                                                alt="avatar" class="hidden object-cover w-10 h-10 mx-4 rounded-full sm:block">
                                        <h1 class="font-bold text-gray-700 hover:underline">Khatab Wedaa</h1>
                                    </a></div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-8">
                        <div class="flex">
                            <a href="#" class="px-3 py-2 mx-1 font-medium text-gray-500 bg-white rounded-md cursor-not-allowed">
                                previous
                            </a>

                            <a href="#" class="px-3 py-2 mx-1 font-medium text-gray-700 bg-white rounded-md hover:bg-blue-500 hover:text-white">
                                1
                            </a>

                            <a href="#" class="px-3 py-2 mx-1 font-medium text-gray-700 bg-white rounded-md hover:bg-blue-500 hover:text-white">
                                2
                            </a>

                            <a href="#" class="px-3 py-2 mx-1 font-medium text-gray-700 bg-white rounded-md hover:bg-blue-500 hover:text-white">
                                3
                            </a>

                            <a href="#" class="px-3 py-2 mx-1 font-medium text-gray-700 bg-white rounded-md hover:bg-blue-500 hover:text-white">
                                Next
                            </a>
                        </div>
                    </div>
                </div>
                <div class="hidden w-4/12 -mx-8 lg:block">
                    <div class="px-8">
                        <h1 class="mb-4 text-xl font-bold text-gray-700">Authors</h1>
                        <div class="flex flex-col max-w-sm px-6 py-4 mx-auto bg-white rounded-lg shadow-md">
                            <ul class="-mx-4">
                                <li class="flex items-center"><img
                                            src="https://images.unsplash.com/photo-1492562080023-ab3db95bfbce?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=731&amp;q=80"
                                            alt="avatar" class="object-cover w-10 h-10 mx-4 rounded-full">
                                    <p><a href="#" class="mx-1 font-bold text-gray-700 hover:underline">Alex John</a><span
                                                class="text-sm font-light text-gray-700">Created 23 Posts</span></p>
                                </li>
                                <li class="flex items-center mt-6"><img
                                            src="https://images.unsplash.com/photo-1464863979621-258859e62245?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=333&amp;q=80"
                                            alt="avatar" class="object-cover w-10 h-10 mx-4 rounded-full">
                                    <p><a href="#" class="mx-1 font-bold text-gray-700 hover:underline">Jane Doe</a><span
                                                class="text-sm font-light text-gray-700">Created 52 Posts</span></p>
                                </li>
                                <li class="flex items-center mt-6"><img
                                            src="https://images.unsplash.com/photo-1531251445707-1f000e1e87d0?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=281&amp;q=80"
                                            alt="avatar" class="object-cover w-10 h-10 mx-4 rounded-full">
                                    <p><a href="#" class="mx-1 font-bold text-gray-700 hover:underline">Lisa Way</a><span
                                                class="text-sm font-light text-gray-700">Created 73 Posts</span></p>
                                </li>
                                <li class="flex items-center mt-6"><img
                                            src="https://images.unsplash.com/photo-1500757810556-5d600d9b737d?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=735&amp;q=80"
                                            alt="avatar" class="object-cover w-10 h-10 mx-4 rounded-full">
                                    <p><a href="#" class="mx-1 font-bold text-gray-700 hover:underline">Steve Matt</a><span
                                                class="text-sm font-light text-gray-700">Created 245 Posts</span></p>
                                </li>
                                <li class="flex items-center mt-6"><img
                                            src="https://images.unsplash.com/photo-1502980426475-b83966705988?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=373&amp;q=80"
                                            alt="avatar" class="object-cover w-10 h-10 mx-4 rounded-full">
                                    <p><a href="#" class="mx-1 font-bold text-gray-700 hover:underline">Khatab
                                            Wedaa</a><span class="text-sm font-light text-gray-700">Created 332 Posts</span>
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="px-8 mt-10">
                        <h1 class="mb-4 text-xl font-bold text-gray-700">Categories</h1>
                        <div class="flex flex-col max-w-sm px-4 py-6 mx-auto bg-white rounded-lg shadow-md">
                            <ul>
                                <li><a href="#" class="mx-1 font-bold text-gray-700 hover:text-gray-600 hover:underline">-
                                        AWS</a></li>
                                <li class="mt-2"><a href="#"
                                                    class="mx-1 font-bold text-gray-700 hover:text-gray-600 hover:underline">-
                                        Laravel</a></li>
                                <li class="mt-2"><a href="#"
                                                    class="mx-1 font-bold text-gray-700 hover:text-gray-600 hover:underline">- Vue</a>
                                </li>
                                <li class="mt-2"><a href="#"
                                                    class="mx-1 font-bold text-gray-700 hover:text-gray-600 hover:underline">-
                                        Design</a></li>
                                <li class="flex items-center mt-2"><a href="#"
                                                                      class="mx-1 font-bold text-gray-700 hover:text-gray-600 hover:underline">-
                                        Django</a></li>
                                <li class="flex items-center mt-2"><a href="#"
                                                                      class="mx-1 font-bold text-gray-700 hover:text-gray-600 hover:underline">- PHP</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="px-8 mt-10">
                        <h1 class="mb-4 text-xl font-bold text-gray-700">Recent Post</h1>
                        <div class="flex flex-col max-w-sm px-8 py-6 mx-auto bg-white rounded-lg shadow-md">
                            <div class="flex items-center justify-center"><a href="#"
                                                                             class="px-2 py-1 text-sm text-green-100 bg-gray-600 rounded hover:bg-gray-500">Laravel</a>
                            </div>
                            <div class="mt-4"><a href="#" class="text-lg font-medium text-gray-700 hover:underline">Build
                                    Your New Idea with Laravel Freamwork.</a></div>
                            <div class="flex items-center justify-between mt-4">
                                <div class="flex items-center"><img
                                            src="https://images.unsplash.com/photo-1492562080023-ab3db95bfbce?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=731&amp;q=80"
                                            alt="avatar" class="object-cover w-8 h-8 rounded-full"><a href="#"
                                                                                                      class="mx-3 text-sm text-gray-700 hover:underline">Alex John</a></div><span
                                        class="text-sm font-light text-gray-600">Jun 1, 2020</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-32 grid grid-cols-3 gap-4">
        @foreach($posts as $post)
            @include('zeus-sky::blogs.partial.post')
        @endforeach
    </div>
</x-zeus::layouts.app>
