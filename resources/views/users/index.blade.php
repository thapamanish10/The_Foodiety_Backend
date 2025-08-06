@extends('pages.home')

@section('content')
    @include('components.loading-screen')
    <div class="container">
        <div class="container-heading container-heading-section">
            <h3>User Management: Total Users: {{ $users->count() }}</h3>
        </div>
        <div class="table">
            <table>
                <thead>
                    <tr>
                        <td>Sn.</td>
                        <td>Name</td>
                        <td>Email</td>
                        <td>Role</td>
                        <td>Action <ion-icon name="ellipsis-vertical"></ion-icon></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <div class="form-group index-form-group">
                                    @if (auth()->user()->isSuperAdmin())
                                        <form action="{{ route('users.update-role', $user) }}" method="POST" id="blogForm">
                                            @csrf
                                            <select name="role" class="form-select" onchange="this.form.submit()">
                                                <option value="super_admin"
                                                    {{ $user->role === 'super_admin' ? 'selected' : '' }}>
                                                    Super
                                                    Admin</option>
                                                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin
                                                </option>
                                                <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User
                                                </option>
                                            </select>
                                        </form>
                                    @else
                                        {{ ucfirst($user->role) }}
                                    @endif
                                </div>
                            </td>
                            <td>
                                @if (auth()->user()->isAdmin())
                                    <a href="{{ route('users.reset-password', $user) }}"class="btn btn-outline-primary"><img
                                            src="{{ url('reset-password.png') }}" alt=""></a>
                                @endif
                                @if (auth()->user()->role === 'super_admin' && auth()->id() !== $user->id)
                                    <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger"
                                            onclick="return confirm('Are you sure you want to delete this blog?')"><img
                                                src="{{ url('trash.png') }}" alt=""></button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <x-pagination :paginator="$users" />
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const form = document.getElementById('blogForm');
                const loadingOverlay = document.getElementById('loadingOverlay');
                const submitButton = document.getElementById('submitButton');

                form.addEventListener('submit', function(e) {
                    // Show loading spinner
                    loadingOverlay.style.display = 'flex';

                    // Disable submit button to prevent multiple submissions
                    if (submitButton) {
                        submitButton.disabled = true;
                        submitButton.innerHTML = 'Processing...';
                    }
                });
            });
        </script>
    @endsection
