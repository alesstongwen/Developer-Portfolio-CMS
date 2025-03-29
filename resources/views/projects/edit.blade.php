@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto px-6 py-12 mt-10">
    <h1 class="text-2xl font-bold mb-6">Edit Project</h1>

    <form action="{{ route('projects.update', $project) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-semibold">Title</label>
            <input name="title" type="text" value="{{ $project->title }}" class="w-full border px-3 py-2 rounded" required>
        </div>

        <div>
            <label class="block font-semibold">Description</label>
            <textarea name="description" class="w-full border px-3 py-2 rounded" required>{{ $project->description }}</textarea>
        </div>

        <div>
            <label class="block font-semibold">GitHub Link</label>
            <input name="github_url" type="url" value="{{ $project->github_url }}" class="w-full border px-3 py-2 rounded">
        </div>

        <div>
            <label class="block font-semibold">Image</label>
            @if ($project->image)
                <img src="{{ asset('storage/' . $project->image) }}" class="h-20 mb-2">
            @endif
            <input name="image" type="file" class="block">
        </div>

        <div>
            <label class="block font-semibold mb-1">Tech Stack</label>
            @foreach ($techStacks as $stack)
                <label class="inline-flex items-center mr-4">
                    <input type="checkbox" name="tech_stack_ids[]" value="{{ $stack->id }}"
                        {{ $project->techStacks->contains($stack->id) ? 'checked' : '' }} class="mr-1">
                    {{ $stack->name }}
                </label>
            @endforeach
        </div>

        <button type="submit" class="bg-blue-600 text-black px-4 py-2 rounded hover:bg-blue-700">Update Project</button>
    </form>
</div>
@endsection
