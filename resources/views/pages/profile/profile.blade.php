@extends('pages.home')

@section('content')
    <main class="productContainer">
        <div class="navigationHeading">
            <span>Dashboard</span>
             <img src="{{ asset('dashboardicons/right.png') }}" alt="RightArrowIcon">
            <span class="segment">{{ Request::segment(1) }}</span>
             <img src="{{ asset('dashboardicons/right.png') }}" alt="RightArrowIcon">
        </div>
        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form>
        <div class="dashboarProfile">
            <div class="profileHeading">
                <img src="{{ asset('dashboardicons/profielIcon.png') }}" alt="ProfileIcon">
                <h3>Account Perferences</h3>
            </div>

            {{-- USER PROFILE SECTION  --}}
            <div class="profileUserImage">
                <img src="{{ asset('dashboardicons/fox.png') }}" alt="ProfileIcon">
                <div class="changeProfileBtn">
                    <button class="btn btnPrimary"><img src="{{ asset('dashboardicons/upload.png') }}" alt="ProfileIcon"><span>Change</span></button>
                    <button class="btn btnDanger"><img src="{{ asset('dashboardicons/delete.png') }}" alt="ProfileIcon"><span>Remove</span></button>
                </div>
            </div>

            {{-- PERSONAL INFORMATION SECTION  --}}
            <div class="profileUserInfo">
                <div class="profileHeading">
                    <img src="{{ asset('dashboardicons/userInfo.png') }}" alt="InfoIcon">
                    <h3>Personal Information</h3>
                </div>
                <div class="profileUserInfoForm">
                    <div class="detailsformBody profileUserInfoFormBody">
                        <form action="{{ route('profile.update') }}" id="" class="form" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('patch')
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
                                        <label for="name">NAME:<span class="imp">*</span></label>
                                        {{-- <input type="text" name="name" id="name" value={{ old('name', $user->name)}} required autofocus> --}}
                                    </div>
                                    <div class="formGroup">
                                        <label for="email">EMAIL ADDRESS:<span class="imp">*</span></label>
                                        {{-- <input type="text" name="email" id="email" value="{{ old('email', $user->email) }}" required autofocus> --}}
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
        </div>
    </main>
@endsection
{{-- <label for="price_range">RESTAURANT LOGO: <span class="imp">*</span></label>
<div class="formGroupImage">
    <input type="file" name="company_logo" id="image" style="display: none;" value="{{ old('company_logo') }}" accept="image/jpeg, image/png, image/jpg">
    <img src="{{ asset('assets/upload.png') }}" class="uploadimage" alt="" id="customButton" onclick="document.getElementById('image').click();">
    <img src="" alt="Selected Image" id="selectedImage" style="display:none; max-width: 100%; max-height: 300px; margin-top: 10px;" onclick="document.getElementById('image').click();">
    <span id="fileName">Drop your image here, Or browse</span>
    <small>Supports: JPG, JPEG2000, PNG</small>
</div>
--}}