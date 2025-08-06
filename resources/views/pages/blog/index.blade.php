@extends('pages.home')

@section('content')
    <div class="container">
        <div class="container-heading container-heading-section">
            <h3>Blog Posts:</h3>
            <div class="form-group-buttons">
                <a href="{{ route('blogs.create') }}" class="create-btn"><strong style="margin-right: .5rem">+ </strong>
                    Create Blogs</a>
            </div>
        </div>
        <div class="table">
            <table>
                <thead>
                    <tr>
                        <td>Sn.</td>
                        <td>BLog Title</td>
                        <td>BLog Image</td>
                        <td>BLog Desc</td>
                        <td>Publish Date</td>
                        <td>Status</td>
                        <td>Type</td>
                        <td>Action <ion-icon name="ellipsis-vertical"></ion-icon></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($blogs as $blog)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $blog->name }}</td>
                            <td>
                                @if ($blog->images->count() > 0)
                                    @foreach ($blog->images as $image)
                                        @if (file_exists(public_path('storage/' . $image->path)))
                                            <img class="blogLogo" src="{{ asset('storage/' . $image->path) }}"
                                                alt="Blog Image" width="40">
                                        @else
                                            <img class="blogLogo" src="{{ asset('images/default-blog-image.jpg') }}"
                                                alt="Default Blog Image" width="40">
                                        @endif
                                    @endforeach
                                @else
                                    <img class="blogLogo" src="{{ asset('images/default-blog-image.jpg') }}"
                                        alt="Default Blog Image" width="40">
                                @endif
                            </td>
                            <td>{!! Str::limit($blog->desc, 60) !!}</td>
                            <td> {{ $blog->publish_at->format('M d, Y') }}</td>
                            <td>
                                @if ($blog->status === 'public')
                                    <img class="show-hide-icon show-image" src="{{ url('show.png') }}" alt="">
                                @else
                                    <img class="show-hide-icon hide-image" src="{{ url('hide.png') }}" alt="">
                                @endif
                            </td>
                            <td>
                                @foreach ($blog->categories as $category)
                                    <span class="badge bg-primary">{{ $category->name }}</span>
                                @endforeach
                            </td>
                            <td><a href="{{ route('blogs.show', $blog->id) }}" class="btn btn-outline-primary"><img
                                        src="{{ url('show.png') }}" alt=""></a>
                                @auth
                                    <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-outline-secondary"><img
                                            src="{{ url('edit.png') }}" alt=""></a>
                                    <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger"
                                            onclick="return confirm('Are you sure you want to delete this blog?')"><img
                                                src="{{ url('trash.png') }}" alt=""></button>
                                    </form>
                                @endauth
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <x-pagination :paginator="$blogs" />
    </div>
@endsection
