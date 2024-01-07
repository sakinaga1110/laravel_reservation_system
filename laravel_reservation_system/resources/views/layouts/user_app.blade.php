<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/vue@3.4.0/dist/vue.global.min.js"></script>
    <title>@yield('title')</title>
    <script src="https://cdn.jsdelivr.net/npm/vue@3.4.0/dist/vue.global.min.js"></script>
</head>

<body>
    <x-header>
    </x-header>
    <main>
        @yield('content')
    </main>
    <x-footer>
    </x-footer>
</body>

</html>
