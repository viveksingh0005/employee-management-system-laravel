<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800">
                Edit Employee
            </h2>
            <a href="{{ route('employees.index') }}"
                class="bg-slate-700 hover:bg-slate-800 transition-all text-sm rounded-md text-white px-4 py-2 shadow-md">
                ← Back
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg">
                <div class="p-8 text-gray-900">

                    <form action="{{ route('employees.update', $employee->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-6">
                            <label class="block mb-2 font-semibold text-gray-700">Name</label>
                            <input type="text" name="name" value="{{ old('name', $employee->name) }}" required
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 shadow-sm focus:ring-2 focus:ring-slate-500 focus:outline-none">
                        </div>

                        <div class="mb-6">
                            <label class="block mb-2 font-semibold text-gray-700">Email</label>
                            <input type="email" name="email" value="{{ old('email', $employee->email) }}" required
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 shadow-sm focus:ring-2 focus:ring-slate-500 focus:outline-none">
                        </div>

                        <div class="mb-6">
                            <label class="block mb-2 font-semibold text-gray-700">DOB</label>
                            <input type="date" name="dob" value="{{ old('dob', $employee->dob) }}" required
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 shadow-sm focus:ring-2 focus:ring-slate-500 focus:outline-none">
                        </div>

                        <div class="mb-6">
                            <label class="block mb-2 font-semibold text-gray-700">Department</label>
                            <select name="department_id" required
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 shadow-sm focus:ring-2 focus:ring-slate-500 focus:outline-none">
                                <option value="">-- Select Department --</option>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}"
                                        {{ old('department_id', $employee->department_id) == $department->id ? 'selected' : '' }}>
                                        {{ $department->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>


                        <div class="mb-6">
                            <label class="block mb-2 font-semibold text-gray-700">Role</label>
                            <select name="role" required>
                                @foreach ($roles as $id => $role)
                                    <option value="{{ $role }}">{{ ucfirst($role) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-6">
                            <label class="block mb-2 font-semibold text-gray-700">Account Number</label>
                            <input type="text" name="account_number"
                                value="{{ old('account_number', $employee->account_number) }}"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 shadow-sm focus:ring-2 focus:ring-slate-500 focus:outline-none">
                        </div>

                        <div class="mb-6">
                            <label class="block mb-2 font-semibold text-gray-700">Aadhaar Card</label>
                            <input type="file" name="aadhaar_card">
                            @if ($employee->aadhaar_card)
                                <img src="{{ asset('storage/' . $employee->aadhaar_card) }}" width="80"
                                    class="mt-2 border rounded">
                            @endif
                        </div>

                        <div class="mb-6">
                            <label class="block mb-2 font-semibold text-gray-700">PAN Card</label>
                            <input type="file" name="pan_card">
                            @if ($employee->pan_card)
                                <img src="{{ asset('storage/' . $employee->pan_card) }}" width="80"
                                    class="mt-2 border rounded">
                            @endif
                        </div>

                        <div class="mb-6">
                            <label class="block mb-2 font-semibold text-gray-700">Photo</label>
                            <input type="file" name="photo">
                            @if ($employee->photo)
                                <img src="{{ asset('storage/' . $employee->photo) }}" width="80"
                                    class="mt-2 border rounded">
                            @endif
                        </div>

                        <div class="flex justify-end">
                            <button type="submit"
                                class="bg-slate-700 hover:bg-slate-800 text-white px-6 py-2 rounded-md text-sm font-medium shadow-md transition-all">
                                Update Employee
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
