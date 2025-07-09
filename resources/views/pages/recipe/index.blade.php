@extends('pages.home')

@section('content')
    <div class="container">
        <div class="container-heading container-heading-section">
            <h3>Recipe Posts:</h3>
            <div class="form-group-buttons">
                <a href="{{ route('recipes.create') }}" class="create-btn"><strong style="margin-right: .5rem">+
                    </strong>Create Recipes</a>
            </div>
        </div>
        <div class="table">
            <table>
                <thead>
                    <tr>
                        <td>Sn.</td>
                        <td>Recipes Name</td>
                        <td>Recipes Image</td>
                        <td>Recipes Desc</td>
                        <td>Publish Date</td>
                        <td>Status</td>
                        <td>Type</td>
                        <td>Action <ion-icon name="ellipsis-vertical"></ion-icon></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($recipes as $recipe)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $recipe->name }}</td>
                            <td>
                                @if ($recipe->images->count() > 0)
                                    @foreach ($recipe->images as $image)
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
                            <td>{!! Str::limit($recipe->desc, 60) !!}</td>
                            <td> {{ $recipe->publish_at->format('M d, Y') }}</td>
                            <td>
                                @if ($recipe->status === 'public')
                                    <img class="show-hide-icon show-image" src="{{ url('show.png') }}" alt="">
                                @else
                                    <img class="show-hide-icon hide-image" src="{{ url('hide.png') }}" alt="">
                                @endif
                            </td>
                            <td>
                                @foreach ($recipe->categories as $category)
                                    <span class="badge bg-primary">{{ $category->name }}</span>
                                @endforeach
                            </td>
                            <td><a href="{{ route('recipes.show', $recipe->id) }}" class="btn btn-outline-primary"><img
                                        src="{{ url('show.png') }}" alt=""></a>
                                @auth
                                    <a href="{{ route('recipes.edit', $recipe->id) }}" class="btn btn-outline-secondary"><img
                                            src="{{ url('edit.png') }}" alt=""></a>
                                    <form action="{{ route('recipes.destroy', $recipe->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger"
                                            onclick="return confirm('Are you sure you want to delete this recipe?')"><img
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
