@extends('pages.home')

@section('content')
    <main class="productsContainer">
        <div class="navigationHeading">
            <span>Home</span>
            <ion-icon name="chevron-forward-outline"></ion-icon>
            <span>{{ Request::segment(1) }}</span>
            <ion-icon name="chevron-forward-outline"></ion-icon>
            <span>{{ Request::segment(2) }}</span>
            <ion-icon name="chevron-forward-outline"></ion-icon>
        </div>
        <div class="detailsformBody">
            <form action="{{ route('product.about.store', $data->id) }}" id="" class="form" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="formHeading">
                    <div class="formHeadingLeft">
                        <h3>Fill up the Information:</h3>
                        <p>Provide information about the restaurant to contact.</p>
                    </div>
                    <div class="buttonDiv">
                        <button class="formBtn cancle">
                            <span>Cancel</span>
                            <ion-icon name="close-circle-outline"></ion-icon>
                        </button>
                        <button class="formBtn update" type="submit">
                            <span>Update</span>
                            <ion-icon name="checkmark-circle-outline"></ion-icon>
                        </button>
                    </div>
                </div>
                <div class="formBody">
                    <div class="formGroup">
                        <label for="price_range">PRICE RANGE:</label>
                        <input type="text" value="{{ $data->price_range }}" name="price_range" id="price_range">
                    </div>
                    <div class="formGroup">
                        <label for="cuisines">CUISINES:</label>
                        <input type="text" value="{{ $data->cuisines }}" name="cuisines" id="cuisines">
                    </div>
                    <div class="formGroup">
                        <label for="special_diets">SPECIAL DIETS:</label>
                        <input type="text" value="{{ $data->special_diets }}" name="special_diets" id="special_diets">
                    </div>
                    <div class="formGroup">
                        <label for="meals">MEALS:</label>
                        <input type="text" value="{{ $data->meals }}" name="meals" id="meals">
                    </div>
                    <div class="formGroup">
                        <label for="about">ABOUT:</label>
                        <textarea type="text" cols="30" rows="10" name="about_us" id="editor">{{ $data->about_us }}</textarea>
                    </div>
                    <div class="formGroup">
                        <label for="features">FEATURES:</label>
                        <textarea type="text" cols="30" rows="10" name="features" id="features">{{ $data->features }}</textarea>
                    </div>
                </div>
            </form>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

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

        ClassicEditor
            .create(document.querySelector('#features'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
