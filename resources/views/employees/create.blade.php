<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800">
                Add Employee
            </h2>
            <a href="{{ route('employees.index') }}"
                class="bg-slate-700 hover:bg-slate-800 transition-all text-sm rounded-md text-white px-4 py-2 shadow-md">
                ← Back
            </a>
        </div>
    </x-slot>

    <div class="max-w-3xl mx-auto mt-6 bg-white p-6 rounded-lg shadow-md">
        <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <!-- Name -->
            <div>
                <label class="block text-gray-700 font-medium">Name:</label>
                <input type="text" name="name" value="{{ old('name') }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <!-- Email -->
            <div>
                <label class="block text-gray-700 font-medium">Email:</label>
                <input type="email" name="email" value="{{ old('email') }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <!-- DOB -->
            <div>
                <label class="block text-gray-700 font-medium">DOB:</label>
                <input type="date" name="dob" value="{{ old('dob') }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <!-- Department Dropdown -->
            <div>
                <label class="block text-gray-700 font-medium">Department:</label>
                <select name="department_id" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">-- Select Department --</option>
                    @foreach ($departments as $department)
                        <option value="{{ $department->id }}"
                            {{ old('department_id') == $department->id ? 'selected' : '' }}>
                            {{ $department->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Role -->
            <div>
                <label class="block text-gray-700 font-medium">Role:</label>
                <select name="role" required>
                    @foreach ($roles as $id => $role)
                        <option value="{{ $role }}">{{ ucfirst($role) }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Account Number -->
            <div>
                <label class="block text-gray-700 font-medium">Account Number:</label>
                <input type="text" name="account_number" value="{{ old('account_number') }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <!-- Photo -->
            <div>
                <label class="block text-gray-700 font-medium">Photo:</label>
                <input type="file" name="photo" class="mt-1 block w-full text-gray-600">
            </div>

            <!-- Aadhaar Card -->
            <div>
                <label class="block text-gray-700 font-medium">Aadhaar Card:</label>
                <input type="file" name="aadhaar_card" class="mt-1 block w-full text-gray-600">
            </div>

            <!-- Pan Card -->
            <div>
                <label class="block text-gray-700 font-medium">Pan Card:</label>
                <input type="file" name="pan_card" class="mt-1 block w-full text-gray-600">
            </div>

            <!-- Link to User -->
            <div>
                <label class="block text-gray-700 font-medium">Link to User:</label>
                <select name="user_id"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">-- Select User --</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }} ({{ $user->email }})
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-4 py-2 rounded-md shadow-md transition-all">
                    Save
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
