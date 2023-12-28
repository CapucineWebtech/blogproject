<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserFormRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::all();
        return view('users.index', compact("users"));
    }

    public function show(User $user): View
    {
        return view('users.show', compact("user"));
    }

    public function create(): View
    {
        $user = new User();
        return view('users.create', compact("user"));
    }

    public function store(UserFormRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();
        $validatedData['password'] = Hash::make($validatedData['password']);

        $adminRole = Role::where('name', 'admin')->first();
        if (!$adminRole) {
            $adminRole = Role::create(['name' => 'admin']);
        }

        $adminExists = User::whereHas('roles', function ($query) use ($adminRole) {
            $query->where('id', $adminRole->id);
        })->exists();

        if (!$adminExists) {
            $user = User::create($validatedData);
            $user->roles()->attach($adminRole);
        } else {
            $user = User::create($validatedData);
        }

        if (!Auth::check()) {
            Auth::login($user);
        }

        return redirect()->route('users.show', $user)->with('success', 'Le compte utilisateur a bien été créé.');
    }

    public function edite(User $user): View
    {
        return view('users.edite', compact("user"));
    }

    public function update(User $user, UserFormRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        if (isset($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        } else {
            unset($validatedData['password']);
        }

        $user->update($validatedData);
        return redirect()->route('users.show', $user)->with('success', 'Le compte utilisateur a bien été mis à jour.');
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Le compte utilisateur a bien été supprimé');
    }
}
