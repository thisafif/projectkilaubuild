<x-layouts.app :title="__('Artikel')">
    <div style="min-height: 100vh; padding: 40px 20px; font-family: 'Poppins', sans-serif;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <!-- Judul & Search -->
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px; margin-bottom: 30px;">
            <h1 style="font-size: 2rem; font-weight: 700; color: #000;">Artikel</h1>
            <div style="display: flex; align-items: center; background: white; border-radius: 25px; padding: 8px 15px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); width: 250px;">
                <input type="text" placeholder="Search" style="border: none; outline: none; flex: 1; font-size: 14px; background: none;">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#000" style="width: 18px; height: 18px;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.5 4.5a7.5 7.5 0 0012.15 12.15z" />
                </svg>
            </div>
        </div>

        <!-- Grid Artikel -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(270px, 1fr)); gap: 30px;">
            @for ($i = 0; $i < 4; $i++)
                <div style="background: #f5faffff; border-radius: 15px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); padding: 20px; transition: transform 0.3s ease;">
                    <img src="https://images.unsplash.com/photo-1501594907352-04cda38ebc29?auto=format&fit=crop&w=800&q=60" alt="Artikel" style="width: 100%; border-radius: 15px; margin-bottom: 15px;">
                    <h2 style="font-size: 1.25rem; font-weight: 700; margin-bottom: 10px;">Lorem Ipsum</h2>
                    <p style="font-size: 0.95rem; color: #333; margin-bottom: 20px;">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    </p>
                    <button style="background-color: #2B78E4; color: white; border: none; border-radius: 25px; padding: 8px 20px; font-size: 0.9rem; font-weight: 500; cursor: pointer; transition: all 0.3s ease;"
                        onmouseover="this.style.backgroundColor='#1D5FBF';"
                        onmouseout="this.style.backgroundColor='#2B78E4';">
                        See more...
                    </button>
                </div>
            @endfor
        </div>
    </div>
</div>

</x-layouts.app>
