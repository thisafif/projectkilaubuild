<!DOCTYPE html>
<html lang="en" class="overflow-x-hidden scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/logo-kilau-build(80x80).png') }}" type="image/png">

    <title>{{ $title ?? 'Judul Default' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="min-h-screen flex flex-col antialiased overflow-x-hidden">
    <div class="fixed inset-0 w-full h-screen bg-blue-300/80 blur-[750px] -z-10 scale-125 pointer-events-none"></div>
    <div class="relative w-full overflow-x-hidden">
        <livewire:header />

        <main class="flex-1 relative z-0  overflow-x-hidden">
            {{ $slot }}
        </main>

        <livewire:footer />
    </div>
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
<div x-data="{ showButton: false }" x-cloak
     @scroll.window="showButton = (window.pageYOffset > 300) ? true : false"
     class="fixed bottom-8 right-8 z-50">

    <button @click="window.scrollTo({top: 0, behavior: 'smooth'})"
            x-show="showButton"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-10"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 scale-50"
            class="bg-blue-800 hover:bg-blue-950 text-white p-3 rounded-full shadow-lg hover:shadow-xl transition duration-300 group">
        
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" 
             class="w-6 h-6 group-hover:-translate-y-1 transition-transform duration-300">
          <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
        </svg>

    </button>

</div>
</html>