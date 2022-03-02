<html>
    <head> 
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <script src="{{ mix('js/app.js') }}" defer></script>
        <title>Laravel App - @yield('title')</title>
    </head>
    <body>
        <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 bg-white border-bottom shadow-sm mb-3">
            <h5 class="my-0 me-md-auto fw-bold">Laravel App</h5>
            <nav class="my-2 my-md-0 me-md-3">
                <a href="{{ route('home.index') }}" class="p-2 text-dark fw-bold">Home</a>
                <a href="{{ route('home.contact') }}" class="p-2 text-dark fw-bold">Contact</a>
                <a href="{{ route('posts.index') }}" class="p-2 text-dark fw-bold">Blog Post</a>
                <a href="{{ route('posts.create') }}" class="p-2 text-dark fw-bold">Add Blog Post</a>
            </nav>
        </div>
        <div class="container">
            @if(session('status'))
                <div class="alrtt alert-success">
                    {{ session('status') }}
                </div>
            @endif
            @yield('content')
        </div>
    </body>
</html>