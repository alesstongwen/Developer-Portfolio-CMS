@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-6 py-12 bg-white shadow rounded-md">
    <h1 class="text-3xl font-bold mb-8 text-gray-800">Add New Project</h1>

    @if ($errors->any())
    <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>• {{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div>
            <label class="block text-gray-700 font-medium mb-1">Title</label>
            <input name="title" type="text" class="w-full border border-gray-300 px-4 py-2 rounded-md focus:ring focus:ring-blue-200" required>
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Description</label>
            <textarea name="description" rows="5" class="w-full border border-gray-300 px-4 py-2 rounded-md focus:ring focus:ring-blue-200" required></textarea>
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">GitHub Link</label>
            <input name="github_url" type="url" class="w-full border border-gray-300 px-4 py-2 rounded-md focus:ring focus:ring-blue-200">
        </div>

        <div>
    <label class="block font-semibold">Image</label>

    <img id="preview" class="h-20 mb-2 rounded hidden">

    @error('image')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror

    <input name="image" type="file" class="block" accept="image/*" onchange="previewImage(event)">
</div>


<script>
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('preview');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>


        <div>
            <div class="flex flex-wrap gap-3">
                @foreach ($techStacks as $stack)
                    <label class="flex items-center text-sm">
                        <input type="checkbox" name="tech_stack_ids[]" value="{{ $stack->id }}" class="mr-2">
                        {{ $stack->name }}
                    </label>
                @endforeach
            </div>
        </div>

        <div class="pt-6">
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded shadow transition">
                Save Project
            </button>
        </div>
    </form>
</div>
@endsection
