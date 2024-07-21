@extends('pages.home')

@section('content')
    <main class="dashboardContainer">
        <div class="navigationHeading">
            <span>Home</span>
            <ion-icon name="chevron-forward-outline"></ion-icon>
            <span>{{ Request::segment(1) }}</span>
            <ion-icon name="chevron-forward-outline"></ion-icon>
            <span>{{ Request::segment(2) }}</span>
            <ion-icon name="chevron-forward-outline"></ion-icon>
        </div>
        <div class="detailsformBody">
            <form action="{{ route("blog.store") }}" id="blogForm" class="form" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="formHeading">
                    <div class="formHeadingLeft">
                        <h3>Fill up the Information:</h3>
                        <p>Provide information about the blog post.</p>
                    </div>
                    <div class="buttonDiv">
                        <button class="formBtn cancle">
                            <span>Cancel</span>
                            <ion-icon name="close-circle-outline"></ion-icon>
                        </button>
                        <button class="formBtn update" type="submit" id="submitButton">
                            <span>Create</span>
                            <ion-icon name="add-circle-outline"></ion-icon>
                        </button>
                    </div>
                </div>
                <div class="formBody">
                    <div class="formGroup">
                        <label for="blog_title">BLOG TITLE: <span class="imp">*</span> </label>
                        <input type="text" name="blog_title" id="blog_title" value="{{ old('blog_title') }}">
                    </div>
                    <div class="row">
                        <div class="formGroup">
                            <label for="publish_date">Publish Date:<span class="imp">*</span></label>
                            <input type="date" name="publish_date" id="publish_date" value="{{ old('publish_date') }}">
                        </div>
                        <div class="formGroup">
                            <label for="blog_status">Status:<span class="imp">*</span></label>
                            <select class="custom-select" id="blog_status" name="blog_status">
                                <option value="">Choose blog status?</option>
                                <option value="Public">Public</option>
                                <option value="Private">Private</option>
                            </select>
                        </div>
                        <div class="formGroup">
                            <label for="blog_type">Type:<span class="imp">*</span></label>
                            <select class="custom-select" id="blog_type" name="blog_type">
                                <option value="">Choose blog type?</option>
                                <option value="Business">Business</option>
                                <option value="Couples">Couples</option>
                                <option value="Family">Family</option>
                                <option value="Friends">Friends</option>
                                <option value="Solo">Solo</option>
                            </select>
                        </div>
                    </div>
                    <div class="formGroup">
                        <label for="blog_text">BLOG TEXT:<span class="imp">*</span></label>
                        <textarea type="text" cols="30" rows="10" name="blog_text" id="editor">{{ old('blog_text') }}</textarea>
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

    </script>
@endsection
