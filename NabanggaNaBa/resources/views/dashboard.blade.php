<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    @extends('app')

    @section('title', 'Dashboard - NabanggaNaBa')

    @section('content')
        <h1 class="text-4xl font-bold">Welcome to the Dashboard, {{ auth()->user()->username }}!</h1>
        
        <!-- Logout Form -->
        <form action="{{ route('auth.destroy', auth()->user()->id) }}" method="POST" class="mt-4"
            onsubmit="return confirm('Are you sure you want to logout?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-lg cursor-pointer">
                Logout
            </button>
        </form>
    @endsection
</body>
</html>