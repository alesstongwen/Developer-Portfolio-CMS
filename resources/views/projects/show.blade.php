@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-10">
    <h1 class="text-3xl font-bold">{{ $project->title }}</h1>

    @if ($project->image)
        <img src="{{ asset('storage/' . $project->image) }}" class="my-4 max-h-64">
    @endif

    <p class="text-gray-700 mb-4">{{ $project->description }}</p>

    <p><strong>GitHub:</strong> 
        <a href="{{ $project->github_url }}" class="text-blue-600 underline" target="_blank">
            {{ $project->github_url }}
        </a>
    </p>

    <div class="mt-4">
        <h2 class="font-semibold">Tech Stack:</h2>
        @foreach ($project->techStacks as $stack)
            <span class="inline-block bg-gray-200 px-3 py-1 rounded-full text-sm mr-2">{{ $stack->name }}</span>
        @endforeach
    </div>

    <div class="mt-6">
        <a href="{{ route('projects.index') }}" class="text-blue-600 underline">← Back to Projects</a>
    </div>
</div>
@endsection
