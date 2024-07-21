<?php

namespace App\Http\Controllers\image;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Image;

class ImageController extends Controller
{
    //PRODUCT IMAGE API FUNCTION
    public function productImageAPI()
    {
        try {
            $data = Image::all();
            return response()->json($data, 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error fetching products images',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // DISPLAY PRODUCT IMAGE FORM PAGE
    public function create($id){
        $data = Product::findOrFail($id);
        return view('pages.single.forms.images', compact('data'));
    }

    // STORE & UPDATE THE PRODUCT IMAGE CREATE FORM
    public function store(Request $request, $id)
    {
        $request->validate([
            'image_name' => 'required|string|max:255',
            'image_type' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:5048',
        ]);
        $image = new Image();
        $image->product_id = $request->product_id;
        $image->image_name = $request->image_name;
        $image->image_text = $request->image_text;
        $image->image_type = $request->image_type;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('resturentImage');
            $file->move($destinationPath, $filename);
            $image->image = 'resturentImage/' . $filename;
        }

        $image->save();

        return redirect()->route('product.detail', $request->product_id)->with('success', 'Image added successfully.');
    }

    // DISPLAY IMAGE EDIT FORM PAGE
    public function edit($id)
    {
        $data = Image::findOrFail($id); 
        $product = $data->product;
        return view('pages.single.edit.edit', compact('data', 'product'));
    }

    // STORE & UPDATE THE PRODUCT IMAGE UPDATE FORM
    public function update(Request $request, $id)
    {
        $image = Image::findOrFail($id);
        $image->product_id = $request->product_id;
        $image->image_name = $request->image_name;
        $image->image_text = $request->image_text;
        $image->image_type = $request->image_type;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('resturentImage');
            $file->move($destinationPath, $filename);
            $image->image = 'resturentImage/' . $filename;
        }
        $image->save();

        return redirect()->route('manage.image', $image->product_id)->with('success', 'Image updated successfully.');
    }
}
