@extends('pages.home')

@section('content')
    <main class="productsContainer">
        <div class="navigationHeading">
            <span>Dashboard</span>
             <img src="{{ asset('dashboardicons/right.png') }}" alt="RightArrowIcon">
            <span class="segment">{{ Request::segment(1) }}</span>
             <img src="{{ asset('dashboardicons/right.png') }}" alt="RightArrowIcon">
        </div>
        <div class="totelItems">
            <h3>Total Items ({{ $totalDatas }})</h3>
            <a href="{{ route('product.create')}}">
                <button class="btn btnCreate btnPrimary">
                    <span>Create</span>
                     <img src="{{ asset('dashboardicons/add.png') }}" alt="CreateIcon">
                </button>
            </a>
        </div>
        @if (count($datas) > 0)
            <div class="productsContent">
                <table>
                    <thead>
                        <tr>
                            <td></td>
                            <td>Restaurant Name</td>
                            <td>Restaurant Logo</td>
                            <td>Location</td>
                            <td>Contact Number</td>
                            <td>Opening Time</td>
                            <td>Ratings</td>
                            <td><ion-icon name="ellipsis-vertical"></ion-icon></td>
                        </tr>
                    </thead>
                    @if ($datas->count() <= 0)
                        
                    <tbody>
                        <tr>
                            <td><span>no data found</span></td>
                        </tr>
                    </tbody>
                    @else
                    <tbody>
                        @foreach ($datas as $data)
                            <tr>
                                <td><input type="checkbox"></td>
                                <td>
                                    <a href="{{ route('product.detail', ['id' => $data->id]) }}" class="navigation_a_tag">
                                        {{ $data->name }}
                                    </a>
                                </td>
                                <td>
                                    <img class="companyLogo" src="{{ $data->company_logo }}" alt="">
                                </td>
                                <td>{{ $data->location }}</td>
                                <td>{{ $data->phone_number }}</td>
                                <td>{{ $data->opening_time }}</td>
                                <td><div> {{ $data->rating }} / 10 <img src="{{ asset('assets/rating.png') }}" class="ratingLogo" alt=""></div></td>
                                <td><ion-icon name="ellipsis-vertical"></ion-icon></td>
                            </tr>
                        @endforeach
                    </tbody>
                    @endif
                </table>
                <div class="tfoot">
                    <span>Displaying 1-10 of {{ $totalDatas }}</span>
                    @if ($datas->onFirstPage())
                        <a href="" class="disabled">
                            <img src="{{ asset('dashboardicons/left-arrow.png') }}" alt="LeftArrowIcon">
                        </a>
                    @else
                        <a href="{{ $datas->previousPageUrl() }}" rel="prev">
                            <img src="{{ asset('dashboardicons/left-arrow.png') }}" alt="LeftArrowIcon">
                        </a>
                    @endif

                    @if ($datas->hasMorePages())
                        <a href="{{ $datas->nextPageUrl() }}" rel="next">
                            <img src="{{ asset('dashboardicons/right-arrow.png') }}" alt="RightArrowIcon">
                        </a>
                    @else
                        <a href="" class="disabled">
                            <img src="{{ asset('dashboardicons/right-arrow.png') }}" alt="RightArrowIcon">
                        </a>
                    @endif
                </div>
            </div>
        @else
           <span class="empty_data">no data found</span>
        @endif
    </main>
@endsection

