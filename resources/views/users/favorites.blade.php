@extends('layouts.app')

@section('content')
    <div class="row">
        <aside class="col-sm-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $user->name }}</h3>
                </div>
                <div class="card-body">
                    <img class="rounded img-fluid" src="{{ Gravatar::src($user->email, 500) }}" alt="">
                </div>
            </div>
            @include('user_follow.follow_button', ['user' => $user])
        </aside>
        <div class="col-sm-8">
            <ul class="nav nav-tabs nav-justified mb-3">
                <li class="nav-item"><a href="{{ route('users.show', ['id' => $user->id]) }}" class="nav-link {{ Request::is('users/' . $user->id) ? 'active' : '' }}">TimeLine <span class="badge badge-secondary">{{ $count_microposts }}</span></a></li>
                <li class="nav-item"><a href="{{ route('users.followings', ['id' => $user->id]) }}" class="nav-link {{ Request::is('users/*/followings') ? 'active' : '' }}">Followings <span class="badge badge-secondary">{{ $count_followings }}</span></a></li>
                <li class="nav-item"><a href="{{ route('users.followers', ['id' => $user->id]) }}" class="nav-link {{ Request::is('users/*/followers') ? 'active' : '' }}">Followers <span class="badge badge-secondary">{{ $count_followers }}</span></a></li>
                <li class="nav-item"><a href="{{ route('users.favorites', ['id' => $user->id]) }}" class="nav-link {{ Request::is('users/*/favorites') ? 'active' : '' }}">Favorites <span class="badge badge-secondary">{{ $count_favorites }}</span></a></li>
            </ul>
            @if (count($microposts) > 0)
                <ul class="list-unstyled">
                    @foreach ($microposts as $micropost)
                        <li class="media">
                            <img class="mr-2 rounded" src="{{ Gravatar::src(array_get($micropost, 'favorite_users.0.email'), 50) }}" alt="">
                            <div class="media-body">
                         <div>
                             <a href="{{ route('users.show', ['id' => $micropost->id]) }}">{{ array_get($micropost, 'favorite_users.0.name') }}</a>
                             <span class="text-muted">posted at {{ $micropost->created_at }}</span>
                         </div>

                                <div>
                                    {{ array_get($micropost, 'favorite_users.0.name') }}
                                </div>
                                <div>
                                    <p class="mb-0">{!! nl2br(e($micropost->content)) !!}</p>
                                </div>
                                <div class="row">
                                    <div class="col-xs-3 mr-1">
                                    @if(Auth::user()->is_favorite($micropost->id))
                                        {!! Form::open(['route' => ['favorites.unfavorite', $micropost->id], 'method' => 'delete']) !!}
                                            {!! Form::submit('Favorite', ['class' => "btn btn-success"]) !!}
                                        {!! Form::close() !!}
                                    @else
                                        {!! Form::open(['route' => ['favorites.favorite', $micropost->id]]) !!}
                                            {!! Form::submit('Favorite', ['class' => "btn btn-secondary"]) !!}
                                        {!! Form::close() !!}
                                    @endif
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
                {{ $microposts->links('pagination::bootstrap-4') }}
            @endif
        </div>
    </div>
@endsection