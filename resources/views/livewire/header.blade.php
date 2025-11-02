<nav x-data="{ open: false }"
    class="bg-sky-900 flex justify-between items-center
    px-6 py-4
    lg:px-10 lg:py-0
    lg:h-28
    sticky
    top-0
    z-50">
    <div class="flex justify-start items-center gap-3">
        <div class="w-10 h-10 lg:w-18 lg:h-18 relative">
            <img class="w-full h-full rounded-[50px] shadow-lg bg-white" 
            src="{{ asset('images/logo-kilau-build(300x300).png') }}" alt="Logo Kilau Build" />
        </div>
        <div class="justify-start text-white text-base lg:text-2xl font-semibold font-sans tracking-[3.36px]">Kilau<br/>Build</div>
    </div>
    <div class="hidden
                lg:flex lg:items-center lg:gap-12">
        <a href="{{ route('home') }}" 
        class="justify-start text-lg font-semibold font-mono 
        {{ request()->routeIs('home') ? 'text-white' : 'text-gray-400' }}">
        Beranda
        </a>
        <a href="{{ route('konsultasi') }}" 
        class="justify-start text-lg font-semibold font-mono 
        {{ request()->routeIs('home') ? 'text-white' : (request()->routeIs('konsultasi') ? 'text-white' : 'text-gray-400') }}">
        Konsultasi
        </a>
        <a href="{{ route('layanan') }}" 
        class="justify-start text-lg font-semibold font-mono 
        {{ request()->routeIs('home') ? 'text-white' : (request()->routeIs('layanan') ? 'text-white' : 'text-gray-400') }}">
        Layanan
        </a>
        <a href="{{ route('portofolio') }}" 
        class="justify-start text-lg font-semibold font-mono 
        {{ request()->routeIs('home') ? 'text-white' : (request()->routeIs('portofolio') ? 'text-white' : 'text-gray-400') }}">
        Portofolio
        </a>
        <a href="{{ route('artikel') }}" 
        class="justify-start text-lg font-semibold font-mono 
        {{ request()->routeIs('home') ? 'text-white' : (request()->routeIs('artikel') ? 'text-white' : 'text-gray-400') }}">
        Artikel
        </a>
        <a href="{{ route('proyek') }}" 
        class="justify-start text-lg font-semibold font-mono 
        {{ request()->routeIs('home') ? 'text-white' : (request()->routeIs('proyek') ? 'text-white' : 'text-gray-400') }}">
        Proyek
        </a>
        <a href="{{ route('tentang-kami') }}" 
        class="justify-start text-lg font-semibold font-mono 
        {{ request()->routeIs('home') ? 'text-white' : (request()->routeIs('tentang-kami') ? 'text-white' : 'text-gray-400') }}">
        Tentang Kami
        </a>
    </div>
    <button @click="open = !open" class="
        block                   
        lg:hidden">
        <svg x-show="!open" class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
        </svg>
        <div x-show="open">
            @include('flux.icon.x')
        </div>
    </button>
    <div x-show="open" 
         x-transition 
         @click.outside="open = false" 
         class="
            lg:hidden 
            absolute top-full left-0 w-full bg-sky-900 shadow-lg z-50
            flex flex-col p-4">

        <a href="{{ route('home') }}" 
        class="block p-4 text-lg font-semibold font-mono text-right 
        {{ request()->routeIs('home') ? 'text-white' : 'text-gray-400' }}">
        Beranda
        </a>
        <a href="{{ route('konsultasi') }}" 
        class="block p-4 text-lg font-semibold font-mono text-right {{ request()->routeIs('konsultasi') ? 'text-white' : 'text-gray-400' }}">
        Konsultasi
        </a>
        <a href="{{ route('layanan') }}" 
        class="block p-4 text-lg font-semibold font-mono text-right {{ request()->routeIs('layanan') ? 'text-white' : 'text-gray-400' }}">
        Layanan
        </a>
        <a href="{{ route('portofolio') }}" 
        class="block p-4 text-lg font-semibold font-mono text-right {{ request()->routeIs('portofolio') ? 'text-white' : 'text-gray-400' }}">
        Portofolio
        </a>
        <a href="{{ route('artikel') }}" 
        class="block p-4 text-lg font-semibold font-mono text-right {{ request()->routeIs('artikel') ? 'text-white' : 'text-gray-400' }}">
        Artikel
        </a>
        <a href="{{ route('proyek') }}" 
        class="block p-4 text-lg font-semibold font-mono text-right {{ request()->routeIs('proyek') ? 'text-white' : 'text-gray-400' }}">
        Proyek
        </a>
        <a href="{{ route('tentang-kami') }}" 
        class="block p-4 text-lg font-semibold font-mono text-right {{ request()->routeIs('tentang-kami') ? 'text-white' : 'text-gray-400' }}">
        Tentang Kami
        </a>
    </div>
</nav>
