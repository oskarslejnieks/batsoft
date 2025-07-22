<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet"
        crossorigin="anonymous"
    />

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"
    ></script>
</head>
<body class="d-flex flex-column min-vh-100">

<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ route('task.index') }}">Batsoft Task app</a>

        <a href="{{ route('api.tasks') }}">Task data in .json format</a>

        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item">
                        <form
                            id="logout-form"
                            action="{{ route('logout') }}"
                            method="POST"
                            class="mr-4 d-inline"
                        >
                            @csrf

                            <button
                                type="submit"
                                class="btn btn-link nav-link d-inline me-4"
                            >
                                Logout
                            </button>
                        </form>

                        <a class="btn btn-outline-danger me-2" href="{{ route('task.create') }}">
                            New task
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Log in</a>
                    </li>

                        <li class="nav-item">
                            <a class="btn btn-primary ms-2" href="{{ route('register') }}">
                                Register
                            </a>
                        </li>

                @endauth
            </ul>
        </div>
    </div>
</nav>

<main class="container flex-grow-1 py-4">
    @yield('content')
</main>

<footer class="bg-light text-center py-3 mt-auto border-top">
    <small class="text-muted">
        Footer
    </small>
</footer>

</body>
</html>
