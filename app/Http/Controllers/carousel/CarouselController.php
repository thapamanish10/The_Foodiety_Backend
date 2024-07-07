<?php

namespace App\Http\Controllers\carousel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Carousel;

class CarouselController extends Controller
{
    public function carouselImageAPI()
    {
        try {
            $data = Carousel::all();
            return response()->json($data, 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error fetching carousel images',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function index() {
        $carousels = Carousel::all();
        return view('pages.carousel.carousel', ['carousels' => $carousels]);
    }

    public function create() {
        return view('pages.carousel.create');
    }

    public function store(Request $request) {
        $this->validateRequest($request);

        $carousel = new Carousel();
        $this->saveData($carousel, $request);

        return redirect()->route('carousel.index')->with('success', 'Carousel added successfully.');
    }
    
    public function edit($id) {
        $carousel = Carousel::findOrFail($id);
        return view('pages.carousel.edit', ['carousel' => $carousel]);
    }

    public function update(Request $request, $id) {
        $this->validateRequest($request);

        $carousel = Carousel::findOrFail($id);
        $this->saveData($carousel, $request);

        return redirect()->route('carousel.index')->with('success', 'Carousel updated successfully.');
    }

    public function delete($id) {
        $carousel = Carousel::findOrFail($id);
        $carousel->delete();
        return redirect()->route('carousel.index')->with('success', 'Carousel deleted successfully.');
    }

    private function validateRequest(Request $request) {
        $request->validate([
            'carousel_title' => 'string|max:255',
            'carousel_Image' => 'image|mimes:jpg,jpeg,png|max:5048',
            'carousel_status' => 'string|max:20',
        ]);
    }

    private function saveData(Carousel $carousel, Request $request) {
        $carousel->carousel_title = $request->carousel_title;
        $carousel->carousel_status = $request->carousel_status;

        if ($request->hasFile('carousel_Image')) {
            $file = $request->file('carousel_Image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('carouselImage');
            $file->move($destinationPath, $filename);
            $carousel->carousel_Image = 'carouselImage/' . $filename;
        }

        $carousel->save();
    }
}
