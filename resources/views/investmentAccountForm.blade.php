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

Invest!Invest!Invest!
<br>

{{ $account->name }} {{ $account->surname }} ( {{ $account->User_ID }} ) <br>

Balance: {{ $account->balance }} {{ $account->currency }} <br>

Investment account number: {{ $investmentAccountNumber }}

<form method="POST" action="/investmentAccountForm/{{ $account->id }}">
    @csrf

    <label for="amount">Amount </label>
    <input type="text" name="amount" id="amount">

    <br>

    <button type="submit" name="$accountNumber" value="{{ $investmentAccountNumber }}"> Submit
    </button>

</form>

@if ($errors != null)
    @foreach ($errors->all() as $error)
        <div >
            {{ $error }}
        </div>
    @endforeach
@endif

</body>
</html>
