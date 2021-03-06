@extends('layout')

@section('content')

<div class="h-screen w-full flex overflow-hidden">
    <!-- SideNavBar -->
    <nav class="flex flex-col bg-gray-200 dark:bg-gray-900 w-64 px-12 pt-4 pb-6">
        <div class="mt-8">
            <img class="h-26 w-26 rounded-full object-cover"
                src="/logo.jpg" alt="?"/>
        </div>
        <!-- Back Logout -->
        <div class="mt-auto flex items-center text-green-700 dark:text-green-400">
            <form method="GET" action="{{ route('home.show') }}">
                <button type="submit" class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2M3 12l6.414 6.414a2 2 0
                                  001.414.586H19a2 2 0 002-2V7a2 2 0 00-2-2h-8.172a2 2 0 00-1.414.586L3 12z"/>
                    </svg>
                    <span class="ml-2 capitalize font-medium">Back</span>
                </button>
            </form>
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
                                12-12-5.373-12-12-12zm-1.959 17l-4.5-4.319 1.395-1.435 3.08
                                2.937 7.021-7.183 1.422 1.409-8.418 8.591z"/>
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
                <div class=" flex flex-col items-center justify-center">
                    <form id="form" class="bg-white rounded-lg px-8 pt-6 pb-8 mb-4 "
                          method="POST" action="{{ route('register.validation') }}">
                        @csrf
                        <br>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                                Name
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700
                                leading-tight focus:outline-none focus:shadow-outline"
                                name="name" id="name" type="text" placeholder="Name">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="surname">
                                Surname
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700
                                leading-tight focus:outline-none focus:shadow-outline"
                                name="surname" id="surname" type="text" placeholder="Surname">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="social security number">
                                Social security number
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700
                                leading-tight focus:outline-none focus:shadow-outline"
                                name="SSN" id="social security number" type="text" placeholder="Social security number">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                                Email
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700
                                leading-tight focus:outline-none focus:shadow-outline"
                                name="email" id="email" type="text" placeholder="Email">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="password-1">
                                Password
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700
                                leading-tight focus:outline-none focus:shadow-outline"
                                name="password" id="password-1" type="password" placeholder="Password">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="password-2">
                                Retype password
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700
                                leading-tight focus:outline-none focus:shadow-outline"
                                name="retypePassword" id="password-2" type="password" placeholder="Retype password">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="balance">
                                Balance
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700
                                leading-tight focus:outline-none focus:shadow-outline"
                                name="balance" id="balance" type="text" placeholder="Balance">
                        </div>
                        <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="currency">
                            Currency </label>
                        <select name="currency" id="currency">
                            @foreach( $currencies as $currency)
                                <option value="{{ $currency['id'] }}"> {{ $currency['symbol'] }}</option>
                            @endforeach
                        </select>
                        </div>
                        <div class="flex items-center justify-between">
                            <button id="submit"
                                    class="bg-green-700 hover:bg-green-500 text-white font-bold py-2 px-4 rounded
                                    focus:outline-none focus:shadow-outline"
                                    type="submit"> Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </main>
</div>
@endsection
