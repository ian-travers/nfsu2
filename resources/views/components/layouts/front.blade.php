<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>@isset($title) {{ $title }} -@endisset {{ config('app.name', 'NFSU Cup') }}</title>
<link rel="stylesheet" href="{{ mix('css/app.css', 'build') }}">
<body class="antialiased min-h-screen flex flex-col">
<header class="bg-nfsu-color border-b border-gray-600">
    <x-top-nav></x-top-nav>
</header>
<main class="flex-grow bg-nfsu-map bg-no-repeat bg-cover bg-fixed text-blue-300">
    {{ $slot }}
</main>
<script src="{{ mix('js/app.js', 'build') }}"></script>
</body>
</html>
