<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalPosts = Post::count();
        $approvedPosts = Post::where('status', 'approved')->count();
        $pendingPosts = Post::where('status', 'pending')->get();

        return view('admin.dashboard', compact('totalUsers', 'totalPosts', 'approvedPosts', 'pendingPosts'));
    }
}