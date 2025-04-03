<h1>Booking Confirmed!</h1>

<p>Thank you for your booking.</p>
<p><strong>Booking Reference:</strong> {{ $booking->booking_reference }}</p>

@if ($booking->festival)
    <p><strong>Festival:</strong> {{ $booking->festival->name }}</p>
@else
    <p><strong>Festival:</strong> Not Found</p>
@endif

@if ($booking->busRoute)
    <p><strong>Bus Route:</strong> {{ $booking->busRoute->departure_location }} → {{ $booking->festival->name ?? 'Unknown' }}</p>
@else
    <p><strong>Bus Route:</strong> Not Found</p>
@endif

<p><strong>Number of Seats:</strong> {{ $booking->number_of_seats }}</p>
<p><strong>Total Price:</strong> ${{ number_format($booking->total_price, 2) }}</p>

<a href="{{ route('home') }}" class="btn btn-primary">Back to Home</a>
