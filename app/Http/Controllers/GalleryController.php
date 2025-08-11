<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    public function frontendGallery()
    {
        $galleries = Gallery::latest()->paginate(10);
        $videos = Video::latest()->paginate(10);
        return view('Frontend.gallery.index', compact('galleries', 'videos'));
    }

    public function frontendGalleryShow(Gallery $gallery)
    {
        return view('Frontend.gallery.show', compact('gallery'));
    }
    public function frontendVideoShow(Video $video)
    {
        return view('Frontend.gallery.video', compact('video'));
    }



    public function index()
    {
        $galleries = Gallery::latest()->paginate(7);
        return view('galleries.index', compact('galleries'));
    }

    public function create()
    {
        return view('galleries.create');
    }
public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:20000',
    ]);

    // Store in 'public/gallery' (accessible via web)
    $imagePath = $request->file('image')->store('gallery', 'public');

    Gallery::create([
        'name' => $request->name,
        'description' => $request->description,
        'image' => $imagePath, // No need to modify path
    ]);

    return redirect()->route('galleries.index')
        ->with('success', 'Gallery item created successfully.');
}

    public function show(Gallery $gallery)
    {
        return view('galleries.show', compact('gallery'));
    }

    public function edit(Gallery $gallery)
    {
        return view('galleries.edit', compact('gallery'));
    }

public function update(Request $request, Gallery $gallery)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20000',
    ]);

    $data = $request->only(['name', 'description']);

    if ($request->hasFile('image')) {
        // Delete old image
        Storage::disk('public')->delete($gallery->image);
        
        // Store new image
        $data['image'] = $request->file('image')->store('gallery', 'public');
    }

    $gallery->update($data);

    return redirect()->route('galleries.index')
        ->with('success', 'Gallery item updated successfully.');
}

    public function destroy(Gallery $gallery)
    {
        Storage::delete('public/' . $gallery->image);
        $gallery->delete();

        return redirect()->route('galleries.index')->with('success', 'Gallery item deleted successfully.');
    }

    public function download(Gallery $gallery)
    {
        // Check if user is authenticated
        if (!auth()->check()) {
            return redirect()->route('continue.with')->with('error', 'Please login first to download images.');
        }
        DB::table('gallery_downloads')->insert([
            'gallery_id' => $gallery->id,
            'user_id' => auth()->id(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $path = storage_path('app/public/' . $gallery->image);
        
        // Check if file exists
        if (!file_exists($path)) {
            return back()->with('error', 'The requested image does not exist.');
        }

        // Get the file extension
        $extension = pathinfo($path, PATHINFO_EXTENSION);
        
        // Create a safe download name
        $downloadName = Str::slug("The Foodiety_".$gallery->name) . '.' . $extension;

        return response()->download($path, $downloadName);
    }
}