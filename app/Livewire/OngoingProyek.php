<?php

namespace App\Livewire;

use App\Models\Ongoing;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class OngoingProyek extends Component
{
    public $tipeProyek = '';

    public $tahun = '';

    public $lokasi = '';

    public function getMapPoints()
    {
        return Ongoing::query()
            ->whereNotNull('location->lat')
            ->whereNotNull('location->lng')
            ->get(['id', 'client_name', 'location', 'status', 'progress_percentage'])
            ->map(fn ($item) => [
                'id' => $item->id,
                'name' => $item->client_name,
                'lat' => data_get($item->location, 'lat'),
                'lng' => data_get($item->location, 'lng'),
                'address' => data_get($item->location, 'formatted_address', ''),
                'status' => $item->status,
                'progress' => $item->progress_percentage,
            ])
            ->filter(fn ($p) => $p['lat'] && $p['lng'])
            ->values();
    }

    public function render()
    {
        $query = Ongoing::query();

        if ($this->lokasi) {
            $query->whereJsonContains('location->formatted_address', $this->lokasi);
        }

        if ($this->tahun) {
            $query->whereYear('start_date', $this->tahun);
        }

        $ongoingproyek = $query->latest('start_date')->get(['id', 'client_name', 'status', 'progress_percentage', 'location', 'description', 'images']);

        $daftarProvinsi = DB::table('indonesia_provinces')
            ->orderBy('name', 'asc')
            ->get();

        return view('livewire.ongoing-proyek', [
            'ongoingproyeks' => $ongoingproyek,
            'daftarProvinsi' => $daftarProvinsi,
            'mapPoints' => $this->getMapPoints(),
        ]);
    }
}
