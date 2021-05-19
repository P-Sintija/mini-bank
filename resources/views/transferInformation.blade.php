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

<br><br><br>

Account Number: {{ $userAccount->account_number }} currency: {{ $userAccount->currency }}
<br>
Your Balance: {{ $userAccount->balance }} {{  $userAccount->currency }}
<br>

Recipients name: {{ $recipientsAccount->name }} {{ $recipientsAccount->surname }}
<br>
Recipients account number: {{ $recipientsAccount->account_number}}
<br>
@if( $userAccount->currency != $recipientsAccount->currency )
    {{ $amount }} {{ $userAccount->currency }} = {{ $total }} {{ $recipientsAccount->currency }}
@else
    {{ $total }} {{ $recipientsAccount->currency }}
@endif


<form method="POST" action="/transfer/{{  $userAccount->id }}">
    @csrf
    <button type="submit"> Transfer
    </button>
</form>

<form method="GET" action="{{ route('transactionForm.show',['id' => $userAccount->id]) }}">
    <button type="submit"> Back to account
    </button>
</form>

</body>
</html>

