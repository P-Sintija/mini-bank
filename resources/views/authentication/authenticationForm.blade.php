@extends('layout')


@section('content')
    <div class="h-screen w-full flex overflow-hidden">
        <nav class="flex flex-col bg-gray-200 dark:bg-gray-900 w-64 px-12 pt-4 pb-6">
            <!-- SideNavBar -->
            <div class="mt-8">
                <img class="h-26 w-26 rounded-full object-cover"
                     src="/logo.jpg" alt="?"/>
            </div>
        </nav>
        <!-- main -->
        <main class="flex-1 flex flex-col bg-gray-100 dark:bg-gray-700 transition
		duration-500 ease-in-out overflow-y-auto">
            <!-- session/errors -->
            @if ($errors->any())
                <div class="mx-10 my-2">
                    <div class="mt-2 flex px-4 py-4 justify-between bg-red-50
				dark:bg-gray-600 shadow-xl rounded-lg cursor-pointer ">
                        <!-- Card -->
                        <div class="bg-red-50 p-4 rounded flex items-start text-red-600 ">
                            <div class="text-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="fill-current w-5 pt-1"
                                     viewBox="0 0 24 24">
                                    <path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373
                                12-12-5.373-12-12-12zm-1.959 17l-4.5-4.319 1.395-1.435 3.08 2.937
                                7.021-7.183 1.422 1.409-8.418 8.591z"/>
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
        <!-- info -->
            <div class="mx-10 my-2">
                <!-- Form -->
                <div class="mt-8 flex justify-between bg-white
				dark:bg-gray-600 shadow-xl rounded-lg cursor-pointer">
                    <div>
                        <form id="form" class="bg-white rounded-lg px-8 pt-6 pb-8 "
                              method="POST" action="{{ route('authenticateUser.verification',['id' => $id]) }}">
                            @csrf
                            <h1 class=" flex capitalize text-2xl text-gray-600 dark:text-gray-400">
                                Enter your authentication code
                            </h1>
                            <br>
                            <label for="twoFactorCode"> </label>
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700
                        leading-tight focus:outline-none focus:shadow-outline" placeholder="authentication code"
                                   type="text" name="twoFactorCode" id="twoFactorCode">
                            <div class="flex items-center justify-between mt-8">
                                <button class="bg-green-700 hover:bg-green-500 text-white font-bold py-2 px-4 rounded
                                    focus:outline-none focus:shadow-outline"
                                        id="submit" type="submit">
                                    Submit
                                </button>
                            </div>
                        </form>
                        <form class="bg-white px-8 pb-8 mb-4" method="POST"
                              action="{{ route('refreshCode.update',['id' => $id]) }}">
                            @csrf
                            @method('PUT')
                            <div class="flex items-center justify-between mt-4">
                                <button class="bg-white border hover:bg-green-500 text-green-700 hover:text-white
                                    font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                        id="submit" type="submit">
                                    Send again
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </main>
    </div>
@endsection
