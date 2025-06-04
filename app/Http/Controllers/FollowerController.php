<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use function Pest\Laravel\json;

class FollowerController extends Controller
{
    public function followUnfollow(User $user)
    {
        $user->followers()->toggle(auth()->id());
        return response()->json([
            'followersCount' => $user->followers()->count(),
        ]);
    }
}
