<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts= Post::orderBy('created_at','DESC')->withCount('likes')->simplepaginate(10);
        return view('post.index', [ 'posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();
        return view('post.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostCreateRequest $request)
    {
        $data = $request->validated();

        $image = $data['image'];
        $data['user_id'] = Auth::id();
        $imagePath = $image->store('posts', 'public');
        $data['image'] = $imagePath;
        Post::create($data);

        return redirect()->route('dashboard');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $username, Post $post)
    {
        return view('post.show', [
            'post' => $post,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        if ( $post->user_id != Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        $categories = Category::get();
        return view('post.edit',['post' => $post, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostUpdateRequest $request, Post $post)
    {
        if ( $post->user_id != Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        $data = $request->validated();
        $post->update($data);

        if ( $data['image'] ?? false) {
            $image = $data['image'];
            $imagePath = $image->store('posts', 'public');
            $post->image = $imagePath;
        }
        return redirect()->route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        $post->delete();
        return redirect()->route('dashboard')->with('success', 'Post deleted successfully.');
    }

    public function category(Category $category)
    {
        $posts = $category->posts()->latest()->withCount('likes')->simplePaginate(10);
        return view('post.index', ['posts' => $posts]);
    }
}
