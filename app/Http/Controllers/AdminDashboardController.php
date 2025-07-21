<?php

namespace App\Http\Controllers;

use App\Models\Audio;
use App\Models\Collection;
use App\Models\TextRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Admin - Dashboard';

        $textCollectionsCount = Collection::count();
        $audioCollectionsCount = Audio::count();
        $pendingRequestsCount = TextRequest::where('status', 'Belum Dikirim')->count();

        $range = $request->get('range', 7); 
        $startDate = null;

        if ($range === 'all') {
            $startDate = Audio::min('created_at') ?? now(); 
        } elseif (is_numeric($range)) {
            $startDate = now()->subDays((int)$range - 1)->startOfDay();
        }

        $rawConversionData = Audio::selectRaw('DATE(created_at) as date, COUNT(*) as total')
            ->when($startDate, fn($q) => $q->where('created_at', '>=', $startDate))
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('total', 'date');

        $conversionData = collect();
        if ($range === 'all') {
            $start = Carbon::parse($startDate)->startOfDay();
            $end = now()->startOfDay();
            for ($date = $start; $date->lte($end); $date->addDay()) {
                $conversionData->push((object)[
                    'date' => $date->toDateString(),
                    'total' => $rawConversionData[$date->toDateString()] ?? 0,
                ]);
            }
        } else {
            for ($i = (int)$range - 1; $i >= 0; $i--) {
                $date = now()->subDays($i)->toDateString();
                $conversionData->push((object)[
                    'date' => $date,
                    'total' => $rawConversionData[$date] ?? 0,
                ]);
            }
        }

        return view('admin.index', compact(
            'title',
            'textCollectionsCount',
            'audioCollectionsCount',
            'pendingRequestsCount',
            'conversionData'
        ));
    }


    public function guideAdmin(Request $request)
    {
        $title = 'Admin - Panduan Admin';
        return view('admin.guide', compact('title'));
    }

    public function profile()
    {
        $title = 'Admin - Profile';
        return view('admin.profile', compact('title'));
    }

}
