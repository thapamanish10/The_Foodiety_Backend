<?php

namespace App\Http\Controllers\message;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    //
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'message' => 'required|string',
        ]);

        $message = new Message();
        $message->first_name = $request->first_name;
        $message->last_name = $request->last_name;
        $message->email = $request->email;
        $message->phone = $request->phone;
        $message->status = 'unvisited';
        $message->message = $request->message;
        $message->save();

        return redirect()->back()->with('success', 'Message sent successfully.');
    }

    public function createMessage(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'message' => 'required|string',
        ]);

        $message = new Message();
        $message->first_name = $validatedData['first_name'];
        $message->last_name = $validatedData['last_name'];
        $message->email = $validatedData['email'];
        $message->phone = $validatedData['phone'];
        $message->message = $validatedData['message'];
        $message->save();

        return response()->json(['message' => 'Message sent successfully!'], 201);
    }


    // Display the form
    public function create()
    {
        return view('message.create');
    }
    public function index()
    {   
        $datas = Message::paginate(10);
        return view('message.message', compact("datas"));
    }
    public function markAsRead( $id)
    {   
        $message = Message::findOrFail($id);
        $message->status = 'visited';
        $message->save();

        return redirect()->back()->with('success', 'Message mark as read successfully.');
    }
    public function delete($id)
    {
        $message = Message::findOrFail($id);
        $message->delete();
        return redirect()->back()->with('success', 'Message deleted successfully.');
    }
}
