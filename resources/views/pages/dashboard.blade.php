@extends('pages.home')

@section('content')
<div class="dashboard">
    <div class="dashboard-header">
        <h1 class="header-title">Dashboard</h1>
        <div class="header-update">
            <span>Updated just now</span>
            <button class="refresh-btn" id="refresh-btn" onclick="window.location.reload()">Click to refresh</button>
        </div>
    </div>

    <!-- Main Metrics -->
    <div class="row dashboard-row">
        <div class="metrics-grid">
            <div class="metric-card">
                <img src="{{ url('tu.png') }}" alt="">
                <div class="metric-title">Total Signup Accounts</div>
                <div class="metric-value">{{ number_format($counts['users']) }}</div>
            </div>
            <div class="metric-card">
                <img src="{{ url('tl.png') }}" alt="">
                <div class="metric-title">Total Likes</div>
                <div class="metric-value">{{ number_format($engagement['recipe_likes'] + $engagement['blog_likes'] + $engagement['restaurant_likes']) }}</div>
            </div>
            <div class="metric-card">
                <img src="{{ url('tc.png') }}" alt="">
                <div class="metric-title">Total Comments</div>
                <div class="metric-value">{{ number_format($engagement['recipe_comments'] + $engagement['blog_comments'] + $engagement['restaurant_comments']) }}</div>
            </div>
            <div class="metric-card">
                <img src="{{ url('tv.png') }}" alt="">
                <div class="metric-title">Total Engagement</div>
                <div class="metric-value">{{ number_format($totalEngagement) }}</div>
            </div>
        </div>
        <div class="dashboard-recent-blog-cards">
            {{-- @foreach ($latestBlogs as $blog)
                <div class="dashboard-recent-blog-card">
                    <div class="dashboard-recent-blog-card-img">
                        <img src="{{ $blog->images->first() ? asset('storage/' . $blog->images->first()->path) : asset('images/default-blog.jpg') }}" alt="{{ $blog->name }}">
                    </div>
                    <div class="dashboard-recent-blog-card-info">
                       <div class="title">{{ $blog->name }}</div>
                        <div class="desc"> {!!  Str::limit($blog->desc, 100) !!}</div>
                    </div>
                </div>
            @endforeach --}}
       </div>
    </div>
    <div class="metrics-grid-6">
        <div class="metric-card-6">
             <img src="{{ url('rp.png') }}" alt="">
            <div class="metric-title">Total Recipe Views</div>
            <div class="metric-value">{{ number_format($engagement['recipe_views']) }}</div>
        </div>
        <div class="metric-card-6">
             <img src="{{ url('bg.png') }}" alt="">
            <div class="metric-title">Total Blog Views</div>
            <div class="metric-value">{{ number_format($engagement['blog_views']) }}</div>
        </div>
        <div class="metric-card-6">
             <img src="{{ url('rt.png') }}" alt="">
            <div class="metric-title">Total Restaurant Views</div>
            <div class="metric-value">{{ number_format($engagement['restaurant_views']) }}</div>
        </div>
        <div class="metric-card-6">
            <img src="{{ url('cm.png') }}" alt="">
            <div class="metric-title">Photo Downloads</div>
            <div class="metric-value">{{ number_format($downloads['photo_downloads']) }}</div>
        </div>
        <div class="metric-card-6">
            <img src="{{ url('vd.png') }}" alt="">
            <div class="metric-title">Video Downloads</div>
            <div class="metric-value">{{ number_format($downloads['video_downloads']) }}</div>
        </div>
    </div>
    

    <!-- Content Summary -->
    <div class="content-section">
        <div class="contributors">
            <h2 class="section-title">Admin Team</h2>
            <table class="contributor-table">
                <thead>
                    <tr>
                        <th>Sn.</th>
                        <th>Admin Name</th>
                        <th>Email Address</th>
                        <th>Role</th>
                        <th>Action:</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($admins as $admin)
                    <tr>
                        <td>{{  $loop->iteration }}</td>
                        <td>{{ $admin->name }}</td>
                        <td>{{ $admin->email }}</td>
                        <td>{{ ucfirst(str_replace('_', ' ', $admin->role)) }}</td>
                        <td style="display: flex; align-itmes:center; gap: .5rem;">
                            @if (auth()->user()->isAdmin())
                                    <a href="{{ route('users.reset-password',$admin->id) }}" class="btn btn-outline-danger" style="background: #dddddd49;"><img
                                    src="{{ url('reset-password (1).png') }}" alt=""></a>
                                @endif
                                @if (auth()->user()->role === 'super_admin' && auth()->id() !== $admin->id)
                                    <form action="{{ route('users.destroy',$admin->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger"
                                            onclick="return confirm('Are you sure you want to delete this blog?')"><img
                                                src="{{ url('delete (1).png') }}" alt=""></button>
                                    </form>
                                @endif
                            </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="content-stats">
            <h2 class="section-title">Content Summary : Total</h2>
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-value">{{ number_format($counts['recipes']) }}</div>
                    <div class="stat-label">Recipes</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">{{ number_format($counts['blogs']) }}</div>
                    <div class="stat-label">Blogs</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">{{ number_format($counts['gallery_items']) }}</div>
                    <div class="stat-label">Photos</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">{{ number_format($counts['videos']) }}</div>
                    <div class="stat-label">Videos</div>
                </div>
            </div>
        </div>
    </div>
        <div class="engagement-chart">
            <h2 class="section-title">User Engagement by Type</h2>
            <canvas id="engagementChart" ></canvas>
        </div>
    {{-- <div class="demographics">
        <h2 class="section-title">Audience Demographics</h2>
        <div class="demographics-grid">
            <div>
                <h3>Age Distribution</h3>
                <canvas id="ageChart" ></canvas>
            </div>
            <div>
                <h3>Gender Distribution</h3>
                <canvas id="genderChart" ></canvas>
            </div>
        </div>
    </div> --}}
    <!-- Bottom Section -->
</div>

<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Engagement Chart
    const engagementCtx = document.getElementById('engagementChart').getContext('2d');
    const engagementChart = new Chart(engagementCtx, {
        type: 'bar',
        data: {
            labels: ['Recipes', 'Blogs', 'Restaurants'],
            datasets: [{
                label: 'Views',
                data: [
                    {{ $engagement['recipe_views'] }},
                    {{ $engagement['blog_views'] }},
                    {{ $engagement['restaurant_views'] }}
                ],
                backgroundColor: 'rgba(54, 162, 235, 0.7)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            },
            {
                label: 'Downloads',
                data: [
                    0, // Recipe downloads if you implement them
                    0, // Blog downloads if you implement them
                    0, // Restaurant downloads if you implement them
                    {{ $downloads['photo_downloads'] }},
                    {{ $downloads['video_downloads'] }}
                ],
                backgroundColor: 'rgba(75, 192, 192, 0.7)'
            },
            {
                label: 'Likes',
                data: [
                    {{ $engagement['recipe_likes'] }},
                    {{ $engagement['blog_likes'] }},
                    {{ $engagement['restaurant_likes'] }}
                ],
                backgroundColor: 'rgba(255, 99, 132, 0.7)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            },
            {
                label: 'Comments',
                data: [
                    {{ $engagement['recipe_comments'] }},
                    {{ $engagement['blog_comments'] }},
                    {{ $engagement['restaurant_comments'] }}
                ],
                backgroundColor: 'rgba(255, 206, 86, 0.7)',
                borderColor: 'rgba(255, 206, 86, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // // Age Distribution Chart
    // const ageCtx = document.getElementById('ageChart').getContext('2d');
    // const ageChart = new Chart(ageCtx, {
    //     type: 'bar',
    //     data: {
    //         labels: Object.keys(@json($demographics['age_groups'])),
    //         datasets: [{
    //             label: 'Users by Age',
    //             data: Object.values(@json($demographics['age_groups'])),
    //             backgroundColor: 'rgba(75, 192, 192, 0.7)',
    //             borderColor: 'rgba(75, 192, 192, 1)',
    //             borderWidth: 1
    //         }]
    //     },
    //     options: {
    //         responsive: true,
    //         scales: {
    //             y: {
    //                 beginAtZero: true
    //             }
    //         }
    //     }
    // });

    // // Gender Distribution Chart
    // const genderCtx = document.getElementById('genderChart').getContext('2d');
    // const genderChart = new Chart(genderCtx, {
    //     type: 'pie',
    //     data: {
    //         labels: Object.keys(@json($demographics['gender'])),
    //         datasets: [{
    //             data: Object.values(@json($demographics['gender'])),
    //             backgroundColor: [
    //                 'rgba(54, 162, 235, 0.7)',
    //                 'rgba(255, 99, 132, 0.7)',
    //                 'rgba(255, 206, 86, 0.7)'
    //             ],
    //             borderWidth: 1
    //         }]
    //     },
    //     options: {
    //         responsive: true
    //     }
    // });
</script>

<style>
    .dashboard {
        max-width: 100%;
        margin: 0 auto;
        padding: 20px 0;
    }

    .dashboard-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding: 15px;
        background-color: white;
        border-radius: 8px;
        /* box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); */
        box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 2px 0px;
    }

    .header-title {
        font-size: 24px;
        font-weight: 600;
        color: #5f5f5f;
    }

    .header-update {
        display: flex;
        align-items: center;
        gap: 10px;
        color: #6c757d;
    }

    .refresh-btn {
        background-color: #5f5f5f;
        color: white;
        border: none;
        padding: 5px 10px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 14px;
        transition: all 0.3s;
    }

    .refresh-btn:hover {
        background-color: #5f5f5f;
    }
    .dashboard-row{
        height: 450px;
    }
    .dashboard-recent-blog-cards{
        height: 100%;
        display: grid;
        grid-template-columns: repeat(2, 1fr);
    }
    .dashboard-recent-blog-card{
        display: flex;
        background-color: white;
        border-radius: 8px;
        /* box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); */
        box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 2px 0px;
        transition: transform 0.3s;
    }
    .dashboard-recent-blog-card-img{
        height: 50%;
        width: 100%;
    }
    .dashboard-recent-blog-card-img img{
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .dashboard-recent-blog-card-info{
        display: flex;
        flex-direction: column;
        background: #000;
    }
    .dashboard-recent-blog-card-info .title{
        font-size: 16px;
        font-weight: 500;
        padding: 0;
        margin: 0;
    }
    .dashboard-recent-blog-card-info .desc{
        font-size: 14px;
        font-weight: 400;
        padding: 0;
        margin: 0;
    }
    .dashboard-recent-blog-card-info .links{
        font-size: 16px;
        font-weight: 500;
        padding: 0;
        margin: 0;
    }
    .metrics-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
        margin-bottom: 20px;
    }
    .metrics-grid-6{
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 20px;
        margin-bottom: 20px;
    }
    .metric-card-6 {
        background-color: white;
        border-radius: 8px;
        padding: 20px;
        /* box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); */
        box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 2px 0px;
        transition: transform 0.3s;
    }
    .metric-card {
        height: 200px;
        width: 200px;
        background-color: white;
        border-radius: 8px;
        padding: 20px;
        /* box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); */
        box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 2px 0px;
        transition: transform 0.3s;
    }
    .metric-card img,
    .metric-card-6 img{
        width: 45px;
        height: 45px;
        padding: .7rem;
        object-fit: cover;
        aspect-ratio: 1 / 1;
        margin-bottom: 2rem;
        background: #dddddd57;
        border-radius: 50%;
    }

    .metric-card:hover {
        transform: translateY(-5px);
    }

    .metric-title {
        font-size: 14px;
        color: #6c757d;
        margin-bottom: 10px;
        font-weight: 500;
    }

    .metric-value {
        font-size: 24px;
        font-weight: 700;
        color: #5f5f5f;
        margin-bottom: 5px;
    }

    .content-section {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 20px;
        margin-bottom: 20px;
    }

    .content-stats {
        background-color: white;
        border-radius: 8px;
        padding: 20px;
        /* box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); */
        box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 2px 0px;
    }

    .section-title {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 20px;
        color: #5f5f5f;
        padding-bottom: 10px;
        border-bottom: 1px solid #eee;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
    }

    .stat-item {
        text-align: center;
        padding: 15px;
        border-radius: 8px;
        background-color: #f8f9fa;
    }

    .stat-value {
        font-size: 22px;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .stat-label {
        font-size: 13px;
        color: #6c757d;
    }

    .engagement-chart {
        background-color: white;
        border-radius: 8px;
        padding: 20px;
        /* box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); */
        box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 2px 0px;
        height: 100%;
    }

    .bottom-section {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .contributors {
        background-color: white;
        border-radius: 8px;
        padding: 20px;
        /* box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); */
        box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 2px 0px;
    }

    .contributor-table {
        width: 100%;
        border-collapse: collapse;
    }

    .contributor-table th {
        text-align: left;
        padding: 10px;
        font-size: 14px;
        color: #6c757d;
        border-bottom: 1px solid #eee;
    }

    .contributor-table td {
        padding: 12px 10px;
        border-bottom: 1px solid #eee;
        font-size: 14px;
    }

    .contributor-table tr:last-child td {
        border-bottom: none;
    }

    .demographics {
        background-color: white;
        border-radius: 8px;
        margin: 1rem 0;
        /* box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); */
        box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 2px 0px;
    }


    #engagementChart{
        flex: 1;
    }
    .demographics-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }
    #genderChart, #ageChart{
        height: 500px !important;
        background: red;
    }
    /* Responsive adjustments */
    @media (max-width: 1200px) {
        .metrics-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .content-section, .bottom-section {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .metrics-grid {
            grid-template-columns: 1fr;
        }
        
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .demographics-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection