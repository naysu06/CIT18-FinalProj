<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>NabanggaNaBa</title>
  @vite('resources/css/app.css')
  <script>
    function toggleModal(postId = null) {
      let modal;
      if (postId) {
        modal = document.getElementById(`postModal-${postId}`);
      } else {
        modal = document.getElementById('postModal'); // for Add Post
      }

      if (modal) {
        modal.classList.toggle('hidden');
      }
    }

    function changeImage(postId, direction) {
      const images = document.querySelectorAll(`#postModal-${postId} .modal-image`);
      let currentIndex = [...images].findIndex(image => !image.classList.contains('hidden'));
      if (currentIndex === -1) currentIndex = 0;
      
      images[currentIndex].classList.add('hidden');
      if (direction === 'next') {
        currentIndex = (currentIndex + 1) % images.length;
      } else {
        currentIndex = (currentIndex - 1 + images.length) % images.length;
      }
      images[currentIndex].classList.remove('hidden');
    }
  </script>
</head>
<body>
  <!-- Navbar -->
  <nav class="bg-white shadow-lg p-4">
    <div class="container mx-auto flex justify-between items-center">
      <a href="#" class="text-2xl font-bold text-gray-800">NabanggaNaBa</a>
      @if(auth()->check())
      <form action="{{ route('logout') }}" method="POST">
        @csrf
        @method('DELETE')
        <button class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Logout</button>
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
                <div class="bg-gray-100 p-4 rounded-lg shadow-md mb-4">
                    <!-- Display the first image associated with the post -->
                    @if($post->vehicleImages->isNotEmpty())
                        <img 
                          src="{{ asset('storage/' . $post->vehicleImages->first()->image) }}" 
                          alt="Vehicle Image" 
                          class="w-full h-64 object-cover rounded-md cursor-pointer"
                          onclick="toggleModal({{ $post->id }})"
                        >
                    @endif

                    <p><strong>{{ $post->user->username }}</strong></p>
                    <h2 class="text-xl font-semibold">{{ $post->plate_number }} - {{ $post->model_year }}</h2>
                    <p class="text-gray-600">Location: {{ $post->place }} | Date: {{ $post->date }}</p>
                </div>

                <!-- Add Modal for Image Gallery -->
                @if($post->vehicleImages->isNotEmpty())
                  <div id="postModal-{{ $post->id }}" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center hidden">
                    <div class="bg-white p-6 rounded-lg shadow-lg w-11/12 h-5/6 max-w-6xl relative">
                      <h2 class="text-2xl font-bold mb-4">Images for {{ $post->plate_number }}</h2>

                      <!-- Close button -->
                      <button onclick="toggleModal({{ $post->id }})" class="absolute top-4 right-4 text-2xl text-gray-600 hover:text-gray-800 font-bold cursor-pointer">&times;</button>
                      
                      <!-- Navigation buttons -->
                      <button onclick="changeImage({{ $post->id }}, 'prev')" class="absolute left-4 top-1/2 transform -translate-y-1/2 text-3xl text-gray-800 cursor-pointer">
                        &#10094;
                      </button>

                      <div class="flex justify-center items-center max-h-[80vh] overflow-auto">
                        @foreach($post->vehicleImages as $index => $vehicleImage)
                          <img 
                            src="{{ asset('storage/' . $vehicleImage->image) }}" 
                            alt="Vehicle Image"
                            class="modal-image max-w-full max-h-[70vh] object-contain rounded-md {{ $index === 0 ? '' : 'hidden' }}"
                          >
                        @endforeach
                      </div>

                      <button onclick="changeImage({{ $post->id }}, 'next')" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-3xl text-gray-800 cursor-pointer">
                        &#10095;
                      </button>

                    </div>
                  </div>
                @endif
            @endif
          @endforeach
        @endif
      </div>
    </section>

    <!-- Floating Add Post Button -->
    <button onclick="toggleModal()" class="fixed bottom-8 right-8 bg-blue-500 text-white p-4 rounded-full shadow-lg text-2xl cursor-pointer">+</button>

    <!-- Add Post Modal -->
    <div id="postModal" class="fixed inset-0 bg-gray-900 p-4 bg-opacity-50 flex justify-center items-center hidden">
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
            <label class="block text-sm font-semibold">Images</label>
            <input type="file" name="images[]" class="w-full border p-2 rounded" multiple required>
            <small class="text-xs text-gray-500">You can select multiple images</small>
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