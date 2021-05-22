<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

</head>
<body>

<div class="h-screen w-full flex overflow-hidden">

    <main
        class="flex-1 flex flex-col bg-gray-100 dark:bg-gray-700 transition
		duration-500 ease-in-out overflow-y-auto">

        <!-- session/errors -->
        @if(session()->has('message'))
            <div class="mx-10 my-2">
                <div
                    class="mt-2 flex px-4 py-4 justify-between bg-green-50
				dark:bg-gray-600 shadow-xl rounded-lg cursor-pointer ">
                    <!-- Card -->

                    <div class="bg-green-50 p-4 rounded flex items-start text-green-600 ">
                        <div class="text-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="fill-current w-5 pt-1" viewBox="0 0 24 24">
                                <path
                                    d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.959 17l-4.5-4.319 1.395-1.435 3.08 2.937 7.021-7.183 1.422 1.409-8.418 8.591z"/>
                            </svg>
                        </div>
                        <div class=" px-3">
                            <h3 class="text-green-800 font-semibold tracking-wider">
                                Success
                            </h3>
                            <p class="py-2 text-green-700">
                                {{ session()->get('message') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endif



        @if ($errors->any())
            <div class="mx-10 my-2">
                <div
                    class="mt-2 flex px-4 py-4 justify-between bg-red-50
				dark:bg-gray-600 shadow-xl rounded-lg cursor-pointer ">
                    <!-- Card -->

                    <div class="bg-red-50 p-4 rounded flex items-start text-red-600 ">
                        <div class="text-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="fill-current w-5 pt-1" viewBox="0 0 24 24">
                                <path
                                    d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.959
                                    17l-4.5-4.319 1.395-1.435 3.08 2.937 7.021-7.183 1.422 1.409-8.418 8.591z"/>
                            </svg>
                        </div>

                        <div class=" px-3">
                            <h3 class="text-red-800 font-semibold tracking-wider">
                                Error
                            </h3>
                            @foreach ($errors->all() as $error)
                                <p class="py-2 text-red-700">
                                    {{ $error }}
                                </p>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
    @endif


    <!-- Card -->
        <div class="mx-10 my-2">


            <div
                class="mt-2 flex px-4 py-4 justify-between bg-white
				dark:bg-gray-600 shadow-xl rounded-lg cursor-pointer ">

                <div class="flex flex-1 items-center justify-center">
                    <div class="rounded-lg  px-4 lg:px-24 py-16 lg:max-w-xl sm:max-w-md w-full text-center">
                        <div
                            class="f flex flex-row items-center justify-center ont-bold tracking-wider mb-8 w-full text-gray-600 ">

                            <img class=" h-16 w-16 rounded-full object-cover"
                                 src="/logo.jpg"
                                 alt="?"/>

                            <span class="text-3xl font-semibold text-green-800">
                                Mini Bank
                            </span>

                        </div>

                        <form class="text-center" method="POST" action="{{ route('logIn.logIn') }}">
                            @csrf
                            <div class="py-2 text-left">
                                <input class="bg-gray-200 border-2 border-gray-100 focus:outline-none bg-gray-100
                                    block w-full py-2 px-4 rounded-lg focus:border-gray-700 "
                                       type="text" name="userId" id="login" placeholder="User ID"/>
                            </div>

                            <div class="py-2 text-left">
                                <input class="bg-gray-200 border-2 border-gray-100 focus:outline-none
                                    bg-gray-100 block w-full py-2 px-4 rounded-lg focus:border-gray-700 "
                                       type="password" name="password" id="password" placeholder="Password"/>
                            </div>
                            <div class="py-2">
                                <button class=" w-full bg-green-700 hover:bg-green-500 text-white font-bold py-2 px-4 rounded
                                    focus:outline-none focus:shadow-outline" type="submit">
                                    Log in
                                </button>
                            </div>
                        </form>

                        <div class="text-center mt-12">
                        <span>
                            Don't have an account?
                        </span>
                            <a href="{{ route('registrationForm.show') }}" class="font-light text-md text-green-700 underline
                                font-semibold hover:text-green-500">
                                Create One</a>
                        </div>
                    </div>
                </div>


            </div>
        </div>

    </main>

</div>


</body>
</html>
