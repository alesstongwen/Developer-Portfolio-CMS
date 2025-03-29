@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-6 py-12 bg-white shadow rounded-md">
    <h1 class="text-3xl font-bold mb-8 text-gray-800">Add New Project</h1>

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
            <label class="block text-gray-700 font-medium mb-1">Project Image</label>
            <input name="image" type="file" class="block w-full text-gray-600">
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-2">Tech Stack</label>
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
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-black font-semibold px-6 py-2 rounded shadow transition">
                Save Project
            </button>
        </div>
    </form>
</div>
@endsection
