<!doctype html>
<html>
    <head>
        <title>Paranormality</title>
        <link href="{{asset('css/style.css')}}" rel="stylesheet">
        <link rel="icon" type="image/png" href="{{asset('images/icon.ico')}}">
    </head>
    <body>

        <header>
            <h1>Paranormality</h1>
        </header>
        <nav>
            <a href="{{route('index')}}">Home</a>
            <a href="#">FAQ</a>
            <a href="#">About</a>
            <a href="#">Contact</a>
        </nav>
        <main>
                @yield('content')
            <profile>

                <profilePicture></profilePicture>
                <actions><a>Make post</a>|<a>Account</a>|<a>Log out</a></actions>

            </profile>

            <top>

            </top>
        </main>
    </body>
</html>