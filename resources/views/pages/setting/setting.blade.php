@extends('pages.home')

@section('content')
    <main class="productContainer">
        <div class="navigationHeading">
            <span>Dashboard</span>
             <img src="{{ asset('dashboardicons/right.png') }}" alt="RightArrowIcon">
            <span class="segment">{{ Request::segment(1) }}</span>
             <img src="{{ asset('dashboardicons/right.png') }}" alt="RightArrowIcon">
        </div>
        <div class="dashboarProfile">
            {{-- CHANGE PASSWORD SECTION  --}}
            <div class="profileUserInfo">
                <div class="profileHeading">
                    <img src="{{ asset('dashboardicons/password.png') }}" alt="PasswordIcon">
                    <h3>Update Password</h3>
                </div>
                <div class="profileUserInfoForm">
                    <div class="detailsformBody profileUserInfoFormBody">
                        <form action="{{ route('password.update') }}" id="" class="form" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="formHeading">
                                <div><p>Update your account's profile information and email address.</p></div>
                                <div class="buttonDiv">
                                    <button class="btn btnCancle">
                                        <span>Cancel</span>
                                        <img src="{{ asset('dashboardicons/cancle.png') }}" alt="CancleIcon">
                                    </button>
                                    <button class="btn btnUpdate btnPrimary" type="submit">
                                        <span>Update</span>
                                        <img src="{{ asset('dashboardicons/update.png') }}" alt="UpdateIcon">
                                    </button>
                                </div>
                            </div>
                            <div class="formBody profileFormBody">
                                <div class="row">
                                    <div class="formGroup">
                                        <label for="password">CURRENT PASSWORD:<span class="imp">*</span></label>
                                        <input type="password" name="current_password" id="update_password_current_password">
                                    </div>
                                    <div class="formGroup">
                                        <label for="password">NEW PASSWORD:<span class="imp">*</span></label>
                                        <input type="password" name="password" id="update_password_password">
                                    </div>
                                    <div class="formGroup">
                                        <label for="password_confirmation">CONFIRM PASSWORD:<span class="imp">*</span></label>
                                        <input type="password" name="password_confirmation" id="update_password_password_confirmation">
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
                <br>
                <br>
                <div class="deleteAccount">
                    <div class="profileHeading">
                        <img src="{{ asset('dashboardicons/delete-user.png') }}" alt="PasswordIcon">
                        <h3>Delete Account</h3>
                    </div>
                    <div class="profileUserInfoForm">
                        <div class="detailsformBody profileUserInfoFormBody">
                            <div class="formHeading">
                                <div class="deleteText"><p>Once your account id deleted, all of its resources and data will be permanently delete.</p>
                                <p>Before deleting your account, please download any data or information that you wish to retain.</p></div>
                                <a href="{{ route('profile.delete') }}">
                                    <div class="buttonDiv">
                                        <button class="btn btnDelete btnDanger" type="submit">
                                            <span>Delete Account</span>
                                            <img src="{{ asset('dashboardicons/delete.png') }}" alt="DeleteIcon">
                                        </button>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection