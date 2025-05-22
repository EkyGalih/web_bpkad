<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Analytics;
use Spatie\Analytics\Period;

class AnalytycsLivewire extends Component
{
    public $days = 1;

    public function updateDays($value)
    {
        $this->days = $value;
    }

    public function render()
    {
        $period = Period::days($this->days);

        $visitorsAndPageViews = Analytics::fetchVisitorsAndPageViews($period);
        $totalVisitorsAndPageViews = Analytics::fetchTotalVisitorsAndPageViews($period);
        $mostVisitedPages = Analytics::fetchMostVisitedPages($period);
        $topReferrers = Analytics::fetchTopReferrers($period);
        $userTypes = Analytics::fetchUserTypes($period);
        $topBrowsers = Analytics::fetchTopBrowsers($period);

        return view('livewire.admin.analytycs-livewire', compact('visitorsAndPageViews', 'totalVisitorsAndPageViews', 'mostVisitedPages', 'topReferrers', 'userTypes', 'topBrowsers'));
    }
}
