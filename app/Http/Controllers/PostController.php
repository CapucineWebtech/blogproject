<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostFormRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index(Request $request): View
    {
        $categories = Category::all();
        $tags = Tag::all();

        $query = Post::query();

        if ($request->has('category_id')) {
            $query->where('category_id', $request->input('category_id'));
        }

        if ($request->has('tag_id')) {
            $query->whereHas('tags', function ($q) use ($request) {
                $q->where('id', $request->input('tag_id'));
            });
        }

        $posts = $query->get();
        return view('posts.index', compact("posts", "categories", "tags"));
    }

    public function show(Post $post): View
    {
        return view('posts.show', compact("post"));
    }

    public function create(): View
    {
        $post = new Post();
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.create', compact("post", "categories", "tags"));
    }

    public function store(PostFormRequest $request): RedirectResponse
    {
        $user = auth()->user();
        $validatedData = $request->validated();
        $validatedData['user_id'] = $user->getAuthIdentifier();
        $post = Post::create($validatedData);
        if (isset($validatedData['tags'])) {
            $post->tags()->attach($validatedData['tags']);
        }
        return redirect()->route('posts.show', $post);
    }

    public function edite(Post $post): View
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.edite', compact("post", "categories", "tags"));
    }

    public function update(Post $post, PostFormRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();
        unset($validatedData['user_id']);

        $post->update($validatedData);

        if (isset($validatedData['tags'])) {
            $post->tags()->sync($validatedData['tags']);
        } else {
            $post->tags()->detach();
        }

        return redirect()->route('posts.show', $post)->with('success', "L'article a bien été mis à jour.");
    }

    public function destroy(Post $post, Request $request): RedirectResponse
    {
        $post->delete();
        if (Str::contains($request->header('referer'), route('posts.edite', $post))) {
            return redirect()->route('posts.index')->with('success', "L'article a bien été supprimé.");
        }
        return back()->with('success', "L'article a bien été supprimé.");
    }
}
