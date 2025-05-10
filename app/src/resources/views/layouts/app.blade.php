<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>@yield('title', 'Test App')</title>
</head>
<body>
<main>

<div class="outer">
    <div class="wrapper">
        <ul id="errors-bag" class="alert-error no-bullets">
            @if ($errors->any())
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            @endif
        </ul>
    </div>
</div>

    @yield('content')
</main>
@stack('scripts')
</body>
</html>
