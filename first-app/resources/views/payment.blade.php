<h1>Confirm Your Booking</h1>

@if(session('error'))
    <p style="color: red;">{{ session('error') }}</p>
@endif

<p>Festival: {{ $booking['festival_id'] }}</p>
<p>Bus Route: {{ $booking['bus_route_id'] }}</p>
<p>Seats: {{ $booking['seats'] }}</p>

<form action="{{ route('process.payment') }}" method="POST">
    @csrf
    <button type="submit">Proceed to Payment</button>
</form>
