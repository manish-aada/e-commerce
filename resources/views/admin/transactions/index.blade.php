@extends('layouts.app')

@section('title', 'Transactions')

@section('content')
<div class="container mt-5">
	<h3>Transactions List</h3>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>Transaction ID</th>
				<th>Order ID</th>
				<th>Amount</th>
				<th>Payment Method</th>
				<th>Status</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($transactions as $transaction)
				<tr>
					<td>{{ $transaction->id }}</td>
					<td>{{ $transaction->order_id }}</td>
					<td>${{ number_format($transaction->amount, 2) }}</td>
					<td>{{ $transaction->payment_method }}</td>
					<td>{{ $transaction->status }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>
@endsection
