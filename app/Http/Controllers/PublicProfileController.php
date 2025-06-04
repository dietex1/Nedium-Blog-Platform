<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PublicProfileController extends Controller
{
    public function show( User $user)
    {
        return view('profile.show', [
            'user' => $user,
            'posts' => $user->posts()->withCount('likes')->orderBy('created_at', 'DESC'),
        ]);
    }
}
