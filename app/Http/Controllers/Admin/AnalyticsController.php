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

    public function getTopPages()
    {
        $period = Period::days(28); // atau gunakan dynamic range jika diperlukan

        $pages = Analytics::fetchMostVisitedPages($period)->take(6);

        $labels = $pages->pluck('fullPageUrl');
        $titles = $pages->pluck('pageTitle');
        $views = $pages->pluck('screenPageViews');

        return response()->json([
            'labels' => $labels,
            'titles' => $titles,
            'views' => $views,
        ]);
    }

    public function getVisitorsByCountry()
    {
        $period = Period::days(28); // atau sesuaikan

        $data = Analytics::get(
            $period,
            ['activeUsers'], // Atau ['newUsers'], tergantung metrik yang diinginkan
            ['region', 'city']
        );
        $region = $data->pluck('region');
        $city = $data->pluck('city');
        $total = $data->pluck('activeUsers');

        return response()->json([
            'region' => $region,
            'city' => $city,
            'total' => $total
        ]);
    }

    public function getBrowserAndDevice()
    {
        $period = Period::days(28);

        $browsers = Analytics::fetchTopBrowsers($period);

        $devicesRaw = Analytics::get($period, ['activeUsers'], ['deviceCategory']);
        $devices = $devicesRaw->map(fn($item) => [
            'device' => $item['deviceCategory'],
            'users' => (int) $item['activeUsers'],
        ]);

        $totalBrowser = collect($browsers)->sum('screenPageViews');
        $totalDevice = $devices->sum('users');

        return response()->json([
            'browsers' => $browsers,
            'devices' => $devices,
            'total_browser' => $totalBrowser,
            'total_device' => $totalDevice,
        ]);
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
