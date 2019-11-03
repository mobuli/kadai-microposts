<header class="mb-4">
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <a class="navbar-brand" href="{{ route('users.index') }}">Microposts</a>

        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="nav-bar">
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav">
                @if (Auth::check())
                    <li class="nav-item"><a href="{{ route('users.index') }}" class="nav-link">Users</a></li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name }}</a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li class="dropdown-item"><a href="{{ route('users.show', ['id' => Auth::id()]) }}">My profile</a></li>
                            <li class="dropdown-divider"></li>
                            <li class="dropdown-item"><a href="{{ route('logout.get') }}">Logout</a></li>
                        </ul>
                    </li>
                @else
                    <li><a href="{{ route('signup.get') }}" class="nav-link">Signup</a></li>
                    <li><a href="{{ route('login') }}" class="nav-link">Login</a></li>
                @endif
            </ul>
        </div>
    </nav>
</header>

