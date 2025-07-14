@extends('pages.home')

@section('content')
    <div class="container">
        <div class="container-heading container-heading-section">
            <h3>Blog Posts:</h3>
            <div class="form-group-buttons">
                <a href="{{ route('carousel.create') }}" class="create-btn"><strong style="margin-right: .5rem">+ </strong>
                    Create carousel</a>
            </div>
        </div>

        <div class="table">
            <table>
                <thead>
                    <tr>
                        <td>Sn.</td>
                        <td>Title</td>
                        <td>Image</td>
                        <td>Status</td>
                        <td>Action <ion-icon name="ellipsis-vertical"></ion-icon></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($carousels as $carousel)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $carousel->carousel_title }}</td>
                            <td>
                                <img class="companyLogo" src="{{ $carousel->carousel_Image }}" alt="" width="40">
                            </td>
                            <td>
                                @if ($carousel->carousel_status === "true")
                                    <img class="show-hide-icon show-image" src="{{ url('show.png') }}" alt="">
                                @else
                                    <img class="show-hide-icon hide-image" src="{{ url('hide.png') }}" alt="">
                                @endif
                            </td>
                            <td><a href="{{ route('carousel.show', $carousel->id) }}" class="btn btn-outline-primary"><img
                                        src="{{ url('show.png') }}" alt=""></a>
                                    <a href="{{ route('carousel.edit', $carousel->id) }}" class="btn btn-outline-secondary"><img
                                            src="{{ url('edit.png') }}" alt=""></a>
                                    <form action="{{ route('carousel.destroy', $carousel->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger"
                                            onclick="return confirm('Are you sure you want to delete this carousel?')"><img
                                                src="{{ url('trash.png') }}" alt=""></button>
                                    </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
