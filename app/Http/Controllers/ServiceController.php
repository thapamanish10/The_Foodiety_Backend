<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{

    public function homePageServices()
    {
        $Services = Service::withCount(['images'])
                    ->orderBy('created_at', 'desc')
                    ->get();
        
        return view('Frontend.services.index', compact('Services'));
    }
    public function homePageServicesDetail(Service $service)
    {
        return view('Frontend.services.show',[
            'service' => $service,
        ]);
    }
    public function index()
    {
        $services = Service::all();
        return view('services.index', compact('services'));
    }

    public function create()
    {
        return view('services.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'info' => 'required|string',
            'desc' => 'required|string',
            'why' => 'required|string',
            'why2' => 'nullable|string',
            'offer' => 'required|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:102400',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:102400',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:102400',
        ]);

        $data = $request->except(['logo','thumbnail', 'images']);

        // Handle thumbnail upload
        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('services', 'public');
        }
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('services', 'public');
        }

        // Create the service first
        $service = Service::create($data);

        // Handle multiple images upload
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('service_images', 'public');
                
                ServiceImage::create([
                    'service_id' => $service->id,
                    'path' => $path
                ]);
            }
        }

        return redirect()->route('services.index')
            ->with('success', 'Service created successfully.');
    }

    public function show(Service $service)
    {

        return view('services.show', compact('service'));
    }

    public function edit(Service $service)
    {
        return view('services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'info' => 'required|string',
            'desc' => 'required|string',
            'why' => 'required|string',
            'why2' => 'nullable|string',
            'offer' => 'required|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:102400',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:102400',
        ]);

        $data = $request->except('thumbnail');

        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($service->logo) {
                Storage::disk('public')->delete($service->logo);
            }
            $data['logo'] = $request->file('logo')->store('services', 'public');
        }
        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail if exists
            if ($service->thumbnail) {
                Storage::disk('public')->delete($service->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('services', 'public');
        }

        $service->update($data);

        return redirect()->route('services.index')->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service)
    {
        if ($service->logo) {
            Storage::disk('public')->delete($service->logo);
        }
        
        if ($service->thumbnail) {
            Storage::disk('public')->delete($service->thumbnail);
        }
        
        $service->delete();
        
        return redirect()->route('services.index')->with('success', 'Service deleted successfully.');
    }
}