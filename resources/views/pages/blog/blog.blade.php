@extends('pages.home')

@section('content')
    <main class="productsContainer">
        <div class="navigationHeading">
            <span>Dashboard</span>
            <ion-icon name="chevron-forward-outline"></ion-icon>
            <span class="segment">{{ Request::segment(1) }}</span>
            <ion-icon name="chevron-forward-outline"></ion-icon>
        </div>
        <div class="totelItems">
            <h3>Total Items ()</h3>
            <a href="{{ route('blog.create')}}">
                <button class="addReview add">
                    <span>Create</span>
                    <ion-icon name="add-circle-outline"></ion-icon>
                </button>
            </a>
        </div>
        @if (count($datas) > 0)
            <div class="productsContent">
                <table>
                    <thead>
                        <tr>
                            <td></td>
                            <td>BLog Title</td>
                            <td>BLog Image</td>
                            <td>Publish Date</td>
                            <td>Status</td>
                            <td>Type</td>
                            <td><ion-icon name="ellipsis-vertical"></ion-icon></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $data)
                            <tr>
                                <td><input type="checkbox"></td>
                                <td>
                                    <a href="{{ route('blog.detail', ['id' => $data->id]) }}" class="navigation_a_tag">
                                        {{ $data->blog_title }}
                                    </a>
                                </td>
                                <td>
                                    <img class="blogLogo" src="{{ $data->blog_image }}" alt="">
                                </td>
                                <td>{{ $data->publish_date }}</td>
                                <td>{{ $data->blog_status }}</td>
                                <td>{{ $data->blog_type }}</td>
                                <td><ion-icon name="ellipsis-vertical"></ion-icon></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="tfoot">
                    <span>Displaying 1-10 of {{ $totalDatas }}</span>
                    @if ($datas->onFirstPage())
                        <a href="" class="disabled">
                            <ion-icon name="chevron-back-outline"></ion-icon>
                        </a>
                    @else
                        <a href="{{ $datas->previousPageUrl() }}" rel="prev">
                            <ion-icon name="chevron-back-outline"></ion-icon>
                        </a>
                    @endif

                    @if ($datas->hasMorePages())
                        <a href="{{ $datas->nextPageUrl() }}" rel="next">
                            <ion-icon name="chevron-forward-outline"></ion-icon>
                        </a>
                    @else
                        <a href="" class="disabled">
                            <ion-icon name="chevron-forward-outline"></ion-icon>
                        </a>
                    @endif
                </div>
            </div>
        @else
            <span class="empty_data">no data found</span>
        @endif
    </main>
@endsection
