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
            <a href="#">test</a>
            <a href="#">test</a>
            <a href="#">test</a>
            <a href="#">test</a>
            <a href="#">test</a>
            <a href="#">test</a>
        </nav>
        <main>
                @yield('content')
            <profile>

                <profilePicture></profilePicture>
                <actions><a>Make post</a>|<a>Account</a>|<a>Log out</a></actions>

            </profile>
        </main>
    </body>
</html>