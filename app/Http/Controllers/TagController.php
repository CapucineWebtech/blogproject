<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagFormRequest;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TagController extends Controller
{
    public function index(): View
    {
        $tags = Tag::all();
        return view('tags.index', compact("tags"));
    }

    public function create(): View
    {
        $tag = new Tag();
        return view('tags.create', compact("tag"));
    }

    public function store(TagFormRequest $request): RedirectResponse
    {
        $tag = Tag::create($request->validated());
        return redirect()->route('tags.index')->with('success', 'Le tag a bien été créé.');
    }

    public function edite(Tag $tag): View
    {
        return view('tags.edite', compact("tag"));
    }

    public function update(Tag $tag, TagFormRequest $request): RedirectResponse
    {
        $tag->update($request->validated());
        return redirect()->route('tags.edite', $tag)->with('success', 'Le tag a bien été mis à jour.');
    }

    public function destroy(Tag $tag): RedirectResponse
    {
        $tag->delete();
        return redirect()->route('tags.index')->with('success', 'Le tag a bien été supprimé.');
    }
}
