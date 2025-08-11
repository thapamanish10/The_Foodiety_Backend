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
    
        // Store video file
        $videoFile = $request->file('video_path');
        $videoPath = $videoFile->store('gallery', 'public');
        $videoFilename = str_replace('public/', '', $videoPath);
    
        // Store thumbnail file
        $thumbnailFile = $request->file('thumbnail_path');
        $thumbnailPath = $thumbnailFile->store('public/thumbnails');
        $thumbnailFilename = str_replace('public/', '', $thumbnailPath);
    
        AI_Video::create([
            'name' => $validated['name'],
            'desc' => $validated['desc'],
            'video_path' => $videoFilename,
            'thumbnail_path' => $thumbnailFilename,
        ]);
    
        return redirect()->route('ai-videos.index')->with('success', 'Video uploaded successfully.');
    }

    public function show(AI_Video $video)
    {
        return view('ais-videos.show', compact('video'));
    }

    public function edit(AI_Video $video)
    {
        return view('ais-videos.edit', compact('video'));
    }

    public function update(Request $request, AI_Video $video)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'desc' => 'nullable|string',
            'video_path' => 'nullable|mimetypes:video/mp4,video/quicktime,video/x-msvideo|max:50000',
            'thumbnail_path' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'desc' => $request->desc,
        ];

        if ($request->hasFile('video')) {
            // Delete old video
            Storage::delete('public/' . $video->video_path);

            // Store new video
            $videoPath = $request->file('video')->store('gallery', 'public');
            $data['video_path'] = str_replace('public/', '', $videoPath);
        }

        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail
            Storage::delete('public/' . $video->thumbnail_path);

            // Store new thumbnail
            $thumbnailPath = $request->file('thumbnail')->store('public/thumbnails');
            $data['thumbnail_path'] = str_replace('public/', '', $thumbnailPath);
        }

        $video->update($data);

        return redirect()->route('ai-videos.index')->with('success', 'Video updated successfully.');
    }

    public function destroy(AI_Video $video)
    {
        Storage::delete([
            'public/' . $video->video_path,
            'public/' . $video->thumbnail_path
        ]);
        $video->delete();

        return redirect()->route('ai-videos.index')->with('success', 'Video deleted successfully.');
    }

    public function download(AI_Video $video)
    {
        if (!auth()->check()) {
            return redirect()->route('continue.with')->with('error', 'Please login first to download videos.');
        }
        DB::table('video_downloads')->insert([
            'video_id' => $video->id,
            'user_id' => auth()->id(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $path = storage_path('app/public/' . $video->video_path);
        
        if (!file_exists($path)) {
            return back()->with('error', 'The requested video does not exist.');
        }

        $extension = pathinfo($path, PATHINFO_EXTENSION);
        $downloadName = Str::slug($video->name) . '.' . $extension;

        return response()->download($path, $downloadName);
    }
}