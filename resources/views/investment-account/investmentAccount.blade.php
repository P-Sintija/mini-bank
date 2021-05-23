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
                <form method="GET" action="{{ route('basicAccount.index',['id' => $account->basic_account_id]) }}">
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
            @if(session()->has('message'))
                <div class="mx-10 my-2">
                    <div class="mt-2 flex px-4 py-4 justify-between bg-green-50
				dark:bg-gray-600 shadow-xl rounded-lg cursor-pointer ">
                        <!-- Card -->
                        <div class="bg-green-50 p-4 rounded flex items-start text-green-600 ">
                            <div class="text-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="fill-current w-5 pt-1"
                                     viewBox="0 0 24 24">
                                    <path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373
                                12-12-5.373-12-12-12zm-1.959 17l-4.5-4.319 1.395-1.435 3.08 2.937
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
                <div class="mt-2 flex px-4 py-4 justify-between bg-white
				dark:bg-gray-600 shadow-xl rounded-lg cursor-pointer">
                    <div class=" flex flex-col  flex justify-between">
                        <div class="ml-4 my-4 flex capitalize text-2xl text-gray-600 dark:text-gray-400">
                            <span>Account information</span>
                        </div>
                        <div class="flex flex-row">
                            <div class="ml-4 mt-2 flex flex-col capitalize text-gray-600dark:text-gray-400">
                                <span>Account number</span>
                                <span>Investment balance</span>
                                <span>Actual balance</span>
                                <form method="POST"
                                      action="{{ route('deposit.edit',['id' => $account->basic_account_id]) }}"
                                      class="flex items-center justify-between mt-4">
                                    @csrf
                                    <input class=" mt-3 shadow appearance-none border rounded w-full py-2
                                px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                           name="amount" id="amount" type="text" placeholder="Amount">
                                    <button class="w-3/5 mt-3 ml-3 bg-green-700 hover:bg-green-500 text-white font-bold
                                py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                            type="submit" name="investmentAccountId" value="{{ $account->id }}">
                                        Deposit
                                    </button>
                                </form>

                                <form method="POST"
                                      action="{{ route('withdrawal.edit',['id' => $account->basic_account_id]) }}"
                                      class="flex items-center justify-between mt-4">
                                    @csrf
                                    <input class=" mt-3 shadow appearance-none border rounded w-full py-2
                                px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                           name="amount" id="amount" type="text" placeholder="Amount">
                                    <button class=" mt-3 ml-3 bg-green-700 hover:bg-green-500 text-white
                                font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                            type="submit" name="investmentAccountId" value="{{ $account->id }}">
                                        Withdrawal
                                    </button>
                                </form>
                            </div>
                            <div class="flex flex-col capitalize mt-2 ml-4 text-black dark:text-gray-200">
                        <span>
                         {{ $account->account_number }}
                        </span>
                                <span>
						{{ number_format($account->investment_amount / 100 , 2) }} {{ $account->currency }}
						</span>
                                <span>
                         {{ number_format($account->actual_balance / 100 , 2) }} {{ $account->currency }}
                        </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mx-10 my-2">
                <div class="mt-2 flex px-4 py-4 justify-between bg-white
				dark:bg-gray-600 shadow-xl rounded-lg cursor-pointer ">
                    <div class=" flex flex-col  flex justify-between">
                        <div class="ml-4 my-4 flex capitalize text-2xl text-gray-600 dark:text-gray-400">
                            <span>Buy stock</span>
                        </div>
                        <div class="flex flex-row">
                            <div class="ml-4 mt-2 flex flex-col capitalize text-gray-600 dark:text-gray-400">
                                <form method="GET" action="{{ route('stock.index') }}"
                                      class="flex items-center justify-between mt-4">
                                    @csrf
                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="symbol">
                                            Symbol
                                        </label>
                                        <input class="shadow appearance-none border rounded w-full py-2
                                    px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                               name="symbol" id="symbol" type="text" placeholder="Symbol">
                                    </div>
                                    <div class=" ml-4 mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="number">
                                            Number
                                        </label>
                                        <input class="shadow appearance-none border rounded w-full py-2
                                    px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                               name="number" id="number" type="text" placeholder="Number">
                                    </div>
                                    <button class=" mt-3 ml-3 bg-green-700 hover:bg-green-500 text-white
                                font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                            type="submit" name="basicAccountId"
                                            value="{{ $account->basic_account_id }}">
                                        Get price
                                    </button>
                                </form>
                                @if(session()->has('_stockData'))
                                    <div class="flex flex-col mt-2 ml-4 text-black dark:text-gray-200">
                        <span>
                            {{ session()->get('_stockData')->numberOf() }} of
                            {{ session()->get('_stockData')->symbol() }} will cost you
                            {{ number_format(session()->get('_stockData')->costs() /100, 2) }} USD
                        </span>
                                    </div>
                                    <form method="POST" action="{{ route('stock.store') }}">
                                        @csrf
                                        <button class=" mt-3 ml-3 bg-green-700 hover:bg-green-500 text-white
                                     font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                                type="submit" name="basicAccountId"
                                                value="{{ $account->basic_account_id }}">
                                            Buy
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="mx-10 my-2">
                <!-- Table -->
                <div class="mt-8 flex justify-between bg-white
				dark:bg-gray-600 shadow-xl rounded-lg cursor-pointer w-full ">
                    <div class=" flex flex-col items-center justify-center w-full">
                        <table class="min-w-max w-full table-auto">
                            <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">Symbol</th>
                                <th class="py-3 px-6 text-left">Number</th>
                                <th class="py-3 px-6 text-center">Costs (USD)</th>
                                <th class="py-3 px-6 text-center">Current price (USD)</th>
                                <th class="py-3 px-6 text-center"></th>
                            </tr>
                            </thead>
                            <tbody class="text-gray-600 text-m font-light">
                            @foreach( $stocks as $stock)
                                <tr class="border-b border-gray-200 hover:bg-gray-100">
                                    <td class="py-3 px-6 text-left whitespace-nowrap">
                                        <div class="flex items-center">
                                            <span class="font-medium">  {{ $stock->symbol }}</span>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-left">
                                        <div class="flex items-center">
                                            <span>{{ $stock->number_of }}</span>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex items-center justify-center">
                                            <span>{{ number_format($stock->costs / 100, 2) }}</span>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex items-center justify-center">
                                            <span> {{ number_format($currentPrices[$stock->symbol] * $stock->number_of /100, 2) }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex items-center justify-center">
                                            <form method="POST"
                                                  action="{{ route('stock.sell',['id' => $stock->id ]) }}">
                                                @method('DELETE')
                                                @csrf
                                                <button
                                                    class="bg-green-200 text-green-600 py-1 px-3 rounded-full text-xs"
                                                    type="submit" name="investmentAccountId" value="{{ $account->id }}">
                                                    Completed
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </main>
    </div>
@endsection
