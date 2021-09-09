<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>@isset($title) {{ $title }} -@endisset {{ config('app.name', 'NFSU Cup') }}</title>
<link rel="stylesheet" href="{{ mix('css/app.css', 'build') }}">
@livewireStyles
<body class="antialiased min-h-screen flex flex-col">

<x-layouts._header/>

<main class="flex-grow bg-nfsu-map bg-no-repeat bg-cover bg-fixed text-blue-300">
    @livewire('generic-alert')

    {{ $slot }}
</main>

<x-layouts._footer/>

<script>
    window._locale = '{{ app()->getLocale() }}';
    window._translations = {!! cache('translations') !!};
</script>
@livewireScripts
<script src="{{ mix('js/app.js', 'build') }}"></script>
@stack('scripts')
</body>
</html>
