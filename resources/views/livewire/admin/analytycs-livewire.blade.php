<div>
    <div class="card mb-3">
        <div class="card-body">
            <select wire:model="days" class="form-select form-select-solid" aria-label="data-analytics">
                <option value="1">Kemarin</option>
                <option value="7">1 minggu terakhir</option>
                <option value="30">1 bulan terakhir</option>
                <option value="60">3 bulan terakhir</option>
                <option value="90">6 bulan terakhir</option>
                <option value="365">1 tahun terakhir</option>
            </select>

        </div>
    </div>
    <div class="card text-center mb-3" wire:loading.delay>
        <div class="card-body">
            <span>Loading data...</span>
        </div>
    </div>

    <div wire:loading.remove>
        <div class="card mb-3">
            <div class="card-header">
                <div class="card-title">
                    <h2 class="card-label">
                        Visitors and Page Views
                    </h2>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th style="width: 5%">No.</th>
                                <th style="width: 65%">Page</th>
                                <th style="width: 15%">Active Users</th>
                                <th style="width: 15%">Page views</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($visitorsAndPageViews as $key => $data)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $data['pageTitle'] }}</td>
                                <td>{{ number_format($data['activeUsers'], 0, ',', '.') }}</td>
                                <td>{{ number_format($data['screenPageViews'], 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-header">
                <div class="card-title">
                    <h2 class="card-label">
                        Total Visitors and Pageviews
                    </h2>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th style="width: 5%">No.</th>
                                <th style="width: 65%">Date</th>
                                <th style="width: 15%">Active Users</th>
                                <th style="width: 15%">Page views</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($totalVisitorsAndPageViews as $key => $data)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $data['date'] }}</td>
                                <td>{{ number_format($data['activeUsers'], 0, ',', '.') }}</td>
                                <td>{{ number_format($data['screenPageViews'], 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-header">
                <div class="card-title">
                    <h2 class="card-label">
                        Most Visited Pages
                    </h2>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th style="width: 5%">No.</th>
                                <th style="width: 45%">Page</th>
                                <th style="width: 35%">URL</th>
                                <th style="width: 15%">Page views</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($mostVisitedPages as $key => $data)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $data['pageTitle'] }}</td>
                                <td>{{ $data['fullPageUrl'] }}</td>
                                <td>{{ number_format($data['screenPageViews'], 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-header">
                <div class="card-title">
                    <h2 class="card-label">
                        Top Referrers
                    </h2>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th style="width: 5%">No.</th>
                                <th style="width: 65%">Page Referrer</th>
                                <th style="width: 30%">Page views</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($topReferrers as $key => $data)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $data['pageReferrer'] }}</td>
                                <td>{{ number_format($data['screenPageViews'], 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-header">
                <div class="card-title">
                    <h2 class="card-label">
                        User Types
                    </h2>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th style="width: 5%">No.</th>
                                <th style="width: 65%">Type</th>
                                <th style="width: 30%">Active Users</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($userTypes as $key => $data)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $data['newVsReturning'] }}</td>
                                <td>{{ number_format($data['activeUsers'], 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-header">
                <div class="card-title">
                    <h2 class="card-label">
                        Top Browsers
                    </h2>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th style="width: 5%">No.</th>
                                <th style="width: 65%">Browser</th>
                                <th style="width: 30%">Page Views</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($topBrowsers as $key => $data)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $data['browser'] }}</td>
                                <td>{{ number_format($data['screenPageViews'], 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
