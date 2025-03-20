<h1>Upcoming Festivals</h1>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Location</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Active</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($festival as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->description }}</td>
            <td>{{ $item->location }}</td>
            <td>{{ $item->start_date->format('Y-m-d H:i') }}</td>
            <td>{{ $item->end_date->format('Y-m-d H:i') }}</td>
            <td>{{ $item->is_active ? 'Yes' : 'No' }}</td>
           
        </tr>
        @endforeach
    </tbody>
</table>