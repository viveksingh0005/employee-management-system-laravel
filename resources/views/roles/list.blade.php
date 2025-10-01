<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{ __('Roles') }}
            </h2>
            <a href="{{ route('roles.create') }}"
                class="bg-slate-700 hover:bg-slate-800 transition-all text-sm rounded-md text-white px-4 py-2 shadow-md">
                + Create
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-message />

            <div class="bg-white shadow-md rounded-lg">
                 <table class="w-full table-auto">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left">#</th>
                            <th class="px-6 py-3 text-left">Name</th>
                            <th class="px-6 py-3 text-left">Permissions</th>
                            <th class="px-6 py-3 text-left">Created</th>
                            <th class="px-6 py-3 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($roles as $role)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-6 py-3">{{ $role->id }}</td>
                                <td class="px-6 py-3">{{ $role->name }}</td>
                                <td class="px-6 py-3">{{ $role->permissions->pluck('name')->implode(',  ') }}</td>
                                <td class="px-6 py-3">{{ $role->created_at->format('d M Y') }}</td>
                                <td class="px-6 py-3 text-center flex justify-center gap-3">

                                    {{-- Edit --}}
                                    <a href="{{ route('roles.edit', $role->id) }}"
                                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm shadow">
                                        Edit
                                    </a>

                                    {{-- Delete --}}
                                    <form action="{{ route('roles.destroy', $role->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md text-sm shadow">
                                            Delete
                                        </button>
                                    </form>



                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center px-6 py-4 text-gray-500">
                                    No permissions found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>


            </div>
            <div class="my-3">
               {{ $roles->links() }}
            </div>
        </div>
    </div>
</x-app-layout>