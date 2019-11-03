<ul class="media-list">
    @foreach ($microposts as $micropost)
        <li class="media mb-3">
            <img class="mr-2 rounded" src="{{ Gravatar::src($micropost->user->email, 50) }}" alt="">
            <div class="media-body">
                <div>
                    <a href="{{ route('users.show', ['id' => $micropost->user->id]) }}">{{ $micropost->user->name }}</a><span class="text-muted">posted at {{ $micropost->created_at }}</span>
                </div>
                <div>
                    <p class="mb-0">{!! nl2br(e($micropost->content)) !!}</p>
                </div>
                <div>
                    @if (Auth::id() == $micropost->user_id)
                    <form method="POST" action="{{ route('microposts.destroy', [$micropost->id]) }}">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <div class="form-group">
                            <input class="btn btn-danger btn-sm" type="submit" value="Delete">
                        </div>
                    </form>
                    @endif
                </div>
            </div>
        </li>
    @endforeach
</ul>
{{ $microposts->links('pagination::bootstrap-4') }}