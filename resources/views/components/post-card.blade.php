<div class="col-12 col-md-4 mb-2" onclick="window.location='{{ route('posts.show', $post) }}';" style="cursor: pointer;">
    <div class="card product-card">
        <div class="card-body">
            <h5 class="card-title text-center">{{ $post->title }}</h5>
            <p class="card-subtitle text-body-secondary">
                @if(!request()->routeIs('users.show'))
                <a href="{{ route('users.show', $post->user) }}" class="card-link">{{ $post->user->name }}</a> -
                @endif
                {{ $post->created_at->format('d/m/Y') }}
            </p>
            <p class="card-text">Catégorie : <b>{{ $post->category->name }}</b></p>
            <p class="card-text">{{ \Illuminate\Support\Str::limit(strip_tags($post->content), 100, $end='...') }}</p>
        </div>
        <div class="card-footer">
            <strong>Tags :</strong>
            @foreach ($post->tags->take(3) as $tag)
                <span class="badge text-bg-secondary">{{ $tag->name }}</span>
            @endforeach
            @if ($post->tags->count() > 3)
                <span class="badge text-bg-secondary">...</span>
            @endif
        </div>
    </div>
</div>
