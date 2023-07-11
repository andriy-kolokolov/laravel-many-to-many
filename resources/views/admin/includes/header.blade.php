@php $user = Auth::user(); @endphp

<header class="shadow mb-4">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
{{--            <a class="navbar-brand fw-bold" href="{{ route('guests.home') }}">BOOLPRESS</a>--}}

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    <!--    POSTS    -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Posts
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('admin.posts.index') }}">Show Posts</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.posts.create') }}">Add</a></li>
                        </ul>
                    </li>
                    <!--    PROJECTS    -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Projects
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('admin.projects.index') }}">Show Projects</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.projects.create') }}">Add</a></li>
                        </ul>
                    </li>

                </ul>

                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ $user->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end text-center">
                            <li>
                                <a class="dropdown-item w-100" href="{{ route('admin.profile.edit') }}">Edit profile</a>
                            </li>
                            <li>
                                <form class="dropdown-item" action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button class="btn btn-danger w-100">Log out</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
