@extends('pages.home')

@section('content')
    <div class="container">
        <div class="container-heading container-heading-section">
            <h3>Categories:</h3>
            <div class="form-group-buttons">
                <a href="{{ route('categories.create') }}" class="create-btn"><strong style="margin-right: .5rem">+ </strong>
                    Create Category</a>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <td>Sn.</td>
                    <td>Name</td>
                    <td>Slug</td>
                    <td>Actions</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->slug }}</td>
                        <td>
                            <a href="{{ route('categories.edit', $category) }}" class="btn btn-outline-secondary"><img
                                    src="{{ url('edit.png') }}" alt=""></a>
                            <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger"
                                    onclick="return confirm('Are you sure you want to delete this category?')"><img
                                        src="{{ url('trash.png') }}" alt=""></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <x-pagination :paginator="$categories" />
    </div>
@endsection
