
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>NabanggaNaBa</title>
  @vite('resources/css/app.css')
</head>
<body>
  <!-- Navbar -->
  <nav class="bg-white shadow-lg p-4">
    <div class="container mx-auto flex justify-between items-center">
      <a href="#" class="text-2xl font-bold text-gray-800">NabanggaNaBa</a>
      <a href="/login" class="text-blue-500 hover:text-blue-600">Login</a>
    </div>
  </nav>

   <!-- Hero Section -->
  <section class="relative w-full h-screen bg-cover bg-center" style="background-image: url({{ asset('images/landing_img.jpg') }});">
    <!-- Blur Overlay -->
    <div class="absolute inset-0  bg-opacity-30 backdrop-blur-md flex flex-col items-center justify-center text-center">
      <h1 class="text-white text-4xl md:text-6xl font-bold mb-4">Want a Peace of Mind in Buying a 2nd Hand Car?</h1>
      <a href="/view" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-3 px-8 rounded-lg text-lg">View</a>
    </div>
  </section>
  <!-- Footer -->
  <footer class="bg-gray-800 text-white text-center py-4">
    <p>&copy; 2021 NabanggaNaBa. All rights reserved.</p>
  </footer>
</body>
</html>