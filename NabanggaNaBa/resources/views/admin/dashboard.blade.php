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
        <h2 class="text-xl font-semibold mb-4">Welcome, Admin</h2>

        <!-- Flash Messages Section -->
        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-500 text-white p-4 rounded mb-6">
                {{ session('error') }}
            </div>
        @endif

        <!-- Pending Vehicles Section -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <h3 class="text-lg font-semibold mb-4">Pending Vehicle Posts</h3>
            <table class="min-w-full table-auto border-collapse">
                <thead>
                    <tr>
                        <th class="border-b-2 px-4 py-2 text-left">Plate Number</th>
                        <th class="border-b-2 px-4 py-2 text-left">Model Year</th>
                        <th class="border-b-2 px-4 py-2 text-left">Status</th>
                        <th class="border-b-2 px-4 py-2 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pendingVehicles as $vehicle)
                        <tr>
                            <td class="border-b px-4 py-2">{{ $vehicle->plate_number }}</td>
                            <td class="border-b px-4 py-2">{{ $vehicle->model_year }}</td>
                            <td class="border-b px-4 py-2">{{ ucfirst($vehicle->status) }}</td>
                            <td class="border-b px-4 py-2">
                                <!-- Approve Button -->
                                <form action="{{ route('admin.approve', $vehicle->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Approve</button>
                                </form>

                                <!-- Reject Button -->
                                <form action="{{ route('admin.reject', $vehicle->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Reject</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>