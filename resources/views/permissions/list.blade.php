<x-app-layout>
    <x-slot name="header">
          <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Permissions 
            </h2>
                 <a href="{{ route('permissions.create') }}"class="bg-slate-700 text-sm rounded-md text-white px-5 py-3"> Create</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <table class="w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-200 dark:bg-gray-700">
                                <th class="border border-gray-300 px-4 py-2">ID</th>
                                <th class="border border-gray-300 px-4 py-2">Name</th>
                             
                                <th class="border border-gray-300 px-4 py-2">Created At</th>
                                <th class="border border-gray-300 px-4 py-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($permissions as $permission)
                                <tr>
                                    <td class="border border-gray-300 px-4 py-2">{{ $permission->id }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $permission->name }}</td>
                                  
                                    <td class="border border-gray-300 px-4 py-2">{{ $permission->created_at->format('d M Y') }}</td>
                                      <td class="border border-gray-300 px-4 py-2 flex space-x-2">
                                        <!-- Edit Button -->
                                        <a href="{{ route("permissions.edit",$permission->id) }}" 
                                           class="px-3 py-1 bg-blue-600 text-white rounded-md text-sm hover:bg-blue-700">
                                            Edit
                                        </a>
                                        <!-- Delete Form -->
                                       <a href="javascript:void(0)"onclick="deletePermission({{ $permission->id }})"  class="px-3 py-1 bg-red-600 text-white rounded-md text-sm hover:bg-red-700">
                                        Delete
                                       </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-3">No permissions found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $permissions->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
    <x-slot name="script">
        <script type="text/javascript">
        function deletePermission(id){
            if(confirm("Are you sure you want to delete this permission?")){
                $.ajax({
                    url:'{{ route('permissions.destroy') }}',
                    type:'delete',
                    data:{id:id},
                    dataType:'json',
                    headers:{
                        'x-csrf-token':'{{ csrf_token() }}'
                    },
                    success:function(response){
                        window.location.href = '{{ route("permissions.index") }}';
                    }
                })
            }
        }
            </script>

    </x-slot>
</x-app-layout>
