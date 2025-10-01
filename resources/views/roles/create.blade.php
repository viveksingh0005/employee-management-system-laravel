<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800">
                Roles / Create
            </h2>
            <a href="{{ route('roles.index') }}"
                class="bg-slate-700 hover:bg-slate-800 transition-all text-sm rounded-md text-white px-4 py-2 shadow-md">
                ← Back
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg">
                <div class="p-8 text-gray-900">
                    <form action="{{ route('roles.store') }}" method="POST">
                        @csrf

                        <div class="mb-6">
                            <label class="block mb-2 text-lg font-semibold text-gray-700">
                                Role Name
                            </label>
                            <input name="name" value="{{ old('name') }}" placeholder="Enter Role Name"
                                type="text"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 shadow-sm focus:ring-2 focus:ring-slate-500 focus:outline-none">

                            @error('name')
                                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-4">
                            @if ($permissions->isNotEmpty())
                                @foreach ($permissions as $permission)
                                    <div class="mt-3">
                                        <input type="checkbox" id="permission-{{ $permission->id }}" class="rounded"
                                            name="permission[]" value="{{ $permission->name }}">
                                        <label for="permission-{{ $permission->id }}">{{ $permission->name }}</label>
                                    </div>
                                @endforeach
                            @endif

                        </div>

                        <div class="flex justify-end">
                            <button type="submit"
                                class="bg-slate-700 hover:bg-slate-800 text-white px-6 py-2 rounded-md text-sm font-medium shadow-md transition-all">
                                Create Role
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>