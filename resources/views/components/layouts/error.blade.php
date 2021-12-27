<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>@isset($title) {{ $title }} -@endisset {{ config('app.name', 'NFSU Cup') }}</title>
<link rel="stylesheet" href="{{ mix('css/app.css', 'build') }}">
<style>
    .bg-error {
        background: url("{{ asset("storage/images/mystery-man.jpg") }}");
        background-size: cover;
        background-attachment: fixed;
    }
</style>
@livewireStyles
<body class="antialiased bg-error">
<main>
    <div class="flex flex-col min-h-screen">
        <div class="lg:grid lg:grid-cols-3 px-8 py-16">
            <div class="lg:col-span-2"></div>
            {{ $slot }}
        </div>
        <div class="flex-1"></div>
        <x-layouts._footer/>
    </div>
</main>

@livewireScripts
<script src="{{ mix('js/app.js', 'build') }}"></script>
</body>
</html>
