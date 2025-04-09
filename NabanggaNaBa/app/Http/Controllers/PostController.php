<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Vehicle;
use App\Models\VehicleImage;
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
            'images' => 'required|array', // Ensure images are an array
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate image types and size
        ]);

        // Create the vehicle post
        $vehicle = Vehicle::create([
            'user_id' => Auth::id(),
            'plate_number' => $request->plate_number,
            'model_year' => $request->model_year,
            'date' => $request->date,
            'place' => $request->place,
            'status' => 'pending', // Default status should be 'pending'
        ]);

        // Store images and associate them with the vehicle
        foreach ($request->file('images') as $image) {
            $imagePath = $image->store('images/vehicles', 'public'); // Store the image

            // Create an entry in the vehicle_images table
            VehicleImage::create([
                'vehicle_id' => $vehicle->id, // Associate the image with the vehicle
                'image' => $imagePath,
            ]);
        }

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
