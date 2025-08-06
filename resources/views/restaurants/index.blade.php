@extends('pages.home')

@section('content')
    <div class="container">
        <div class="container-heading container-heading-section">
            <h3>Restaurants:</h3>
            <div class="form-group-buttons">
                <a href="{{ route('restaurants.create') }}" class="create-btn"><strong style="margin-right: .5rem">+ </strong>
                    Create Restaurant</a>
            </div>
        </div>
        <div class="table">
            <table>
                <thead>
                    <tr>
                        <td>Sn.</td>
                        <td>Logo</td>
                        <td>Name</td>
                        <td>Description</td>
                        <td>Status</td>
                        <td>Publish Date</td>
                        <td>Actions</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($restaurants as $restaurant)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if ($restaurant->logo)
                                    <img src="{{ asset('storage/' . $restaurant->logo) }}" alt="{{ $restaurant->name }}"
                                        width="50" height="50" class="img-thumbnail">
                                @else
                                    <span class="text-muted">No logo</span>
                                @endif
                            </td>
                            <td>{{ $restaurant->name }}</td>
                            <td>{!! Str::limit($restaurant->desc, 50) !!}</td>
                            <td>
                                @if ($restaurant->status === 'public')
                                    <img class="show-hide-icon show-image" src="{{ url('show.png') }}" alt="">
                                @else
                                    <img class="show-hide-icon hide-image" src="{{ url('hide.png') }}" alt="">
                                @endif
                            </td>
                            <td>{{ $restaurant->publish_at }}</td>
                            <td>
                                <a href="{{ route('restaurants.show', $restaurant->id) }}"
                                    class="btn btn-outline-primary"><img src="{{ url('show.png') }}" alt=""></a>
                                @auth
                                    <a href="{{ route('restaurants.edit', $restaurant->id) }}"
                                        class="btn btn-outline-secondary"><img src="{{ url('edit.png') }}" alt=""></a>
                                    <form action="{{ route('restaurants.destroy', $restaurant->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger"
                                            onclick="return confirm('Are you sure you want to delete this restaurant information?')"><img
                                                src="{{ url('trash.png') }}" alt=""></button>
                                    </form>
                                @endauth
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <x-pagination :paginator="$restaurants" />
    </div>
@endsection
