<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/partials-admin/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages-admin/login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/partials-admin/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages-admin/manage_users.css') }}">
    <title>Document</title>
</head>
<body>
        @include('layouts.partials-admin.header')
        <div class="content-container-admin">
            <div class="row">
                @yield('content')
            </div>
        </div>
</body>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>