<!DOCTYPE html>
<html lang="en">
<head>
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
            <h1 class="text-2xl font-extrabold text-indigo-600 tracking-tight">NabanggaNaBa Admin Dashboard</h1>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="bg-red-500 hover:bg-red-600 text-white font-semibold px-4 py-2 rounded-lg shadow-md transition duration-200 cursor-pointer">
                    <i class="ph ph-sign-out mr-2"></i> Logout
                </button>
            </form>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container mx-auto px-6 py-10">
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-gray-900">Welcome {{ Auth::user()->username }}</h2>
        </div>
        <!-- Flash Messages -->
        @if(session('success'))
            <div class="bg-green-100 text-green-800 border border-green-300 px-4 py-3 rounded-lg mb-6 shadow">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 text-red-800 border border-red-300 px-4 py-3 rounded-lg mb-6 shadow">
                {{ session('error') }}
            </div>
        @endif

        <!-- Pending Vehicles Section -->
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
                            <th class="px-6 py-3">Images</th>
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
                                    <!-- Link to trigger modal -->
                                    <a href="javascript:void(0);" onclick="toggleModal({{ $vehicle->id }})" class="text-blue-500 hover:text-blue-700">
                                        View Images
                                    </a>
                                </td>
                                <td class="px-6 py-4 capitalize">
                                    <span class="inline-block bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full">
                                        {{ $vehicle->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 space-x-2">
                                    <!-- Approve Button -->
                                    <form action="{{ route('admin.approve', $vehicle->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md text-sm font-medium shadow transition cursor-pointer">
                                            <i class="ph ph-check mr-1"></i> Approve
                                        </button>
                                    </form>

                                    <!-- Reject Button -->
                                    <form action="{{ route('admin.reject', $vehicle->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md text-sm font-medium shadow transition cursor-pointer">
                                            <i class="ph ph-x mr-1"></i> Reject
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Modal for Vehicle Images -->
                            @if($vehicle->vehicleImages->isNotEmpty())
                                <div id="postModal-{{ $vehicle->id }}" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center hidden">
                                    <div class="bg-white p-6 rounded-lg shadow-lg w-11/12 h-5/6 max-w-6xl relative">
                                        <h2 class="text-2xl font-bold mb-4">Images for {{ $vehicle->plate_number }}</h2>

                                        <!-- Close button -->
                                        <button onclick="toggleModal({{ $vehicle->id }})" class="absolute top-4 right-4 text-2xl text-gray-600 hover:text-gray-800 font-bold cursor-pointer">&times;</button>
                                        
                                        <!-- Navigation buttons -->
                                        <button onclick="changeImage({{ $vehicle->id }}, 'prev')" class="absolute left-4 top-1/2 transform -translate-y-1/2 text-3xl text-gray-800 cursor-pointer">
                                            &#10094;
                                        </button>

                                        <div class="flex justify-center items-center max-h-[80vh] overflow-auto">
                                            @foreach($vehicle->vehicleImages as $index => $vehicleImage)
                                                <img 
                                                    src="{{ asset('storage/' . $vehicleImage->image) }}" 
                                                    alt="Vehicle Image"
                                                    class="modal-image max-w-full max-h-[70vh] object-contain rounded-md {{ $index === 0 ? '' : 'hidden' }}"
                                                >
                                            @endforeach
                                        </div>

                                        <button onclick="changeImage({{ $vehicle->id }}, 'next')" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-3xl text-gray-800 cursor-pointer">
                                            &#10095;
                                        </button>
                                    </div>
                                </div>
                            @endif
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
<script>
// Function to toggle the modal visibility
function toggleModal(vehicleId) {
    const modal = document.getElementById('postModal-' + vehicleId);
    modal.classList.toggle('hidden');
}

// Function to change the image in the modal (prev/next)
function changeImage(vehicleId, direction) {
    const images = document.querySelectorAll('#postModal-' + vehicleId + ' .modal-image');
    let currentIndex = Array.from(images).findIndex(image => !image.classList.contains('hidden'));

    if (direction === 'prev') {
        currentIndex = currentIndex === 0 ? images.length - 1 : currentIndex - 1;
    } else if (direction === 'next') {
        currentIndex = currentIndex === images.length - 1 ? 0 : currentIndex + 1;
    }

    images.forEach((image, index) => {
        image.classList.add('hidden');
        if (index === currentIndex) {
            image.classList.remove('hidden');
        }
    });
}
</script>
</body>
</html>
