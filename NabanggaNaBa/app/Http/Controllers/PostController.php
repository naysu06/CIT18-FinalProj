<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        // Get all approved posts
        $posts = Post::where('status', 'approved')->latest()->get();
        return view('app', compact('posts'));
    }

    public function create()
    {
        // Return view for creating a post
        return view('posts.create');
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'plate_number' => 'required|unique:vehicles',
            'model_year' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Check if an image file is uploaded
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            // Store the image in 'storage/app/public/images/vehicles'
            $imagePath = $request->file('image')->store('images/vehicles', 'public');
        } else {
            return redirect()->back()->with('error', 'Invalid image upload.');
        }

        // Create the post with the validated data and store the relative image path
        Post::create([
            'user_id' => Auth::id(),
            'plate_number' => $request->plate_number,
            'model_year' => $request->model_year,
            'image' => $imagePath, // Store the relative path
            'date' => $request->date,
            'place' => $request->place,
            'status' => 'pending', // Default status should be 'pending'
        ]);

        // Redirect back with a success message
        return redirect()->route('posts.index')->with('success', 'Post submitted for review.');
    }

    public function approve($id)
    {
        // Update the post status to 'approved'
        Post::where('id', $id)->update(['status' => 'approved']);
        return redirect()->back()->with('success', 'Post approved.');
    }

    public function reject($id)
    {
        // Update the post status to 'rejected'
        Post::where('id', $id)->update(['status' => 'rejected']);
        return redirect()->back()->with('error', 'Post rejected.');
    }
}
