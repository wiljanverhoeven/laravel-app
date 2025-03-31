<h1>Upcoming Festivals</h1>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Location</th>
            <th>Start Date</th>
            <th>End Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($festival as $item) {{-- Fix variable name --}}
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->location }}</td>
            <td>{{ $item->start_date->format('Y-m-d H:i') }}</td>
            <td>{{ $item->end_date->format('Y-m-d H:i') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
