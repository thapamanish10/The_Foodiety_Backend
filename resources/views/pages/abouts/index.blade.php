@extends('pages.home')

@section('content')
    <div class="container">
        <div class="container-heading container-heading-section">
            <h3>About Information:</h3>
            {{-- @if ($abouts->count() < 1) --}}
            <div class="form-group-buttons">
                <a href="{{ route('business.create') }}" class="create-btn"><strong style="margin-right: .5rem">+ </strong>
                    Create About</a>
            </div>
            {{-- @endif --}}
        </div>
        <div class="table">
            <table>
                <thead>
                    <tr>
                        <td>Sn.</td>
                        <td>Logo</td>
                        <td>Name</td>
                        <td>Desc</td>
                        <td>Email</td>
                        <td>Number</td>
                        <td>Opt Number</td>
                        <td>Socials</td>
                        <td>Action <ion-icon name="ellipsis-vertical"></ion-icon></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($abouts as $about)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <img class="blogLogo" src="{{ asset('storage/' . $about->logo) }}" alt="Blog Image"
                                    width="40">
                            </td>
                            <td>{{ $about->name }}</td>
                            <td>{!! Str::limit($about->desc, 40) !!}</td>
                            <td> {{ $about->email }}</td>
                            <td> {{ $about->number }}</td>
                            <td> {{ $about->opt_number }}</td>
                            <td>
                                @if ($about->facebook)
                                    <img width="30" style="border-radius: .2rem" src="{{ url('fb.png') }}"
                                        alt="">
                                @endif
                                @if ($about->instagram)
                                    <img width="30" style="border-radius: .2rem" src="{{ url('in.png') }}"
                                        alt="">
                                @endif
                                @if ($about->youtube)
                                    <img width="30" style="border-radius: .2rem" src="{{ url('yt.png') }}"
                                        alt="">
                                @endif
                                @if ($about->tiktok)
                                    <img width="30" style="border-radius: .2rem" src="{{ url('tk.png') }}"
                                        alt="">
                                @endif
                                @if ($about->threads)
                                    <img width="30" style="border-radius: .2rem" src="{{ url('td.png') }}"
                                        alt="">
                                @endif
                            </td>
                            <td><a href="{{ route('business.show', $about->id) }}" class="btn btn-outline-primary"><img
                                        src="{{ url('show.png') }}" alt=""></a>
                                <a href="{{ route('business.edit', $about->id) }}" class="btn btn-outline-secondary"><img
                                        src="{{ url('edit.png') }}" alt=""></a>
                                <form action="{{ route('business.destroy', $about->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger"
                                        onclick="return confirm('Are you sure you want to delete this about Information?')"><img
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
