<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Laravel App - @yield('title')</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}" />
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body class="d-flex flex-column min-vh-100">
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path
                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
        </symbol>
        <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
            <path
                d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
        </symbol>
        <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path
                d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
        </symbol>
    </svg>

    <header
        class="vw-100 d-flex flex-column flex-md-row align-items-center p-3 px-md-4 bg-white border-bottom shadow-sm mb-3">
        <div class="my-0 me-md-auto pr-md-5">
            {{-- <h5 class="my-0 mr-md-auto mr-auto font-weight-normal mb-3">Laravel App - @yield('header')</h5> --}}
            <h5 class="font-weight-normal my-0">
                <a class="text-black" href="{{ route('home.index') }} " style="text-decoration:none">Laravel App -
                    @yield('header')</a>
            </h5>
        </div>
        <div class="my-3">
            <nav class="">
                <a class="p-2 text-dark" href="{{ route('home.index') }}">Home</a>
                <a class="p-2 text-dark" href="{{ route('home.contact') }}">Contact</a>
                <a class="p-2 text-dark" href="{{ route('posts.index') }}">All Posts</a>
                @guest
                    <a class="p-2 text-dark" href="{{ route('register') }}">Register</a>
                    <a class="p-2 text-dark" href="{{ route('login') }}">Login</a>
                @else
                    <a class="p-2 text-dark" href="{{ route('posts.create') }}">Create Post</a>
                    <a class="p-2 text-dark" href="{{ route('logout') }}"
                        onclick="event.preventDefault();document.getElementById('logout_form').submit();">
                        Logout: ({{ Auth::user()->name }})</a>

                    <form action="{{ route('logout') }}" id="logout_form" style="display: none;" method="POST">
                        @csrf
                    </form>
                @endguest
            </nav>
        </div>
    </header>

    <main class="container">
        @if (session('Status-success'))
            <div class="d-flex flex-row alert alert-success alert-dismissible fade show" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                    <use xlink:href="#check-circle-fill" />
                </svg>
                <div>
                    {{ session('Status-success') }}
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                {{-- <span aria-hidden="true">&times;</span> --}}
            </div>
        @endif
        @if (session('Status-danger'))
            <div class="d-flex flex-row alert alert-danger alert-dismissible fade show" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                    <use xlink:href="#exclamation-triangle-fill" />
                </svg>
                <div>
                    {{ session('Status-danger') }}
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                {{-- <span aria-hidden="true">&times;</span> --}}
            </div>
        @endif
        <section>
            @yield('content')
        </section>
    </main>
    @yield('footer')
</body>

</html>
