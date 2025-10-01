<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Permissions / Create
            </h2>
                 <a href="{{ route('permissions.index') }}"class="bg-slate-700 text-sm rounded-md text-white px-5 py-3"> Back</a>
        </div>
       
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('permissions.store') }}" method="post">
                        @csrf
                        <div>
                            <label for ="" class="text-sm font-medium">Name</label>
                            <div class="mb-3">
                                <input value="{{old('name')}} "name="name" type="text" placeholder="write permission "class="order-gray-300 shadow-sm w-1/2 rounded-lg">
                                @error('name')
                                <p class="text-red-400">{{$message}}</p>
                                @enderror
                            </div>
                            <button class=""> Submit</button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>