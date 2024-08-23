@extends('pages.home')

@section('content')
    <main class="dashboardContainer">
        <div class="navigationHeading">
            <span>Dashboard</span>
             <img src="{{ asset('dashboardicons/right.png') }}" alt="RightArrowIcon">
            <span class="segment">{{ Request::segment(1) }}</span>
             <img src="{{ asset('dashboardicons/right.png') }}" alt="RightArrowIcon">
              <span>{{ Request::segment(2) }}</span>
             <img src="{{ asset('dashboardicons/right.png') }}" alt="RightArrowIcon">
        </div>
        <div class="detailsformBody">
            <form action="{{ route('messages.store') }}" id="blogForm" class="form" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="formHeading">
                    <div class="formHeadingLeft">
                        <h3>Fill up the Information:</h3>
                        <p>Send a Message</p>
                    </div>
                    <div class="buttonDiv">
                        <button class="btn btnCancle">
                            <span>Cancel</span>
                            <img src="{{ asset('dashboardicons/cancle.png') }}" alt="CancleIcon">
                        </button>
                        <button class="btn btnAdd btnPrimary" type="submit">
                            <span>Create</span>
                            <img src="{{ asset('dashboardicons/add.png') }}" alt="AddIcon">
                        </button>
                    </div>
                </div>
                <div class="formBody">
                    <div class="row">
                        <div class="formGroup">
                            <label for="first_name">FIRST NAME:<span class="imp">*</span></label>
                            <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}">
                            @error('first_name')
                                <div>{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="formGroup">
                            <label for="last_name">LAST NAME:<span class="imp">*</span></label>
                            <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}">
                            @error('last_name')
                                <div>{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="formGroup">
                            <label for="email">EMAIL ADDRESS:<span class="imp">*</span></label>
                            <input type="text" name="email" id="email" value="{{ old('email') }}">
                            @error('email')
                                <div>{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="formGroup">
                            <label for="phone">PHONE NUMBER:<span class="imp">*</span></label>
                            <input type="text" name="phone" id="phone" value="{{ old('phone') }}">
                             @error('phone')
                                <div>{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="formGroup">
                        <label for="message">MESSAGE:<span class="imp">*</span></label>
                        <textarea type="text" cols="30" rows="10" name="message" id="editor">{{ old('message') }}</textarea>
                         @error('message')
                            <div>{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </form>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </div>
    </main>
@endsection

@section('ckScript')
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection


@section('jsScript')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('blogForm');
            const submitButton = document.getElementById('submitButton');

            // Function to check if all fields are filled
            function checkAllFieldsFilled() {
                constFields = form.querySelectorAll(']');
                let allFilled = true;
            Fields.forEach(field => {
                    if (field.value.trim() === '') {
                        allFilled = false;
                    }
                });
                return allFilled;
            }
            }

    </script>
@endsection
