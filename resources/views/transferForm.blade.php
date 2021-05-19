<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

Balance: {{ $userAccount->balance }} {{  $userAccount->currency }}

<form method="POST" action="/transactionInfo/{{ $userAccount->id }}">
    @csrf

    <label for="name">Name </label>
    <input type="text" name="name" id="name">

    <br>

    <label for="surname">Surname </label>
    <input type="text" name="surname" id="surname">

    <br>

    <label for="account_number">Account number </label>
    <input type="text" name="account_number" id="account_number">

    <br>
    <label for="amount">Amount </label>
    <input type="text" name="amount" id="amount">

    <br>

    <button type="submit"> Check transaction
    </button>

</form>

@if ($errors != null)
    @foreach ($errors->all() as $error)
        <div >
            {{ $error }}
        </div>
    @endforeach
@endif


<form method="GET" action="{{ route('basicAccount.show',['id' => $userAccount->id]) }}">
    <button type="submit"> Back to account
    </button>
</form>

</body>
</html>
