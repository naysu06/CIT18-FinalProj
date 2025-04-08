<!-- resources/views/admin/dashboard.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - NabanggaNaBa</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow-md p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-800">Admin Dashboard</h1>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Logout</button>
            </form>
        </div>
    </nav>

    <main class="container mx-auto p-8">
        <h2 class="text-xl font-semibold mb-4">Welcome, Admin!</h2>
        <p class="text-gray-700">Manage users, moderate posts, and access administrative features here.</p>
        <!-- Add admin widgets here -->
    </main>
</body>
</html>