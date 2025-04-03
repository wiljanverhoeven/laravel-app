<h1>Confirm Your Booking</h1>

@if(session('error'))
    <p style="color: red;">{{ session('error') }}</p>
@endif

<p>Festival: {{ $booking['festival_id'] }}</p>
<p>Bus Route: {{ $booking['bus_route_id'] }}</p>
<p>Seats: {{ $booking['seats'] }}</p>

<p>Your current points: {{ $userPoints }}</p>

<form action="{{ route('process.payment') }}" method="POST">
    @csrf
    
    @if($canUsePoints)
        <p>You have enough points to use for a 30% discount (10 points required).</p>
        <label for="use_points">Use points for discount?</label>
        <input type="checkbox" name="use_points" id="use_points" value="1" {{ old('use_points') ? 'checked' : '' }}>
    @else
        <p>You don't have enough points to use for a discount.</p>
    @endif
    
    <button type="submit">Proceed to Payment</button>
</form>