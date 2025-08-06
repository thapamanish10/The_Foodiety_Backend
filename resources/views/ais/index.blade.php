@extends('pages.home')

@section('content')
    <div class="container">
        <div class="container-heading container-heading-section">
            <h3>The Foodiety AI Images:</h3>
            <div class="form-group-buttons">
                <a href="{{ route('ais.create') }}" class="create-btn"><strong style="margin-right: .5rem">+
                    </strong>Create Images</a>
                <a href="{{ route('ai-videos.index') }}" class="create-btn"><strong style="margin-right: .5rem">+ </strong>Create
                Videos</a>
            </div>
        </div>

        <div class="table">
            <table>
                <thead>
                    <tr>
                        <td>Sn.</td>
                        <td>Name</td>
                        <td>Image</td>
                        <td>Desc</td>
                        <td>Created at</td>
                        <td>Action <ion-icon name="ellipsis-vertical"></ion-icon></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ais as $ai)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $ai->name }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $ai->image) }}" class="blogLogo" alt="{{ $ai->name }}"
                                    width="40">
                            </td>
                            <td>{!! Str::limit($ai->description, 60) !!}</td>
                            <td> {{ $ai->created_at->format('M d, Y') }}</td>
                            <td>
                                <a href="{{ route('ais.show', $ai) }}" class="btn btn-outline-primary"><img
                                        src="{{ url('show.png') }}" alt=""></a>
                                @auth
                                    <a href="{{ route('ais.edit', $ai) }}" class="btn btn-outline-secondary"><img
                                            src="{{ url('edit.png') }}" alt=""></a>
                                    <form action="{{ route('ais.destroy', $ai) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger"
                                            onclick="return confirm('Are you sure you want to delete this image?')"><img
                                                src="{{ url('trash.png') }}" alt=""></button>
                                    </form>
                                @endauth
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <x-pagination :paginator="$ais" />
    </div>
@endsection
