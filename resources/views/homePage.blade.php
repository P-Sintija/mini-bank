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

Welcome to mini bank

<br><br><br>

@if(session()->has('message'))
        {{ session()->get('message') }}
@endif

<br><br><br>

Log in to user account

<form method="POST" action="/logIn">
@csrf
    <label for="login">User ID: </label>
    <input type="text" name="userId" id="login">

    <br>

    <label for="password">Password: </label>
    <input type="password" name="password" id="password">

    <br>

    <button type="submit"> Log in
    </button>

</form>

@if ($errors != null)
    @foreach ($errors->all() as $error)
        <div >
            {{ $error }}
        </div>
    @endforeach
@endif

Create new account
<form method="GET" action="/registrationForm">
    <button type="submit">New costumer</button>
</form>


</body>
</html>
