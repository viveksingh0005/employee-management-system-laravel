<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Employee Management System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="antialiased bg-gradient-to-br from-indigo-100 via-white to-indigo-200 min-h-screen flex flex-col items-center justify-center">

    <!-- Top Right Auth Links -->
    @if (Route::has('login'))
        <div class="absolute top-4 right-6">
            @auth
                <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 hover:text-indigo-700 font-semibold">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="text-sm text-gray-700 hover:text-indigo-700 font-semibold">Log in</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 hover:text-indigo-700 font-semibold">Register</a>
                @endif
            @endauth
        </div>
    @endif

    <!-- Main Content -->
    <div class="text-center px-6 mt-6">
        <div class="flex justify-center mb-6">
            <div class="bg-indigo-600 text-white w-20 h-20 flex items-center justify-center rounded-2xl text-3xl font-bold shadow-lg">
                EMS
            </div>
        </div>

        <h1 class="text-5xl md:text-6xl font-extrabold text-gray-800 mb-4">
            Employee Management System
        </h1>
        <p class="text-lg text-gray-600 max-w-xl mx-auto">
            Simplify your HR operations. Manage employees, track roles, and organize departments — all from one place.
        </p>

        <div class="mt-10 flex justify-center">
            <a href="{{ route('login') }}" class="bg-indigo-600 text-white px-8 py-3 rounded-xl shadow-md hover:bg-indigo-700 transition transform hover:-translate-y-1">
                Get Started
            </a>
        </div>
    </div>

    <!-- Footer -->
    <footer class="mt-16 text-gray-500 text-sm">
        © {{ date('Y') }} Employee Management System. Built with ❤️ using Laravel.
    </footer>

</body>
</html>
