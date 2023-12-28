<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryFormRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::all();
        return view('categories.index', compact("categories"));
    }

    public function create(): View
    {
        $category = new Category();
        return view('categories.create', compact("category"));
    }

    public function store(CategoryFormRequest $request): RedirectResponse
    {
        $category = Category::create($request->validated());
        return redirect()->route('categories.index')->with('success', 'Catégorie créée.');
    }

    public function edite(Category $category): View
    {
        $categories = Category::all();
        return view('categories.edite', compact("category", "categories"));
    }

    public function update(Category $category, CategoryFormRequest $request): RedirectResponse
    {
        $category->update($request->validated());
        return redirect()->route('categories.edite', $category)->with('success', 'Catégorie modifiée.');
    }

    public function destroy(Category $category): RedirectResponse
    {
        try {
            $category->delete();
            return redirect()->route('categories.index')->with('success', 'Catégorie supprimée.');
        } catch (QueryException $e) {
            return redirect()->route('categories.edite', $category)->with('error', 'Supprimez ou réassignez les articles liés à cette catégorie avant de la supprimer.');
        }
    }

    public function reassignPosts(Category $category, Request $request): RedirectResponse
    {
        $request->validate([
            'new_category' => 'required|exists:categories,id',
            'posts' => 'array',
            'posts.*' => 'exists:posts,id',
        ]);

        if (!empty($request->input('posts'))) {
            Post::whereIn('id', $request->input('posts'))->update(['category_id' => $request->input('new_category')]);
            return redirect()->route('categories.edite', $category)->with('success', 'Post réassigné');
        } else {
            Post::where('category_id', $category->id)->update(['category_id' => $request->input('new_category')]);
            return redirect()->route('categories.edite', $category)->with('success', 'Posts réassignés');
        }
    }

}
