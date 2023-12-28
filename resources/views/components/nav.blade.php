<nav class="navbar navbar-expand-lg bg-dark border-bottom border-body sticky-top" data-bs-theme="dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link{{ (request()->routeIs('posts.index') || request()->routeIs('posts.show') || request()->routeIs('posts.create') || request()->routeIs('posts.edite')) ? ' active' : '' }}" href="{{ route('posts.index') }}">Articles</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                @auth
                    @if(auth()->user()->hasRole('admin'))
                        <li class="nav-item">
                            <a class="nav-link{{ (request()->routeIs('categories.index') || request()->routeIs('categories.show') || request()->routeIs('categories.create') || request()->routeIs('categories.edite')) ? ' active' : '' }}" href="{{ route('categories.index') }}">Catégories</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link{{ (request()->routeIs('tags.index') || request()->routeIs('tags.show') || request()->routeIs('tags.create') || request()->routeIs('tags.edite')) ? ' active' : '' }}" href="{{ route('tags.index') }}">Tags</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link{{ (request()->routeIs('users.index') || (request()->routeIs('users.show') && !($user->id == auth()->user()->getAuthIdentifier())) || (request()->routeIs('users.edite') && !($user->id == auth()->user()->getAuthIdentifier())) || request()->routeIs('users.create')) ? ' active' : '' }}" href="{{ route('users.index') }}">Utilisateurs</a>
                        </li>
                    @endif
                @endauth
                <li class="nav-item">
                    @auth
                        <a class="nav-link{{ ((request()->routeIs('users.show') && $user->id == auth()->user()->getAuthIdentifier()) || (request()->routeIs('users.edite') && $user->id == auth()->user()->getAuthIdentifier())) ? ' active' : '' }}" href="{{ route('users.show', auth()->user()) }}">Mon compte</a>
                    @endauth
                    @guest
                        <a class="nav-link{{ (request()->routeIs('users.create') || request()->routeIs('auth.login')) ? ' active' : '' }}" href="{{ route('auth.login') }}">Connexion</a>
                    @endguest
                </li>
            </ul>
        </div>
    </div>
</nav>
