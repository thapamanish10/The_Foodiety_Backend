<?php

namespace App\Http\Controllers;

use App\Models\AI_Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AIVideoController extends Controller
{
    public function index()
    {
        $videos = AI_Video::latest()->paginate(7);
        return view('ais-videos.index', compact('videos'));
    }

    public function create()
    {
        return view('ais-videos.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'desc' => 'nullable|string',
            'video_path' => 'required|file|mimetypes:video/mp4,video/quicktime,video/x-msvideo|max:50000',
            'thumbnail_path' => 'required|image|mimes:jpeg,png,jpg|max:20000',
        ]);
    
        // Store video file using public disk
        $videoPath = $request->file('video_path')->store('gallery', 'public');
        
        // Store thumbnail file using public disk
        $thumbnailPath = $request->file('thumbnail_path')->store('gallery', 'public');
        AI_Video::create([
            'name' => $validated['name'],
            'desc' => $validated['desc'],
            'video_path' => $videoPath,  // No path modification needed
            'thumbnail_path' => $thumbnailPath,
        ]);
    
        return redirect()->route('ai-videos.index')->with('success', 'Video uploaded successfully.');
    }

    public function show(AI_Video $ai_video)
    {
        return view('ais-videos.show', compact('ai_video'));
    }

    public function edit(AI_Video $ai_video)
    {
        return view('ais-videos.edit', compact('ai_video'));
    }

    public function update(Request $request, AI_Video $ai_video)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'desc' => 'nullable|string',
            'video_path' => 'nullable|mimetypes:video/mp4,video/quicktime,video/x-msvideo|max:50000',
            'thumbnail_path' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->only(['name', 'desc']);

        if ($request->hasFile('video_path')) {
            // Delete old video
            Storage::disk('public')->delete($ai_video->video_path);

            // Store new video
            $data['video_path'] = $request->file('video_path')->store('gallery', 'public');
        }

        if ($request->hasFile('thumbnail_path')) {
            // Delete old image
            Storage::disk('public')->delete($ai_video->thumbnail_path);
            
            // Store new image
            $data['thumbnail_path'] = $request->file('thumbnail_path')->store('gallery', 'public');
        }

        $ai_video->update($data);

        return redirect()->route('ai-videos.index')->with('success', 'Video updated successfully.');
    }

    public function destroy(AI_Video $ai_video)
    {
        Storage::delete([
            'public/' . $ai_video->video_path,
            'public/' . $ai_video->thumbnail_path
        ]);
        $ai_video->delete();

        return redirect()->route('ai-videos.index')->with('success', 'Video deleted successfully.');
    }

    public function download(AI_Video $ai_video)
    {
        if (!auth()->check()) {
            return redirect()->route('continue.with')->with('error', 'Please login first to download videos.');
        }
        DB::table('video_downloads')->insert([
            'video_id' => $ai_video->id,
            'user_id' => auth()->id(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $path = storage_path('app/public/' . $ai_video->video_path);
        
        if (!file_exists($path)) {
            return back()->with('error', 'The requested video does not exist.');
        }

        $extension = pathinfo($path, PATHINFO_EXTENSION);
        $downloadName = Str::slug($ai_video->name) . '.' . $extension;

        return response()->download($path, $downloadName);
    }
}