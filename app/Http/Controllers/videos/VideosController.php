<?php

namespace App\Http\Controllers\videos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Video;
use App\Models\Product;

class VideosController extends Controller
{
    //
    public function productVideoAPI()
    {
        try {
            $data = Video::all();
            return response()->json($data, 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error fetching products videos',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function create($id){
        $data = Product::findOrFail($id);
        return view('pages.single.forms.video', compact('data'));
    }

    // Store the product video
    public function store(Request $request, $id)
    {
        $request->validate([
            'video_name' => 'required|string|max:255',
            'video' => 'required|mimes:mp4,avi,mov',
            'video_type' => 'required|string',
        ]);
        $video = new Video();
        $video->product_id =  $request->product_id;
        $video->video_name = $request->video_name;
        $video->video_type = $request->video_type;
        
        if ($request->hasFile('video')) {
            $file = $request->file('video');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('restaurantVideo');
            $file->move($destinationPath, $filename);
            $video->video = 'restaurantVideo/' . $filename;
        }

        $video->save();

        return redirect()->route('product.detail', $request->product_id)->with('success', 'video added successfully.');
    }

    // Display video edit form page
    public function edit($id)
    {
        $data = Video::findOrFail($id);
        $product = $data->product;
        return view('pages.single.video.video', compact('data', 'product'));
    }

    // Update the product video
    public function update(Request $request, $id)
    {
        $video = Video::findOrFail($id);
        $video->product_id = $request->product_id;
        $video->video_name = $request->video_name;
        $video->video_type = $request->video_type;

        if ($request->hasFile('video')) {
            $file = $request->file('video');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('restaurantVideo');
            $file->move($destinationPath, $filename);
            $video->video = 'restaurantVideo/' . $filename;
        }

        $video->save();

        return redirect()->route('manage.image', $video->product_id)->with('success', 'Video updated successfully.');
    }
    public function deleteVideo($id) {
        $data = Video::findOrFail($id);
        $data->delete();
        return redirect()->back()->with('success', 'Video deleted successfully.');
    }
}
