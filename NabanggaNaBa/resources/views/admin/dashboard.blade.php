<!DOCTYPE html>
<html lang="en">
<head>
<<<<<<< HEAD
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
=======
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard | NabanggaNaBa</title>
    @vite('resources/css/app.css')
    <script src="https://unpkg.com/@phosphor-icons/web"></script> <!-- Icon library -->
</head>
<body class="bg-gradient-to-br from-gray-100 via-white to-gray-100 text-gray-800 font-sans">

    <!-- Navbar -->
    <nav class="bg-white shadow-md border-b sticky top-0 z-50">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-extrabold text-indigo-600 tracking-tight">NabanggaNaBa Admin</h1>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="bg-red-500 hover:bg-red-600 text-white font-semibold px-4 py-2 rounded-lg shadow-md transition duration-200">
                    <i class="ph ph-sign-out mr-2"></i> Logout
                </button>
>>>>>>> dev4
            </form>
        </div>
    </nav>

<<<<<<< HEAD
    <main class="container mx-auto p-8">
        <h2 class="text-xl font-semibold mb-4">Welcome, Admin</h2>

        <!-- Flash Messages Section -->
        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-6">
=======
    <!-- Main Content -->
    <main class="container mx-auto px-6 py-10">
        <!-- Welcome Message -->
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-gray-900">Welcome, Admin 👋</h2>
            <p class="text-gray-600 mt-2">Monitor, approve, or reject vehicle posts efficiently.</p>
        </div>

        <!-- Flash Messages -->
        @if(session('success'))
            <div class="bg-green-100 text-green-800 border border-green-300 px-4 py-3 rounded-lg mb-6 shadow">
>>>>>>> dev4
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
<<<<<<< HEAD
            <div class="bg-red-500 text-white p-4 rounded mb-6">
=======
            <div class="bg-red-100 text-red-800 border border-red-300 px-4 py-3 rounded-lg mb-6 shadow">
>>>>>>> dev4
                {{ session('error') }}
            </div>
        @endif

        <!-- Pending Vehicles Section -->
<<<<<<< HEAD
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
=======
        <section class="bg-white shadow-lg rounded-2xl p-6 border border-gray-200">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-semibold text-gray-800 flex items-center gap-2">
                    <i class="ph ph-car-simple"></i> Pending Vehicle Posts
                </h3>
                <span class="text-sm text-gray-500">Total: {{ count($pendingVehicles) }}</span>
            </div>

            <div class="overflow-x-auto rounded-md">
                <table class="min-w-full text-sm text-left">
                    <thead class="bg-gray-50 text-gray-600 uppercase tracking-wider">
                        <tr>
                            <th class="px-6 py-3">Plate Number</th>
                            <th class="px-6 py-3">Model Year</th>
                            <th class="px-6 py-3">Status</th>
                            <th class="px-6 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($pendingVehicles as $vehicle)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 font-medium text-gray-900">{{ $vehicle->plate_number }}</td>
                                <td class="px-6 py-4">{{ $vehicle->model_year }}</td>
                                <td class="px-6 py-4 capitalize">
                                    <span class="inline-block bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full">
                                        {{ $vehicle->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 space-x-2">
                                    <!-- Approve Button -->
                                    <form action="{{ route('admin.approve', $vehicle->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md text-sm font-medium shadow transition">
                                            <i class="ph ph-check mr-1"></i> Approve
                                        </button>
                                    </form>

                                    <!-- Reject Button -->
                                    <form action="{{ route('admin.reject', $vehicle->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md text-sm font-medium shadow transition">
                                            <i class="ph ph-x mr-1"></i> Reject
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-6 text-center text-gray-500 italic">No pending vehicle posts.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </main>

</body>
</html>
>>>>>>> dev4
