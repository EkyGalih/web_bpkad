<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Spatie\Analytics\Facades\Analytics;
use Spatie\Analytics\Period;
use Carbon\Carbon;

class AnalyticsController extends Controller
{
    public function index()
    {
        return view('admin.analytics.index');
    }

    public function getAnalyticsData($range)
    {
        switch ($range) {
            case '28days':
                $period = Period::days(28);
                break;
            case 'lastmonth':
                $start = Carbon::now()->subMonth()->startOfMonth();
                $end = Carbon::now()->subMonth()->endOfMonth();
                $period = Period::create($start, $end);
                break;
            case 'lastyear':
                $start = Carbon::now()->subYear()->startOfYear();
                $end = Carbon::now()->subYear()->endOfYear();
                $period = Period::create($start, $end);
                break;
            default:
                $period = Period::days(7);
                break;
        }

        $analyticsData = Analytics::get(
            $period,
            ['screenPageViews'],
            ['date']
        );

        $labels = $analyticsData->pluck('date')->map(fn($d) => $d->format('Y-m-d'));
        $views = $analyticsData->pluck('screenPageViews');
        $totalVisitors = $analyticsData->pluck('screenPageViews')->sum();
        $maxViews = $analyticsData->max('screenPageViews');
        $maxDay = $analyticsData->filter(function ($item) use ($maxViews) {
            return $item['screenPageViews'] === $maxViews;
        })->first();

        $mostVisitedDate = \Carbon\Carbon::parse($maxDay['date'])->locale('id')->isoFormat('dddd');

        return response()->json([
            'labels' => $labels,
            'views' => $views,
            'total' => $totalVisitors,
            'max' => [
                'value' => $maxViews,
                'day' => $mostVisitedDate,
            ]
        ]);
    }
}
