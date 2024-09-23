<?php

namespace App\Http\Controllers;

use App\Datatables\PostDatatables;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct(
        protected PostDatatables $datatables
    ) {
    }

    public function index(Request $request)
    {
        if ($request->ajax())
            return $this->datatables->datatables($request);
        return view('posts.index', [
            'columns' => $this->datatables->columns()
        ] );
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(PostRequest $request)
    {
        $inputs = $request->validated();
        $inputs['user_id'] = auth()->id();
        Post::create($inputs);
        return redirect()->route('posts.index');
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(PostRequest $request, Post $post)
    {
        $inputs = $request->validated();
        $inputs['user_id'] = auth()->id();
        $post->update($inputs);
        return redirect()->route('posts.index');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index');
    }
}
