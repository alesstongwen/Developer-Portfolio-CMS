<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::with('techStacks')->where('user_id', auth()->id())->get();
        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $techStacks = \App\Models\TechStack::all();
        return view('projects.create', compact('techStacks'));
    }

    /**
     * Store a newly created resource in storage.
     */

     public function store(Request $request)
     {
        \Log::debug('Request details:', [
            'method' => $request->method(), 
            'has_file' => $request->hasFile('image'),
            'content_type' => $request->header('Content-Type'),
            'all_headers' => $request->headers->all()
        ]);
        \Log::debug('Files info:', [
            'all_files' => $request->allFiles(),
            'file_key_exists' => $request->has('image'),
            'file_object_type' => $request->file('image') ? get_class($request->file('image')) : 'null'
        ]);
         
         $validated = $request->validate([
             'title' => 'required|string|max:255',
             'description' => 'required',
             'github_url' => 'nullable|url',
             'image' => 'nullable|image|mimes:jpg,jpeg,png|max:5120', 
             'tech_stack_ids' => 'array'
         ]);
     
         if ($request->hasFile('image')) {
             $file = $request->file('image');
             \Log::debug('File details:', [
                'exists' => $file->isValid(), 
                'size' => $file->getSize(),
                'error' => $file->getError(),
                'errorMessage' => $this->getUploadErrorMessage($file->getError())
            ]);
         
             if ($file->isValid()) {
                 $path = $file->store('project_images', 'public');
                 \Log::debug('✅ Image stored at: ' . $path);
                 $validated['image'] = $path;
             } else {
                 \Log::debug('❌ Uploaded file is not valid.', [
                     'errorCode' => $file->getError(),
                     'originalName' => $file->getClientOriginalName()
                 ]);
             }
         } else {
             \Log::debug('❌ No image file present in request.');
         }
         
         $project = new Project($validated);
         $project->user_id = auth()->id(); // associate project with logged-in user
         $project->save();
     
         $project->techStacks()->sync($request->input('tech_stack_ids', []));
     
         return redirect()->route('projects.index')->with('success', 'Project created!');
     }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $techStacks = \App\Models\TechStack::all();
        return view('projects.edit', compact('project', 'techStacks'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'github_url' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:5120', 
            'tech_stack_ids' => 'array'
        ]);
    
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('project_images', 'public');
        } else {
            unset($validated['image']); // ← prevent overwriting existing image
        }
    
        $project->update($validated);
        $project->techStacks()->sync($request->input('tech_stack_ids', []));
    
        return redirect()
            ->route('projects.show', $project)
            ->with('success', 'Project updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        if ($project->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
    
        // Delete the image from storage if it exists
        if ($project->image && \Storage::disk('public')->exists($project->image)) {
            \Storage::disk('public')->delete($project->image);
            \Log::debug('🗑️ Deleted image: ' . $project->image);
        }
    
        // Detach tech stacks (optional, for clean pivot table)
        $project->techStacks()->detach();
    
        // Delete the project
        $project->delete();
    
        return redirect()
            ->route('projects.index')
            ->with('success', 'Project deleted successfully!');
    }
    private function getUploadErrorMessage($errorCode) {
        $errors = [
            UPLOAD_ERR_INI_SIZE => 'File exceeds upload_max_filesize',
            UPLOAD_ERR_FORM_SIZE => 'File exceeds MAX_FILE_SIZE in form',
            UPLOAD_ERR_PARTIAL => 'File was only partially uploaded',
            UPLOAD_ERR_NO_FILE => 'No file was uploaded',
            UPLOAD_ERR_NO_TMP_DIR => 'Missing temporary folder',
            UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk',
            UPLOAD_ERR_EXTENSION => 'A PHP extension stopped the upload'
        ];
        return $errors[$errorCode] ?? 'Unknown upload error';
    }
}
