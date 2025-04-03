<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login - NabanggaNaBa</title>
  @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
  <div class="bg-white shadow-lg rounded-lg p-8 max-w-md w-full">
    <h1 class="text-4xl font-bold text-center mb-6">Login</h1>

    @if(session('success'))
      <p class="text-green-500 text-center">{{ session('success') }}</p>
    @endif

    @if($errors->any())
      <ul class="text-red-500">
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    @endif

    <!-- Login Form -->
    <form action="{{ route('auth.login') }}" method="POST" class="space-y-4">
        @csrf
        <div>
        <label class="block text-gray-700">Username</label>
        <input type="text" name="username" class="w-full border rounded p-2" required />
        </div>

        <div>
        <label class="block text-gray-700">Password</label>
        <input type="password" name="password" class="w-full border rounded p-2" required />
        </div>

        <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg cursor-pointer">
        Login
        </button>
    </form>


    <p class="text-center mt-4 text-gray-600">
      Don't have an account? 
      <a href="{{ route('auth.create') }}" class="text-blue-500 hover:text-blue-600 font-semibold">Register here</a>.
    </p>
  </div>
</body>
</html>
