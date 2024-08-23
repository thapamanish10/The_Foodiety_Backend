<?php

namespace App\Http\Controllers\about;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;
use App\Models\AboutImage;

class AboutController extends Controller
{
    public function aboutAPI()
    {
        try {
            $data = About::all();
            return response()->json($data, 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error fetching about data',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function index()
    {
        // Fetch all about records
        $abouts = About::with('images')->get();
        return view('pages.business.business', ['abouts' => $abouts]);
    }
    public function create() {
        return view('pages.business.create');
    }

    public function edit($id) {
        $about = About::findOrFail($id);
        return view('pages.business.edit', ['about' => $about]);
    }

    public function store(Request $request) {
        $this->validateRequest($request);

        $about = new About();
        $this->saveData($about, $request);

        return redirect()->route('business.index')->with('success', 'About added successfully.');
    }

    public function update(Request $request, $id) {
        $this->validateRequest($request);

        $about = About::findOrFail($id);
        $this->saveData($about, $request);

        return redirect()->route('business.index')->with('success', 'About updated successfully.');
    }
    public function delete($id)
    {
        $about = About::findOrFail($id);
        $about->delete();
        return redirect()->route('business.index')->with('success', 'About deleted successfully.');
    }

    private function validateRequest(Request $request) {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'company_logo' => 'required|image|mimes:jpg,jpeg,png|max:5048',
            'phone_number' => 'required|string|max:20',
            'optional_phone_number' => 'nullable|string|max:20',
            'email_address' => 'required|string|max:255',
            'facebook_link' => 'nullable|string|max:255',
            'instagram_link' => 'nullable|string|max:255',
            'youtube_link' => 'nullable|string|max:255',
            'tiktok_link' => 'nullable|string|max:255',
            'threads_link' => 'nullable|string|max:255',
            'about_text' => 'required|string|max:10000',
        ]);
    }

    private function saveData(About $about, Request $request) {
        $about->company_name = $request->company_name;
        $about->phone_number = $request->phone_number;
        $about->optional_phone_number = $request->optional_phone_number;
        $about->email_address = $request->email_address;
        $about->facebook_link = $request->facebook_link;
        $about->instagram_link = $request->instagram_link;
        $about->youtube_link = $request->youtube_link;
        $about->tiktok_link = $request->tiktok_link;
        $about->threads_link = $request->threads_link;
        $about->about_text = $request->about_text;

        if ($request->hasFile('company_logo')) {
            $file = $request->file('company_logo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('companyLogo');
            $file->move($destinationPath, $filename);
            $about->company_logo = 'companyLogo/' . $filename;
        }

        $about->save();
    }

    public function manageAboutImage($id){
        $data = About::with(['images'])->findOrFail($id);
        return view('pages.business.manage.manage' , compact('data'));
    }
    public function deleteAboutImage($id) {
        $data = AboutImage::findOrFail($id);
        $data->delete();
        return redirect()->back()->with('success', 'Image deleted successfully.');
    }
    public function editAboutImage($id)
    {
        $data = AboutImage::findOrFail($id); 
        $about = $data->about;
        return view('pages.business.manage.edit.edit', compact('data', 'about'));
    }
    public function updateAboutImage(Request $request, $id)
    {


        $image = AboutImage::findOrFail($id);
        $image->about_id = $request->about_id;
        $image->image_name = $request->image_name;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('resturentImage');
            $file->move($destinationPath, $filename);
            $image->image = 'resturentImage/' . $filename;
        }
        $image->save();

        return redirect()->route('business.manage.image', $image->about_id)->with('success', 'Image updated successfully.');
    }



    
}
