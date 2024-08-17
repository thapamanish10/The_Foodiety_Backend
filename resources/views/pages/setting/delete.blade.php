@extends('pages.home')

@section('content')
    <div class="productsController">
        <div class="profileUserInfoForm">
            <div class="detailsformBody profileUserInfoFormBody">
                <form action="{{ route('profile.destroy') }}" id="" class="form" method="POST">
                    @csrf
                    @method('delete')
                    <div class="formHeading">
                        <div class="deleteText"><p>Once your account is deleted, all of its resources and data will  be permanently <br>delete.
                        Before deleting your account, please download any data or information <br> that you wish to retain.</p></div>
                        <div class="buttonDiv">
                            <button class="btn btnCancle">
                                <span>Cancel</span>
                                <img src="{{ asset('dashboardicons/cancle.png') }}" alt="CancleIcon">
                            </button>
                            <button class="btn btnDelete btnDanger" type="submit">
                                <span>Delete Account</span>
                                <img src="{{ asset('dashboardicons/delete.png') }}" alt="DeleteIcon">
                            </button>
                        </div>
                    </div>
                    <div class="formBody profileFormBody">
                        <div class="row">
                            <div class="formGroup">
                                <label for="password">password:<span class="imp">*</span></label>
                                <input type="password" name="password" id="password" autofocus>
                            </div>
                        </div>
                    </div>
                </form>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection