<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-indigo-100 via-white to-indigo-200 min-h-screen flex flex-col items-center justify-center">

    <!-- Navbar -->
    <nav class="w-full bg-white/80 backdrop-blur-md fixed top-0 left-0 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto flex justify-between items-center py-4 px-6">
            <div class="flex items-center gap-2">
                <div class="bg-indigo-600 text-white text-2xl w-10 h-10 flex items-center justify-center rounded-lg font-bold">E</div>
                <h1 class="text-2xl font-semibold text-gray-800">Employee Management</h1>
            </div>
            <div class="flex gap-4">
                <a href="#" class="text-gray-700 hover:text-indigo-600 transition">Home</a>
                <a href="#" class="text-gray-700 hover:text-indigo-600 transition">Employees</a>
                <a href="#" class="text-gray-700 hover:text-indigo-600 transition">Departments</a>
                <a href="#" class="text-gray-700 hover:text-indigo-600 transition">Contact</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="text-center mt-28 px-6">
        <h2 class="text-5xl font-extrabold text-gray-800 mb-4">
            Welcome to Your <span class="text-indigo-600">Employee Portal</span>
        </h2>
        <p class="text-gray-600 text-lg max-w-2xl mx-auto mb-8">
            Manage employees, assign roles, handle departments, and streamline HR processes — all in one smart dashboard.
        </p>
        <div class="flex justify-center gap-4">
            <a href="{{ route('employees.index') }}" class="bg-indigo-600 text-white px-6 py-3 rounded-xl shadow-md hover:bg-indigo-700 transition transform hover:-translate-y-1">
                Manage Employees
            </a>
            <a href="{{ route('departments.index') }}" class="bg-white border border-indigo-600 text-indigo-600 px-6 py-3 rounded-xl hover:bg-indigo-50 shadow-sm transition transform hover:-translate-y-1">
                View Departments
            </a>
        </div>
    </section>

    <!-- Features Section -->
    <section class="grid md:grid-cols-3 gap-8 mt-16 px-8 max-w-6xl">
        <div class="bg-white p-8 rounded-2xl shadow-md hover:shadow-lg transition transform hover:-translate-y-1">
            <div class="text-indigo-600 text-4xl mb-3">👥</div>
            <h3 class="font-semibold text-xl mb-2">Employee Records</h3>
            <p class="text-gray-600 text-sm">
                Keep track of employee information, documents, and updates in one secure place.
            </p>
        </div>

        <div class="bg-white p-8 rounded-2xl shadow-md hover:shadow-lg transition transform hover:-translate-y-1">
            <div class="text-indigo-600 text-4xl mb-3">⚙️</div>
            <h3 class="font-semibold text-xl mb-2">Role & Permission Control</h3>
            <p class="text-gray-600 text-sm">
                Assign roles with Spatie Permissions for secure and organized access control.
            </p>
        </div>

        <div class="bg-white p-8 rounded-2xl shadow-md hover:shadow-lg transition transform hover:-translate-y-1">
            <div class="text-indigo-600 text-4xl mb-3">📊</div>
            <h3 class="font-semibold text-xl mb-2">Department Insights</h3>
            <p class="text-gray-600 text-sm">
                Manage departments efficiently with detailed employee and performance overviews.
            </p>
        </div>
    </section>

    <!-- Footer -->
    <footer class="mt-20 py-6 text-center text-gray-500 text-sm">
        © {{ date('Y') }} Employee Management System — Built with ❤️ and Laravel
    </footer>

</body>
</html>
