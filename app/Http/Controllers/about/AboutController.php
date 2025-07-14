<?php

namespace App\Http\Controllers\about;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;
use App\Models\AboutImage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    public function homePageAbouts()
    {
        $abouts = About::withCount(['images'])
                    ->orderBy('created_at', 'desc')
                    ->get();
        
        return view('Frontend.pages.about.index', compact('abouts'));
    }
    public function homePageAboutsDetail(About $busines)
    {
         $abouts = About::withCount(['images'])
                    ->orderBy('created_at', 'desc')
                    ->get();
        return view('Frontend.pages.about.show',[
            'abouts' => $abouts,
        ]);
    }
    public function index()
    {
        $abouts = About::withCount(['images'])
                    ->orderBy('created_at', 'desc')
                    ->get();
        
        return view('pages.abouts.index', compact('abouts'));
    }

    public function create()
    {
        return view('pages.abouts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'desc' => 'required',
            'number' => 'required',
            'email' => 'required',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:102400',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:102400',
            'opt_number' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'youtube' => 'nullable|string|max:255',
            'tiktok' => 'nullable|string|max:255',
            'threads' => 'nullable|string|max:255',
        ]);

        $about = About::create($request->except(['images']));

        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($about->logo) {
                Storage::disk('public')->delete($about->logo);
            }
            
            // Store new logo in public disk (storage/app/public/logos)
            $path = $request->file('logo')->store('logos', 'public');
            $validated['logo'] = $path; // This will store the correct relative path
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('About_images', 'public');
                AboutImage::create([
                    'about_id' => $about->id,
                    'path' => $path
                ]);
            }
        }

        return redirect()->route('business.index')->with('success', 'About created successfully.');
    }

    public function show(About $about)
    {
        return view('pages.abouts.show',[
            'About' => $about,
        ]);
    }

    public function edit(About $business)
    {
        return view('pages.abouts.edit', [
            'about' => $business
        ]);
    }

    public function update(Request $request, About $business)
    {
        // Validate request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'desc' => 'required|string',
            'number' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240', // 10MB
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240', // 10MB
            'opt_number' => 'nullable|string|max:20',
            'facebook' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'youtube' => 'nullable|url|max:255',
            'tiktok' => 'nullable|url|max:255',
            'threads' => 'nullable|url|max:255',
            'removed_images' => 'nullable|array',
            'removed_images.*' => 'exists:about_images,id,about_id,'.$business->id
        ]);
    
        DB::beginTransaction();
    
        try {
            // Handle logo upload
            if ($request->hasFile('logo')) {
                // Delete old logo if exists
                if ($business->logo) {
                    Storage::disk('public')->delete($business->logo);
                }
                
                $validated['logo'] = $request->file('logo')->store('about/logos', 'public');
            }
    
            // Update About data
            $business->update($validated);
    
            // Handle removed images
            if ($request->filled('removed_images')) {
                $imagesToDelete = AboutImage::where('about_id', $business->id)
                                          ->whereIn('id', $request->removed_images)
                                          ->get();
    
                foreach ($imagesToDelete as $image) {
                    Storage::disk('public')->delete($image->path);
                    $image->delete();
                }
            }
    
            // Handle new image uploads
            if ($request->hasFile('images')) {
                $imagePaths = [];
                
                foreach ($request->file('images') as $image) {
                    $path = $image->store('about/images', 'public');
                    $imagePaths[] = ['path' => $path];
                }
    
                // Bulk insert for better performance
                $business->images()->createMany($imagePaths);
            }
    
            DB::commit();
    
            return redirect()->back()
                           ->with('success', 'About information updated successfully.');
    
        } catch (\Exception $e) {
            DB::rollBack();
            
            Log::error('About update failed: ' . $e->getMessage());
            
            return redirect()->back()
                           ->with('error', 'Failed to update About information. Please try again.')
                           ->withInput();
        }
    }

    public function deleteImage(AboutImage $image)
    {
        // Check if the authenticated user owns the About that contains this image
        if (auth()->user()->id !== $image->About->user_id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        try {
            // Delete the file from storage
            Storage::delete('public/' . $image->path);
            
            // Delete the image record from database
            $image->delete();
            
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete image'], 500);
        }
    }
    public function destroy(About $about)
    {
        // Delete associated image if exists
        if ($about->image) {
            Storage::disk('public')->delete($about->image);
        }
        
        $about->delete();
        return redirect()->route('Abouts.index')->with('success', 'About deleted successfully.');
    }



    
}
