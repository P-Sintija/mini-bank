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
            <form method="GET" action="{{ route('basicAccount.index',['id' => $userAccount->id]) }}">
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
                {{ $userAccount->name }} {{$userAccount->surname}}
            </span>
            <span class=" text-4xl font-semibold text-green-600 dark:text-green-300">
					( {{$userAccount->User_ID}} )
            </span>
        </div>

    <!-- info -->
        <div class="mx-10 my-2">

        <div
            class="mt-2 flex px-4 py-4 justify-between bg-white
				dark:bg-gray-600 shadow-xl rounded-lg cursor-pointer ">
            <div class=" flex flex-col  flex justify-between">
                <div
                    class="ml-4 my-4 flex capitalize text-2xl
                        text-gray-600 dark:text-gray-400">
                        <span>
                            Transfer information
                        </span>
                </div>


                <div class="flex flex-row">
                    <div
                        class="ml-4 mt-2 flex flex-col capitalize text-gray-600
						dark:text-gray-400">
                        <span>
                            Account Number
                        </span>
                        <span>
							Your Balance
						</span>
                        <span>
							Recipients name
						</span>
                        <span>
							Recipients account number
						</span>

                        @if( $userAccount->currency != $recipientsAccount->currency )
                            <span class="mt-2 flex flex-col capitalize text-black
						dark:text-green-400 font-semibold">
                            {{ $amount }} {{ $userAccount->currency }} = {{ $total }} {{ $recipientsAccount->currency }}
                       </span>
                        @else
                            <span class="mt-2 flex flex-col capitalize text-black
						dark:text-green-400 font-semibold">
                            {{ $total }} {{ $recipientsAccount->currency }}
                        </span>
                        @endif


                        <form method="POST" action="{{ route('transfer.sendCode',['id' => $userAccount->id]) }}"
                              class="flex items-center justify-between mt-4">
                            @csrf
                            <button class="bg-green-700 hover:bg-green-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                type="submit"> Transfer
                            </button>
                        </form>

                    </div>

                    <div
                        class="flex flex-col capitalize mt-2 ml-4 text-black dark:text-gray-200">
                        <span>
                            {{ $userAccount->account_number }}
                        </span>
                        <span >
							{{ number_format($userAccount->balance / 100, 2) }} {{  $userAccount->currency }}
						</span>

                        <span>
                           {{ $recipientsAccount->name }} {{ $recipientsAccount->surname }}
                        </span>

                        <span>
                            {{ $recipientsAccount->account_number}}
                        </span>

                    </div>

                </div>
            </div>
        </div>

        </div>
    </main>

</div>


</body>
</html>

