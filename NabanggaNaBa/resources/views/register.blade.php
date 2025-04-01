<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register - NabanggaNaBa</title>
  @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
  <div class="bg-white shadow-lg rounded-lg p-8 max-w-md w-full">
    <h1 class="text-4xl font-bold text-center mb-6">Create an Account</h1>

    @if(session('success'))
      <p class="text-green-500 text-center mb-4">{{ session('success') }}</p>
    @endif

    @if($errors->any())
      <ul class="text-red-500 mb-4">
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    @endif

    <!-- Registration Form -->
    <form action="{{ route('auth.store') }}" method="POST" class="space-y-4">
      @csrf
      <div>
        <label class="block text-gray-700">Username</label>
        <input type="text" name="username" placeholder="Username" class="w-full border rounded p-2" required>
      </div>

      <div>
        <label class="block text-gray-700">Password</label>
        <input type="password" name="password" placeholder="Password" class="w-full border rounded p-2" required>
      </div>

      <div>
        <label class="block text-gray-700">Confirm Password</label>
        <input type="password" name="password_confirmation" placeholder="Confirm Password" class="w-full border rounded p-2" required>
      </div>

      <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg cursor-pointer">
        Register
      </button>
    </form>

    <!-- Login Link with TailwindCSS -->
    <p class="text-center mt-4 text-gray-600">
      Already have an account? 
      <a href="{{ route('login') }}" class="text-blue-500 hover:text-blue-600 font-semibold">Login here</a>.
    </p>
  </div>
</body>
</html>
