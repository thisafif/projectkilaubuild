<!DOCTYPE html>
<html lang="en" class="overflow-x-hidden">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Judul Default' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex flex-col">
    <div class="fixed inset-0 w-full h-screen bg-blue-300/80 blur-[750px] -z-10 scale-125"></div>

    <livewire:header />

    <main class="flex-1 relative z-0  overflow-x-hidden">
        {{ $slot }}
    </main>

    <livewire:footer />

    <script>
        document.addEventListener('livewire:init', function () {
            Livewire.on('buka-wa', (data) => {
                if (data.url) {
                    window.location.href = data.url;
                }
            });
        });
    </script>
</body>
</html>