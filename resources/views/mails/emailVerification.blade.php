<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mini Bank</title>
</head>
<body>

<div class="container">
    <div class="wrapper">
        <a href="{{ $url . $email }}">
            <button type="submit">
                Click Me to verify
            </button>
        </a>
    </div>
</div>

</body>
</html>

<style>

    .container {
        display: grid;
        place-items: center;
    }

    .wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    button {
        color: white;
        font-weight: bold;
        border: none;
        font-size: larger;
        background-color: teal;
        width: 200px;
        height: 50px;
        border-radius: 20px;
    }

    button:hover {
        background-color: darkseagreen;
    }

</style>
