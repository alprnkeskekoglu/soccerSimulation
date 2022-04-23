<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Insider</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

<div class="mb-1 d-flex align-items-center justify-content-around">
    <img src="{{ asset('img/insider.png') }}" alt="Insider">
    <div>
        <a href="{{ route('home') }}" class="btn btn-secondary">Home</a>
        <a href="{{ route('fixtures.index') }}" class="btn btn-secondary">Fixture</a>
        <a href="{{ route('simulations.index') }}" class="btn btn-secondary">Simulation</a>
    </div>
</div>
<div id="app">
    <div class="text-center" v-if="loading">
        <div class="spinner-border text-primary" role="status">
            <span class="sr-only"></span>
        </div>
    </div>
    @yield('content')
</div>

<script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>
