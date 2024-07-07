@if ($errors->any())
    <div class="alert alert-danger" id="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <div class="alert danger ">
                    <ion-icon name="alert-circle"></ion-icon>
                    <div class="alertMessage">
                        <h3>Error!</h3>
                        <span>{{ $error }}.</span>
                    </div>
                </div>
            @endforeach
        </ul>
    </div>
@endif
@if (session('success'))
    <div class="alert alert-success" id="alert">
        <div class="alert success">
            <ion-icon name="checkmark-circle"></ion-icon>
            <div class="alertMessage">
                <h3>Success!</h3>
                <span>{{ session('success') }}.</span>
            </div>
        </div>
    </div>
@endif

@section('alertScript')
    <script>
    // Show the alert
        document.addEventListener('DOMContentLoaded', function() {
            const alertElement = document.getElementById('alert');

            // Hide the alert after 6 seconds
            setTimeout(() => {
                alertElement.classList.add('hide');
            }, 6000);
        });
    </script>
@endsection