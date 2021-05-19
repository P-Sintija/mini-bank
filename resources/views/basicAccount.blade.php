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

@if(session()->has('message'))
    {{ session()->get('message') }}
@endif


User name surname (user_id)
<br>
{{ $account->name }} {{$account->surname}} ( {{$account->User_ID}} )
<br>
<br>
personal information:
<br>
email- {{ $account->email }}
<br>
SSN- {{ $account->SSN }}
<br>
<br>
account information:
<br>
account number ; account currency
<br> {{ $account->account_number }}; {{ $account->currency }}
<br>
account balance
{{ $account->balance }}
<br>
<br>

<form method="GET" action="/transactionForm/{{ $account->id }}">
    <button type="submit"  >Transfer</button>
</form>

<br>
<form method="GET" action="/transferHistory/{{ $account->id }}">
    <button type="submit"  >Transfer History</button>
</form>

<br>
Create investment account
<form method="GET" action="/investmentAccountForm/{{ $account->id }}">
    <button type="submit"  >Create Investment account</button>
</form>

<br>
Investment account
<form method="GET" action="/investmentAccount/{{ $account->id }}">
    <button type="submit"  >Create Investment account</button>
</form>



create invest account button
<br>
<form method="POST" action="/logout">
    @csrf
    <button type="submit"  >Logout</button>
</form>






</body>
</html>
