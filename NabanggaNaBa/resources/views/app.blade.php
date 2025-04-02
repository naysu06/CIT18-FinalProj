<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>NabanggaNaBa</title>
  @vite('resources/css/app.css')
  <script>
    function toggleModal() {
      document.getElementById('postModal').classList.toggle('hidden');
    }
  </script>
</head>
<body>
  <!-- Navbar -->
  <nav class="bg-white shadow-lg p-4">
    <div class="container mx-auto flex justify-between items-center">
      <a href="#" class="text-2xl font-bold text-gray-800">NabanggaNaBa</a>
      @if(auth()->check())
        <form action="{{ route('auth.destroy', auth()->user()->id) }}" method="POST">
          @csrf
          @method('DELETE')
          <button type="submit" class="text-red-500 hover:text-red-600 cursor-pointer">Logout</button>
        </form>
      @else
        <a href="{{ route('login') }}" class="text-blue-500 hover:text-blue-600 cursor-pointer">Login</a>
      @endif
    </div>
  </nav>

  @if(auth()->check())
    <!-- Main Feed Section with Parallax Effect -->
    <section class="relative w-full h-screen bg-white overflow-y-auto">
      <div class="container mx-auto p-4">
        <h1 class="text-gray-800 text-4xl font-bold text-center mb-6">Latest NabanggaNaBa Posts</h1>

        @if($posts->isEmpty())
            <p>No approved posts found.</p>
        @else
            @foreach($posts as $post)
                @if ($post->status === 'approved')
                    <div class="bg-gray-100 p-4 rounded-lg shadow-md">
                        <img src="{{ asset($post->image) }}" alt="Vehicle Image" class="w-full h-64 object-cover rounded-md mb-3">
                        <p><strong>{{ $post->user->username }}</strong></p>
                        <h2 class="text-xl font-semibold">{{ $post->plate_number }} - {{ $post->model_year }}</h2>
                        <p class="text-gray-600">Location: {{ $post->place }} | Date: {{ $post->date }}</p>
                    </div>
                @endif
            @endforeach
        @endif
      </div>
    </section>
    
    <!-- Floating Add Post Button -->
    <button onclick="toggleModal()" class="fixed bottom-8 right-8 bg-blue-500 text-white p-4 rounded-full shadow-lg text-2xl cursor-pointer">+</button>

    <!-- Add Post Modal -->
    <div id="postModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center hidden">
      <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h2 class="text-2xl font-bold mb-4">Create a Post</h2>
        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="mb-3">
            <label class="block text-sm font-semibold">Plate Number</label>
            <input type="text" name="plate_number" class="w-full border p-2 rounded" required>
          </div>
          <div class="mb-3">
            <label class="block text-sm font-semibold">Model/Year</label>
            <input type="text" name="model_year" class="w-full border p-2 rounded" required>
          </div>
          <div class="mb-3">
            <label class="block text-sm font-semibold">Image</label>
            <input type="file" name="image" class="w-full border p-2 rounded" required>
          </div>
          <div class="mb-3">
            <label class="block text-sm font-semibold">Date</label>
            <input type="date" name="date" class="w-full border p-2 rounded">
          </div>
          <div class="mb-3">
            <label class="block text-sm font-semibold">Place</label>
            <input type="text" name="place" class="w-full border p-2 rounded">
          </div>
          <div class="flex justify-between">
            <button type="button" onclick="toggleModal()" class="bg-gray-500 text-white px-4 py-2 rounded cursor-pointer">Cancel</button>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded cursor-pointer">Submit</button>
          </div>
        </form>
      </div>
    </div>
  @else
    <!-- Hero Section for Guests -->
    <section class="relative w-full h-screen bg-cover bg-center" style="background-image: url({{ asset('images/landing_img.jpg') }});">
      <div class="absolute inset-0 bg-opacity-30 backdrop-blur-md flex flex-col items-center justify-center text-center">
        <h1 class="text-white text-4xl md:text-6xl font-bold mb-4">Want a Peace of Mind in Buying a 2nd Hand Car?</h1>
        <a href="/dashboard" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-3 px-8 rounded-lg text-lg">View</a>
      </div>
    </section>
  @endif

  <!-- Footer -->
  <footer class="bg-gray-800 text-white text-center py-4">
    <p>&copy; 2025 NabanggaNaBa. All rights reserved.</p>
  </footer>
</body>
</html>