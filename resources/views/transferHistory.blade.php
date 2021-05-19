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

<table border="2" cellspacing="0" cellpadding="10">
    <tr>
        <th>Name</th>
        <th>Surname</th>
        <th>Account number</th>
        <th>Amount</th>
        <th>Date</th>
        <th>Type</th>
    </tr>
    @foreach( $history as $transaction)
    <tr>
        <td>{{ $transaction['name'] }}</td>
        <td>{{ $transaction['surname'] }}</td>
        <td>{{ $transaction['accountNumber'] }}</td>
        <td>{{ $transaction['amount'] }} {{ $transaction['currency'] }}</td>
        <td>{{ $transaction['date'] }}</td>
        <td>{{ $transaction['transactionType'] }}</td>
    </tr>
    @endforeach
</table>

<form method="GET" action="{{ route('basicAccount.show',['id' => $id]) }}">
    <button type="submit"> Back to account
    </button>
</form>

</body>
</html>
