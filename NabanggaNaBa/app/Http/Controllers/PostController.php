<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::where('status', 'approved')->latest()->get();
        return view('app', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'plate_number' => 'required|unique:vehicles',
            'model_year' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $request->file('image')->store('posts', 'public');

        Post::create([
            'user_id' => Auth::id(),
            'plate_number' => $request->plate_number,
            'model_year' => $request->model_year,
            'image' => $imagePath,
            'date' => $request->date,
            'place' => $request->place,
            'status' => 'approved', // Default status should be 'pending' but set to 'approved' for testing
        ]);

        return redirect()->route('posts.index')->with('success', 'Post submitted for review.');
    }

    public function approve($id)
    {
        Post::where('id', $id)->update(['status' => 'approved']);
        return redirect()->back()->with('success', 'Post approved.');
    }

    public function reject($id)
    {
        Post::where('id', $id)->update(['status' => 'rejected']);
        return redirect()->back()->with('error', 'Post rejected.');
    }
}
