@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10">
    <h1 class="text-3xl font-bold mb-4">My Projects</h1>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-3 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('projects.create') }}" class="bg-blue-600 text-green px-4 py-2 rounded mb-4 inline-block">+ Add New Project</a>

    @forelse ($projects as $project)
        <div class="bg-white shadow p-4 mb-4 rounded">
            <h2 class="text-xl font-semibold">{{ $project->title }}</h2>
            <p class="text-gray-700 mb-2">{{ $project->description }}</p>
            @if ($project->image)
                <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}" class="h-32 mb-2">
            @endif
            <p>
                @foreach ($project->techStacks as $stack)
                    <span class="text-sm bg-gray-200 px-2 py-1 rounded mr-2">{{ $stack->name }}</span>
                @endforeach
            </p>
            <div class="mt-2">
                <a href="{{ route('projects.edit', $project) }}" class="text-blue-600 hover:underline">Edit</a>
                |
                <a href="{{ route('projects.show', $project) }}" class="text-green-600 hover:underline">View</a>
            </div>
        </div>
    @empty
        <p>No projects found. <a href="{{ route('projects.create') }}" class="text-blue-600 underline">Create one?</a></p>
    @endforelse
</div>
@endsection
