@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-6">Add New Project</h1>

    <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div>
            <label class="block font-semibold">Title</label>
            <input name="title" type="text" class="w-full border px-3 py-2 rounded" required>
        </div>

        <div>
            <label class="block font-semibold">Description</label>
            <textarea name="description" class="w-full border px-3 py-2 rounded" required></textarea>
        </div>

        <div>
            <label class="block font-semibold">GitHub Link</label>
            <input name="github_url" type="url" class="w-full border px-3 py-2 rounded">
        </div>

        <div>
            <label class="block font-semibold">Image</label>
            <input name="image" type="file" class="block">
        </div>

        <div>
            <label class="block font-semibold mb-1">Tech Stack</label>
            @foreach ($techStacks as $stack)
                <label class="inline-flex items-center mr-4">
                    <input type="checkbox" name="tech_stack_ids[]" value="{{ $stack->id }}" class="mr-1">
                    {{ $stack->name }}
                </label>
            @endforeach
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Save Project</button>
    </form>
</div>
@endsection
