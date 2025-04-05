<x-layout>
    <h2>Edit Profile</h2>

    @if(session('status'))
        <div style="color: green;">
            {{ session('status') }}
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        @method('PATCH')

        <label>Name:</label>
        <input type="text" name="name" value="{{ old('name', $user->name) }}" required><br>

        <label>Email:</label>
        <input type="email" name="email" value="{{ old('email', $user->email) }}" required><br>

        <label>Password (leave blank to keep current):</label>
        <input type="password" name="password"><br>

        <label>Confirm Password:</label>
        <input type="password" name="password_confirmation"><br>

        <button type="submit">Save Changes</button>
    </form>

    <form action="{{ route('profile.destroy') }}" method="POST" onsubmit="return confirm('Are you sure you want to delete your account?');">
        @csrf
        @method('DELETE')
        <button type="submit" style="color: red;">Delete Account</button>
    </form>
</x-layout>
