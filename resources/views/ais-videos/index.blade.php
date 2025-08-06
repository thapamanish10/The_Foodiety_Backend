@extends('pages.home')

@section('content')
    <div class="container">
        <div class="container-heading container-heading-section">
            <h3>Videos Info:</h3>
            <div class="form-group-buttons">
                <a href="{{ route('ais.index') }}" class="create-btn"><strong style="margin-right: .5rem"></strong>Return</a>
                <a href="{{ route('ai-videos.create') }}" class="create-btn"><strong style="margin-right: .5rem">+
                    </strong>Create
                    Videos</a>
            </div>
        </div>
        <div class="table">
            <table>
                <thead>
                    <tr>
                        <td>Sn.</td>
                        <td>Name</td>
                        <td>Thumbnail</td>
                        <td>Desc</td>
                        <td>Created at</td>
                        <td>Action <ion-icon name="ellipsis-vertical"></ion-icon></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($videos as $video)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $video->name }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $video->thumbnail_path) }}" class="blogLogo"
                                    alt="{{ $video->name }}" width="40">
                            </td>
                            <td>{!! Str::limit($video->desc, 60) !!}</td>
                            <td> {{ $video->created_at->format('M d, Y') }}</td>
                            <td>
                                <a href="{{ route('videos.show', $video) }}" class="btn btn-outline-primary"><img
                                        src="{{ url('show.png') }}" alt=""></a>
                                @auth
                                    <a href="{{ route('videos.edit', $video) }}" class="btn btn-outline-secondary"><img
                                            src="{{ url('edit.png') }}" alt=""></a>
                                    <form action="{{ route('videos.destroy', $video) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger"
                                            onclick="return confirm('Are you sure you want to delete this video?')"><img
                                                src="{{ url('trash.png') }}" alt=""></button>
                                    </form>
                                @endauth
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <x-pagination :paginator="$videos" />
    </div>
@endsection
