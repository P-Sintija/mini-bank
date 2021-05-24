@extends('layout')

@section('content')
    <div class="h-screen w-full flex overflow-hidden">
        <nav class="flex flex-col bg-gray-200 dark:bg-gray-900 w-64 px-12 pt-4 pb-6">

            <!-- SideNavBar -->
            <div class="mt-8">
                <img class="h-26 w-26 rounded-full object-cover"
                     src="/logo.jpg" alt="?"/>
            </div>
            <!-- Links -->
            <ul class="mt-2 text-green-600">
                <li class="mt-8 ">
                    <a href="{{ route('transferForm.show',['id' => $account->id]) }}" class="flex ">
                    <span class="ml-2 capitalize font-medium dark:text-green-300">
						Transfer
					</span>
                    </a>
                </li>
                <li class="mt-8">
                    <a href="{{ route('transferHistory.show',['id' => $account->id]) }}" class="flex ">
                    <span class="ml-2 capitalize font-medium dark:text-green-300">
						Transfer History
					</span>
                    </a>
                </li>
                <li class="mt-8">
                    @if($account->investment_account_id == null)
                        <a href="{{ route('investmentAccountForm.show',['id' => $account->id]) }}" class="flex">
                    <span class="ml-2 capitalize font-medium dark:text-green-300">
						Create Investment account
					</span>
                        </a>
                    @else
                        <a href="{{ route('investmentAccount.index',['id' => $account->id]) }}" class="flex">
                    <span class="ml-2 capitalize font-medium dark:text-green-300">
						Investment account
					</span>
                        </a>
                    @endif
                </li>
            </ul>
            <!-- Logout -->
            <div class="mt-auto flex items-center text-red-700 dark:text-red-400">
                <form method="POST" action="/logout">
                    @csrf
                    <button type="submit" class="flex items-center">
                        <svg class="fill-current h-5 w-5" viewBox="0 0 24 24">
                            <path d="M16 17v-3H9v-4h7V7l5 5-5 5M14 2a2 2 0 012 2v2h-2V4H5v16h9v-2h2v2a2
                        2 0 01-2 2H5a2 2 0 01-2-2V4a2 2 0 012-2h9z"></path>
                        </svg>
                        <span class="ml-2 capitalize font-medium">Log out</span>
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
            @if(session()->has('message'))
                <div class="mx-10 my-2">
                    <div class="mt-2 flex px-4 py-4 justify-between bg-green-50
				dark:bg-gray-600 shadow-xl rounded-lg cursor-pointer ">
                        <!-- Card -->
                        <div class="bg-green-50 p-4 rounded flex items-start text-green-600 ">
                            <div class="text-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="fill-current w-5 pt-1"
                                     viewBox="0 0 24 24">
                                    <path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12
                             12-5.373 12-12-5.373-12-12-12zm-1.959 17l-4.5-4.319 1.395-1.435 3.08 2.937
                             7.021-7.183 1.422 1.409-8.418 8.591z"/>
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

        <!-- info -->
            <div class="mx-10 my-2">
                <!-- Card -->
                <div class="mt-2 flex px-4 py-4 justify-between bg-white
				dark:bg-gray-600 shadow-xl rounded-lg cursor-pointer ">
                    <div class=" flex flex-col  flex justify-between">
                        <div class="ml-4 my-4 flex capitalize text-2xl text-gray-600 dark:text-gray-400">
                        <span>
                            Personal information
                        </span>
                        </div>
                        <div class="flex flex-row">
                            <div class="ml-4 mt-2 flex flex-col capitalize text-gray-600 dark:text-gray-400">
                                <span>Email</span>
                                <span>Social Security Number</span>
                            </div>
                            <div class="ml-12 mt-2 flex flex-col capitalize text-black dark:text-gray-200">
                                <span>{{ $account->email }}</span>
                                <span>{{ $account->SSN }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card -->
                <div class="mt-8 flex px-4 py-4 justify-between bg-white
				dark:bg-gray-600 shadow-xl rounded-lg cursor-pointer">
                    <div class=" flex flex-col  flex justify-between">
                        <div class="ml-4 my-4 flex capitalize text-2xl text-gray-600 dark:text-gray-400">
                            <span>Account information</span>
                        </div>
                        <div class="flex flex-row">
                            <div class="ml-4 mt-2 flex flex-col capitalize text-gray-600
						dark:text-gray-400">
                                <span>Account number</span>
                                <span>Balance</span>
                            </div>
                            <div class="ml-12 mt-2 flex flex-col text-black dark:text-gray-200">
                                <span>{{ $account->account_number }}</span>
                                <span>
							{{ number_format($account->balance / 100 , 2) }} {{ $account->currency }}
						</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div>
@endsection
