@extends('layout')

@section('content')
    <div class="h-screen w-full flex overflow-hidden">
        <nav class="flex flex-col bg-gray-200 dark:bg-gray-900 w-64 px-12 pt-4 pb-6">
            <!-- SideNavBar -->
            <div class="mt-8">
                <img class="h-26 w-26 rounded-full object-cover"
                     src="/logo.jpg" alt="?"/>
            </div>
            <!-- Back Logout -->
            <div class="mt-auto flex items-center text-green-700 dark:text-green-400">
                <form method="GET" action="{{ route('basicAccount.index',['id' => $account->id]) }}">
                    @csrf
                    <button type="submit" class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2M3 12l6.414 6.414a2 2 0
                                  001.414.586H19a2 2 0 002-2V7a2 2 0 00-2-2h-8.172a2 2 0 00-1.414.586L3 12z"/>
                        </svg>
                        <span class="ml-2 capitalize font-medium">Back to account</span>
                    </button>
                </form>
            </div>
        </nav>

        <!-- main -->
        <main class="flex-1 flex flex-col bg-gray-100 dark:bg-gray-700 transition
		duration-500 ease-in-out overflow-y-auto">
            <!-- header-->
            <div class="mx-10 my-2">
            <span class="my-4 text-4xl font-semibold dark:text-gray-400">
                {{ $account->name }} {{$account->surname}}
            </span>
                <span class=" text-4xl font-semibold text-green-600 dark:text-green-300">
					( {{$account->User_ID}} )
            </span>
            </div>
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
                <div class="mt-2 flex px-4 py-4 justify-between bg-white
				dark:bg-gray-600 shadow-xl rounded-lg cursor-pointer ">
                    <div class=" flex flex-col  flex justify-between">
                        <div class="ml-4 my-4 flex capitalize text-2xl text-gray-600 dark:text-gray-400">
                            <span>Create investments account</span>
                        </div>
                        <div class="flex flex-row">
                            <div class="ml-4 mt-2 flex flex-col capitalize text-gray-600 dark:text-gray-400">
                                <span>Balance</span>
                                <span>Investment account number</span>
                                <form method="POST"
                                      action="{{ route('investmentAccountForm.store',['id' => $account->id]) }}"
                                      class="flex items-center justify-between mt-4">
                                    @csrf
                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="amount">
                                            Amount
                                        </label>
                                        <input
                                            class="shadow appearance-none border rounded w-full py-2 px-3
                                        text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            name="amount" id="amount" type="text" placeholder="Amount">
                                    </div>
                                    <button class=" mt-3 ml-3 bg-green-700 hover:bg-green-500 text-white
                                font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                            type="submit" name="accountNumber" value="{{ $investmentAccountNumber }}">
                                        Submit
                                    </button>
                                </form>
                            </div>
                            <div class="flex flex-col capitalize mt-2 ml-4 text-black dark:text-gray-200">
                        <span>
                           {{ number_format($account->balance / 100 , 2) }} {{ $account->currency }}
                        </span>
                                <span>
							{{ $investmentAccountNumber }}
						</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div>
@endsection
