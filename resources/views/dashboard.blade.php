<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
        @if(auth()->check())
    <div class="p-4 bg-gray-100 border rounded">
        <p>👤 Logged in as: <strong>{{ auth()->user()->name }}</strong></p>
        <p>Roles: {{ implode(', ', auth()->user()->getRoleNames()->toArray()) }}</p>
        <p>Permissions: {{ implode(', ', auth()->user()->getAllPermissions()->pluck('name')->toArray()) }}</p>
    </div>
@endif

    </div>
</x-app-layout>
