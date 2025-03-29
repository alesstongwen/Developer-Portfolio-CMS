@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-6 py-12 bg-white shadow rounded-md">
    <h1 class="text-lg mb-4"><strong>Project Title:</strong><br>{{ $project->title }}</h1>

    @if ($project->image)
        <img src="{{ asset('storage/' . $project->image) }}" class="w-full h-auto rounded mb-6">
    @endif

    <p class="text-lg mb-4"><strong>Description:</strong><br>{{ $project->description }}</p>

    @if ($project->github_url)
        <p class="mb-4">
            <strong>GitHub:</strong> 
            <a href="{{ $project->github_url }}" class="text-blue-600 underline" target="_blank">
                {{ $project->github_url }}
            </a>
        </p>
    @endif

    @if ($project->techStacks->count())
        <p class="mb-4">
            <strong>Tech Stack:</strong>
            <span class="inline-flex flex-wrap gap-2 mt-2">
                @foreach ($project->techStacks as $stack)
                    <span class="bg-blue-100 text-blue-800 text-sm px-2 py-1 rounded">{{ $stack->name }}</span>
                @endforeach
            </span>
        </p>
    @endif

    <a href="{{ route('projects.edit', $project) }}" class="inline-block mt-6 bg-yellow-500 text-black px-4 py-2 rounded hover:bg-yellow-600">
        Edit Project
    </a>
</div>
@endsection
