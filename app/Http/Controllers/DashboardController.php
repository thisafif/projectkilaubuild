<?php

namespace App\Http\Controllers;

use App\Models\Ongoing;
use App\Models\Question;
use App\Models\Testimoni;
use App\Models\Portofolio;
use App\Models\Artikel;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index()
    {
        $testimonis = Testimoni::all();
        $portofolios = Portofolio::latest()->take(5)->get();
        $artikels = Artikel::latest()->take(3)->get();
        $faqs = Question::all();
        $ongoingCount = Ongoing::whereIn('status', ['consultation', 'planning', 'in_progress'])->count();
        $completedCount = Ongoing::where('status', 'done')->count();

        $points = collect();
        try {
            $points = Ongoing::whereNotNull('location')
                ->select('id', 'client_name', 'status', 'progress_percentage', 'location')
                ->get()
                ->filter(function ($project) {
                    return is_array($project->location) && ! empty($project->location);
                })
                ->map(function ($project) {
                    $location = $project->location;

                    return [
                        'id' => $project->id,
                        'name' => $project->client_name,
                        'status' => $project->status,
                        'progress' => $project->progress_percentage,
                        'lat' => floatval($location['lat'] ?? -6.2088),
                        'lng' => floatval($location['lng'] ?? 106.8456),
                        'address' => $location['formatted_address'] ?? 'Lokasi tidak tersedia',
                    ];
                });
        } catch (\Exception $e) {
            Log::error('Error loading ongoing projects for map: '.$e->getMessage());
        }

        return view('dashboard', compact('testimonis', 'faqs', 'ongoingCount', 'completedCount', 'points', 'artikels', 'portofolios'));
    }
}
