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

Authentication

<form method="POST" action="/authenticateUser/{{ $id }}">
    @csrf
    <label for="twoFactorCode">Code: </label>
    <input type="text" name="twoFactorCode" id="twoFactorCode">
    <button type="submit">
        Submit
    </button>
</form>

<form method="POST" action="/refreshCode/{{ $id }}">
    @csrf
    <button type="submit">
        Send again
    </button>
</form>


</body>
</html>
