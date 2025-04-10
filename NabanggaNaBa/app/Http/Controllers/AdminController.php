<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Fetch all vehicles with 'pending' status for admin to approve/reject
        $pendingVehicles = Post::where('status', 'pending')->get();

        return view('admin.dashboard', compact('pendingVehicles'));
    }

    // Method to approve a vehicle post
    public function approveVehicle($id)
    {
        $vehicle = Post::find($id);
        
        if ($vehicle) {
            $vehicle->status = 'approved'; // Change status to 'approved'
            $vehicle->save();
        }

        return redirect()->route('admin.dashboard');
    }

    // Method to reject a vehicle post
    public function rejectVehicle($id)
    {
        $vehicle = Post::find($id);

        if ($vehicle) {
            $vehicle->status = 'rejected'; // Change status to 'rejected'
            $vehicle->save();
        }

        return redirect()->route('admin.dashboard');
    }
}