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
    <nav class="flex flex-col bg-gray-200 dark:bg-gray-900 w-64 px-12 pt-4 pb-6">

        <!-- SideNavBar -->
        <div class="mt-8">
            <img
                class="h-26 w-26 rounded-full object-cover"
                src="/logo.jpg"
                alt="?"/>
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
    <main
        class="flex-1 flex flex-col bg-gray-100 dark:bg-gray-700 transition
		duration-500 ease-in-out overflow-y-auto">

        <!-- header-->
        <div class="mx-10 my-2">
            <span
                class="my-4 text-4xl font-semibold dark:text-gray-400">
                {{ $account->name }} {{$account->surname}}
            </span>
            <span class=" text-4xl font-semibold text-green-600 dark:text-green-300">
					( {{$account->User_ID}} )
            </span>
        </div>


        <!-- info -->
        <div class="mx-10 my-2">

            <!-- Table -->
            <div
                class="mt-8 flex justify-between bg-white
				dark:bg-gray-600 shadow-xl rounded-lg cursor-pointer w-full ">
                <div class=" flex flex-col items-center justify-center w-full">


                    <table class="min-w-max w-full table-auto">
                        <thead>
                        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">Name Surname</th>
                            <th class="py-3 px-6 text-left">Account number</th>
                            <th class="py-3 px-6 text-center">Amount</th>
                            <th class="py-3 px-6 text-center">Date</th>
                            <th class="py-3 px-6 text-center">Type</th>
                        </tr>
                        </thead>
                        <tbody class="text-gray-600 text-m font-light">

                        @foreach( $history as $transaction)

                            @if($transaction['transactionType'] === 'outgoing')
                                <tr class="border-b border-gray-200 hover:bg-gray-100">
                            @else
                                <tr class="border-b border-gray-200 hover:bg-gray-100 bg-yellow-100">
                                    @endif

                                    <td class="py-3 px-6 text-left whitespace-nowrap">
                                        <div class="flex items-center">
                                        <span
                                            class="font-medium">  {{ $transaction['name'] }} {{ $transaction['surname'] }}</span>
                                        </div>
                                    </td>

                                    <td class="py-3 px-6 text-left">
                                        <div class="flex items-center">
                                            <span>{{ $transaction['accountNumber'] }}</span>
                                        </div>
                                    </td>

                                    <td class="py-3 px-6 text-center">
                                        <div class="flex items-center justify-center">
                                            <span>{{ number_format($transaction['amount'] / 100, 2) }} {{ $transaction['currency'] }}</span>
                                        </div>
                                    </td>

                                    <td class="py-3 px-6 text-center">
                                        <div class="flex items-center justify-center">
                                            <span>{{ $transaction['date'] }}</span>
                                        </div>
                                    </td>


                                    <td class="py-3 px-6 text-center">
                                        <div class="flex items-center justify-center">
                                            <span>{{ $transaction['transactionType'] }}</span>
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

</body>
</html>
