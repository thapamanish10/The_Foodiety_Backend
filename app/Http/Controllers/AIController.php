<?php

namespace App\Http\Controllers;

use App\Models\AI;
use App\Models\AI_Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AIController extends Controller
{
    public function frontendAI()
    {
        $ais = AI::latest()->paginate(10);
        $videos = AI_Video::latest()->paginate(10);
        return view('Frontend.ai.index', compact('ais', 'videos'));
    }

    public function frontendAIShow(AI $ai)
    {
        return view('Frontend.ai.show', compact('ai'));
    }
    public function frontendVideoShow(AI_Video $video)
    {
        return view('Frontend.ai.video', compact('video'));
    }
    public function index()
    {
        $ais = AI::latest()->paginate(7);
        return view('ais.index', compact('ais'));
    }

    public function create()
    {
        return view('ais.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:20000',
        ]);

        $imagePath = $request->file('image')->store('public/ai');

        AI::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => str_replace('public/', '', $imagePath),
        ]);

        return redirect()->route('ais.index')->with('success', 'AI item created successfully.');
    }

    public function show(AI $ai)
    {
        return view('ais.show', compact('ai'));
    }

    public function edit(AI $ai)
    {
        return view('ais.edit', compact('ai'));
    }

    public function update(Request $request, AI $ai)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20000',
        ]);

        $data = [
            'name' => $request->name,
            'description' => $request->description,
        ];

        if ($request->hasFile('image')) {
            Storage::delete('public/' . $ai->image);
            
            $imagePath = $request->file('image')->store('public/ai');
            $data['image'] = str_replace('public/', '', $imagePath);
        }

        $ai->update($data);

        return redirect()->route('ais.index')->with('success', 'AI item updated successfully.');
    }

    public function destroy(AI $ai)
    {
        Storage::delete('public/' . $ai->image);
        $ai->delete();

        return redirect()->route('ais.index')->with('success', 'AI item deleted successfully.');
    }

    public function download(AI $ai)
    {
        if (!auth()->check()) {
            return redirect()->route('continue.with')->with('error', 'Please login first to download images.');
        }

        $path = storage_path('app/public/' . $ai->image);
        
        if (!file_exists($path)) {
            return back()->with('error', 'The requested image does not exist.');
        }

        $extension = pathinfo($path, PATHINFO_EXTENSION);
        
        $downloadName = Str::slug("The Foodiety AI_".$ai->name) . '.' . $extension;

        return response()->download($path, $downloadName);
    }
}
