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

Submission Form
<form method="POST" action="/register">
    @csrf

    <label for="name">Name </label>
    <input type="text" name="name" id="name">

    <br>

    <label for="surname">Surname </label>
    <input type="text" name="surname" id="surname">

    <br>

    <label for="social security number"> Social security number </label>
    <input type="text" name="SSN" id="social security number">

    <br>

    <label for="email">Email </label>
    <input type="text" name="email" id="email">

    <br>

    <label for="password-1">Password </label>
    <input type="password" name="password" id="password-1">

    <br>

    <label for="password-2">Retype password </label>
    <input type="password" name="retypePassword" id="password-2">

    <br>

    <label for="balance">Balance </label>
    <input type="text" name="balance" id="balance">

    <br>

    <label for="currency">Currency </label>
    <select name="currency" id="currency">
        @foreach( $currencies as $currency)
            <option value="{{ $currency['id'] }}"> {{ $currency['symbol'] }}</option>
        @endforeach
    </select>

    <br>

    <button type="submit"> Submit
    </button>

</form>

@if ($errors != null)
    @foreach ($errors->all() as $error)
        <div >
            {{ $error }}
        </div>
    @endforeach
@endif

<form method="GET" action="{{ route('home.show') }}">
    <button type="submit"> back
    </button>
</form>




</body>
</html>
