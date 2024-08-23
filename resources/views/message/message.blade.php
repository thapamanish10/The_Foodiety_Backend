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
            <h3>Total Items ({{ $datas->count() }})</h3>
            <a href="{{ route('messages.create')}}">
                <button class="btn btnCreate btnPrimary">
                    <span>Create</span>
                     <img src="{{ asset('dashboardicons/add.png') }}" alt="CreateIcon">
                </button>
            </a>
        </div>
        @if (count($datas) > 0)
            <div class="productsContent">
                @if ($datas->count() <= 0)
                    <span>no data found</span>
                @else
                    @foreach ($datas as $data)
                       <div class="{{ $data->status === 'unvisited' ? 'unvisited' : 'messageCard' }}">
                            <div class="messageIcon">
                                <img src="{{ asset('assets/profile.png') }}" alt="">
                            </div>
                            <div class="messageText">
                                <h3>{{ $data->first_name  }} {{ $data->last_name  }}</h3>
                                <p>{!! $data->message !!}</p>
                            </div>
                            <div class="messageManageIcon">
                                @if ($data->status === 'unvisited')
                                    <form action="{{ route('messages.markAsRead', $data->id) }}" method="POST">
                                        @csrf
                                        <button class="btn btnEdit">
                                            <span>Mark as Read</span>
                                            <img src="{{ asset('dashboardicons/doublecheck.png') }}" alt="EditIcon">
                                        </button>
                                    </form>
                                @endif
                                <form action="{{ route('messages.delete', $data->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this message?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btnDelete btnDanger">
                                            <img src="{{ asset('dashboardicons/delete.png') }}" alt="DeleteIcon">
                                        </button>
                                    </form>
                                
                            </div>
                        </div>
                    @endforeach
                @endif
                <div class="tfoot">
                    <span>Displaying 1-10 of {{ $datas->count() }}</span>
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

