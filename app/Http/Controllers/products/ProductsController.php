<?php

namespace App\Http\Controllers\products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Review;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class ProductsController extends Controller
{
    // DISPLAY PRODUCT PAGE
    public function index()
    {
        $datas = Product::paginate(10);
        $totalDatas = Product::count();
        return view('pages.product.product', compact('datas', 'totalDatas'));
    }

    // PRODUCT API FUNCTION
    public function productAPI()
    {
        try {
            $data = Product::all();
            return response()->json($data, 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error fetching products',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function productDetailAPI($id)
    {
        try {
            $data = Product::findOrFail($id);
            return response()->json($data, 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error fetching products details',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // DISPLAY CREATE PRODUCT FORM PAGE
    public function create()
    {
        return view('pages.product.create.create');
    }

    // STORE DATA & CREATE NEW PRODUCT / ITEM
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'company_logo' => 'nullable|image|mimes:jpg,jpeg,png|max:5048',
            'location' => 'nullable|string',
            'phone_number' => 'nullable|string|max:20',
            'about_us' => 'nullable|string',
            'features' => 'nullable|string',
            'rating' => 'nullable|numeric|min:1|max:5',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->location = $request->location;
        $product->phone_number = $request->phone_number;
        $product->about_us = $request->about_us;
        $product->features = $request->features;
        $product->rating = $request->rating ?? null;

        if ($request->hasFile('company_logo')) {
            $file = $request->file('company_logo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('companyLogo');
            $file->move($destinationPath, $filename);
            $product->company_logo = 'companyLogo/' . $filename;
        } else {
            $product->company_logo = '/asset/foodiety.png'; // Default image path
        }

        $product->save();

        return redirect()->route('product')->with('success', 'Product added successfully.');
    }

    // DISPLAY PRODUCT SINGLE DETAILS PAGE
    public function detail($id)
    {
        $data = Product::with(['reviews', 'images'])->findOrFail($id);
        return view('pages.single.single', compact('data'));
    }

    public function manageImage($id)
    {
        $data = Product::with(['images', 'videos'])->findOrFail($id);
        return view('pages.single.manage.manage', compact('data'));
    }

    public function deleteImage($id)
    {
        $data = Image::findOrFail($id);
        $data->delete();
        return redirect()->route('product', $data->id)->with('success', 'Image deleted successfully.');
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('product')->with('success', 'Product deleted successfully.');
    }

    // DISPLAY PRODUCT LOCATION UPDATE FORM PAGE
    public function location($id)
    {
        $data = Product::findOrFail($id);
        return view('pages.single.forms.location', compact('data'));
    }

    // STORE & UPDATE THE PRODUCT LOCATION UPDATE FORM
    public function locationStore(Request $request, $id)
    {
        $request->validate([
            'location' => 'nullable|string',
            'latitude' => 'nullable',
            'longitude' => 'nullable',
            'phone_number' => 'nullable|string|max:20',
            'website_link' => 'nullable|string',
            'menu' => 'nullable|string',
            'opening_time' => 'nullable|string',
        ]);
        $product = Product::findOrFail($id);
        $product->location = $request->location;
        $product->latitude = $request->latitude;
        $product->longitude = $request->longitude;
        $product->phone_number = $request->phone_number;
        $product->website_link = $request->website_link;
        $product->menu = $request->menu;
        $product->opening_time = $request->opening_time;

        $product->save();

        return redirect()->route('product.detail', $product->id)->with('success', 'Product updated successfully.');
    }

    // DISPLAY PRODUCT DETAILS FORM PAGE
    public function about($id)
    {
        $data = Product::findOrFail($id);
        return view('pages.single.forms.details', compact('data'));
    }

    // STORE & UPDATE THE PRODUCT DETAILS UPDATE FORM
    public function aboutStore(Request $request, $id)
    {
        $request->validate([
            'price_range' => 'nullable|string|max:100',
            'cuisines' => 'nullable|string',
            'special_diets' => 'nullable|string',
            'meals' => 'nullable|string',
            'about_us' => 'nullable|string',
            'features' => 'nullable|string',
        ]);

        $product = Product::findOrFail($id);
        $product->price_range = $request->price_range;
        $product->cuisines = $request->cuisines;
        $product->special_diets = $request->special_diets;
        $product->meals = $request->meals;
        $product->about_us = $request->about_us;
        $product->features = $request->features;

        $product->save();

        return redirect()->route('product.detail', $product->id)->with('success', 'Product updated successfully.');
    }

    // DISPLAY PRODUCT REVIEW FORM PAGE
    public function review($id)
    {
        $data = Product::findOrFail($id);
        return view('pages.single.forms.review', compact('data'));
    }

    // STORE & UPDATE THE PRODUCT REVIEW CREATE FORM
    public function reviewCreate(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'review_title' => 'required|string|max:255',
            'visit_date' => 'nullable|date',
            'visit_with' => 'nullable|string|max:255',
            'review_text' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:5048',
        ]);

        $review = new Review();
        $review->product_id = $request->product_id;
        $review->username = "Foodiety"; // Assuming a default username
        $review->review_title = $request->review_title;
        $review->visit_date = $request->visit_date;
        $review->visit_with = $request->visit_with;
        $review->review_text = $request->review_text;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('reviewImage');
            $file->move($destinationPath, $filename);
            $review->image = 'reviewImage/' . $filename;
        }

        $review->save();

        return redirect()->route('product.detail', $request->product_id)->with('success', 'Review added successfully.');
    }

    // DISPLAY REVIEW EDIT FORM PAGE
    public function reviewEdit($id)
    {
        $review = Review::findOrFail($id);
        $product = Product::findOrFail($review->product_id);
        return view('pages.single.forms.editReview', compact('product', 'review'));
    }

    // STORE & UPDATE THE PRODUCT REVIEW UPDATE FORM
    public function reviewUpdate(Request $request, $id)
    {
        $request->validate([
            'review_title' => 'required|string|max:255',
            'visit_date' => 'nullable|date',
            'visit_with' => 'nullable|string|max:255',
            'review_text' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:5048',
        ]);

        $review = Review::findOrFail($id);
        $review->review_title = $request->review_title;
        $review->visit_date = $request->visit_date;
        $review->visit_with = $request->visit_with;
        $review->review_text = $request->review_text;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('reviewImage');
            $file->move($destinationPath, $filename);
            $review->image = 'reviewImage/' . $filename;
        }

        $review->save();

        return redirect()->route('product.detail', $review->product_id)->with('success', 'Product review updated successfully.');
    }
}
