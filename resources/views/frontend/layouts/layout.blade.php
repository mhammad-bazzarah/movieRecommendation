<!DOCTYPE html>
<html lang="en">

<head>
    <title>Movies Website</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body>

    @include('frontend.layouts.navbar')
    @yield('content')

    <footer class="text-center py-3">
        <p>&copy; 2023 Movies Website. All rights reserved.</p>
    </footer>

    <script type="text/javascript" src="{{ asset('assets/js/script.js') }}"></script>
</body>
</html>
