<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800">Employee Details</h2>
            <a href="{{ route('employees.index') }}"
                class="bg-slate-700 hover:bg-slate-800 text-white px-4 py-2 rounded-md shadow-md transition-all text-sm">
                ← Back to List
            </a>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-6 bg-white p-6 rounded-lg shadow-md space-y-6">

        <!-- Basic Info -->
        <div class="space-y-2">
            <p><span class="font-semibold text-gray-700">Name:</span> {{ $employee->name }}</p>
            <p><span class="font-semibold text-gray-700">Email:</span> {{ $employee->email }}</p>
            <p><span class="font-semibold text-gray-700">DOB:</span> {{ $employee->dob }}</p>
            <p><span class="font-semibold text-gray-700">Department:</span> {{ $employee->department->name }}</p>
            <p><span class="font-semibold text-gray-700">Role:</span> {{ $employee->role }}</p>
            <p><span class="font-semibold text-gray-700">Account No:</span> {{ $employee->account_number }}</p>
        </div>

        <!-- Photo -->
        <div>
            <p class="font-semibold text-gray-700">Photo:</p>
            @if($employee->photo)
                <img src="{{ asset('storage/'.$employee->photo) }}" class="w-36 h-36 object-cover rounded-md border border-gray-300 mt-2">
            @else
                <p class="text-gray-500 mt-2">Not uploaded</p>
            @endif
        </div>

        <!-- Aadhaar & PAN -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Aadhaar -->
            <div>
                <p class="font-semibold text-gray-700">Aadhaar Card:</p>
                @if($employee->aadhaar_card)
                    @php $ext = strtolower(pathinfo($employee->aadhaar_card, PATHINFO_EXTENSION)); @endphp
                    @if(in_array($ext, ['jpg','jpeg','png','gif']))
                        <img src="{{ asset('storage/'.$employee->aadhaar_card) }}" class="w-60 h-auto mt-2 border border-gray-300 rounded-md">
                    @elseif($ext == 'pdf')
                        <iframe src="{{ asset('storage/'.$employee->aadhaar_card) }}" class="w-full h-72 mt-2 border border-gray-300 rounded-md"></iframe>
                    @else
                        <a href="{{ asset('storage/'.$employee->aadhaar_card) }}" target="_blank" class="text-blue-600 hover:underline mt-2 block">View Aadhaar</a>
                    @endif
                @else
                    <p class="text-gray-500 mt-2">Not uploaded</p>
                @endif
            </div>

            <!-- PAN -->
            <div>
                <p class="font-semibold text-gray-700">PAN Card:</p>
                @if($employee->pan_card)
                    @php $ext = strtolower(pathinfo($employee->pan_card, PATHINFO_EXTENSION)); @endphp
                    @if(in_array($ext, ['jpg','jpeg','png','gif']))
                        <img src="{{ asset('storage/'.$employee->pan_card) }}" class="w-60 h-auto mt-2 border border-gray-300 rounded-md">
                    @elseif($ext == 'pdf')
                        <iframe src="{{ asset('storage/'.$employee->pan_card) }}" class="w-full h-72 mt-2 border border-gray-300 rounded-md"></iframe>
                    @else
                        <a href="{{ asset('storage/'.$employee->pan_card) }}" target="_blank" class="text-blue-600 hover:underline mt-2 block">View PAN</a>
                    @endif
                @else
                    <p class="text-gray-500 mt-2">Not uploaded</p>
                @endif
            </div>
        </div>

        <!-- Upload Document -->
        <div class="mt-4">
            <h3 class="font-semibold text-gray-700 mb-2">Upload Document</h3>
            <form action="{{ route('employees.documents.store', $employee->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col md:flex-row gap-4 items-center">
                @csrf
                <input type="file" name="file" required class="border border-gray-300 rounded-md p-2 w-full md:w-auto">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md shadow-md transition-all">Upload</button>
            </form>
        </div>

        <!-- Documents List -->
        <div>
            <h3 class="font-semibold text-gray-700 mb-2">Documents</h3>
            @if($employee->documents->count() > 0)
                <div class="space-y-4">
                    @foreach ($employee->documents as $doc)
                        @php $ext = strtolower(pathinfo($doc->document_file, PATHINFO_EXTENSION)); @endphp
                        <div class="border border-gray-200 p-4 rounded-md shadow-sm">
                            <div class="font-medium text-gray-800 mb-2">{{ $doc->document_name }}</div>
                            @if(in_array($ext, ['jpg','jpeg','png','gif']))
                                <img src="{{ asset('storage/'.$doc->document_file) }}" class="w-60 h-auto border border-gray-300 rounded-md">
                            @elseif($ext == 'pdf')
                                <iframe src="{{ asset('storage/'.$doc->document_file) }}" class="w-full h-72 border border-gray-300 rounded-md"></iframe>
                            @else
                                <a href="{{ asset('storage/'.$doc->document_file) }}" target="_blank" class="text-blue-600 hover:underline">View Document</a>
                            @endif

                            <!-- Delete -->
                            <form action="{{ route('employees.documents.destroy', [$employee->id, $doc->id]) }}" method="POST" class="mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this document?')"
                                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-md text-sm transition-all">Delete</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500">No documents uploaded yet.</p>
            @endif
        </div>

    </div>
</x-app-layout>
