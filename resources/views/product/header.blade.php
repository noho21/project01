<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-5">
            <div class="container-fluid">
                <a class="navbar-brand ps-3" href="{{ route('dashboard') }}">Step7</a>
                <!-- drop down -->
                <div class="collapse navbar-collapse d-flex flex-row-reverse  pe-3" id="navbarNavDarkDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown me-3" >
                            <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-dark">
                                <li>
                                    <x-dropdown-link :href="route('profile.edit')" class="dropdown-item">
                                        {{ __('Profile') }}
                                    </x-dropdown-link>
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <x-dropdown-link :href="route('logout')"
                                                onclick="event.preventDefault();
                                                            this.closest('form').submit();" class="dropdown-item">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </head>
    <body>
        @yield('content')

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    </body>
</html>