@extends('pages.home')

@section('content')
    <div class="container">
        <div class="container-heading container-heading-section">
            <h3>Services:</h3>
            <div class="form-group-buttons">
                <a href="{{ route('services.create') }}" class="create-btn"><strong style="margin-right: .5rem">+ </strong>
                    Create Service</a>
            </div>
        </div>
        <div class="table">
            <table>
                <thead>
                    <tr>
                        <td>Sn.</td>
                        <td>Name</td>
                        <td>Thumbnail</td>
                        <td>Title</td>
                        <td>Info</td>
                        <td>Why us</td>
                        <td>Actions</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($services as $service)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $service->name }}</td>
                            <td>
                                @if ($service->thumbnail)
                                    <img src="{{ asset('storage/' . $service->thumbnail) }}" width="50" alt="Thumbnail">
                                @endif
                            </td>
                            <td>{!! Str::limit($service->title, 30) !!}</td>
                            <td>{!! Str::limit($service->info, 30) !!}</td>
                            <td>{!! Str::limit($service->why, 30) !!}</td>
                            <td>
                                <a href="{{ route('services.show', $service->id) }}" class="btn btn-outline-primary"><img
                                        src="{{ url('show.png') }}" alt=""></a>
                                @auth
                                    <a href="{{ route('services.edit', $service->id) }}" class="btn btn-outline-secondary"><img
                                            src="{{ url('edit.png') }}" alt=""></a>
                                    <form action="{{ route('services.destroy', $service->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger"
                                            onclick="return confirm('Are you sure you want to delete this service information?')"><img
                                                src="{{ url('trash.png') }}" alt=""></button>
                                    </form>
                                @endauth
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
