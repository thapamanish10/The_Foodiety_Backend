<?php

namespace App\Http\Controllers\about\image;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutImage;
use App\Models\About;

class AboutImageController extends Controller
{
    //
    public function aboutImageAPI()
    {
        try {
            $data = AboutImage::all();
            return response()->json($data, 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error fetching about images',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    // DISPLAY PRODUCT IMAGE FORM PAGE
    public function create($id){
        $data = About::findOrFail($id);
        return view('pages.business.images.create', compact('data'));
    }
    // STORE & UPDATE THE PRODUCT IMAGE CREATE FORM
    public function store(Request $request, $id)
    {
        $request->validate([
            'image_name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:5048',
        ]);
        
        $image = new AboutImage();
        $image->about_id = $request->about_id;
        $image->image_name = $request->image_name;
        $image->image_text = $request->image_text;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('aboutImage');
            $file->move($destinationPath, $filename);
            $image->image = 'aboutImage/' . $filename;
        }

        $image->save();

        return redirect()->route('business.index')->with('success', 'Image added successfully.');
    }

    // DISPLAY IMAGE EDIT FORM PAGE
    public function viewEditImageForm($id)
    {
        $review = Review::findOrFail($id);
        $product = Product::findOrFail($review->product_id);
        return view('pages.single.forms.editReview', compact('product', 'review'));
    }

    // STORE & UPDATE THE PRODUCT IMAGE UPDATE FORM
    public function viewUpdateImageForm(Request $request, $id)
    {
        $review = Review::findOrFail($id);
        $review->product_id = $request->product_id;
        $review->username = "Foodiety";
        $review->review_text = $request->review_text;
        $review->save();

        return redirect()->route('products.single', $review->product_id)->with('success', 'Product review updated successfully.');
    }
}
