@if ($errors->any())
    <div class="alert alert-danger" id="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <div class="alert danger ">
                    <img src="{{ asset('dashboardicons/error.png') }}" alt="ErrorIcon">
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
            <img src="{{ asset('dashboardicons/success.png') }}" alt="SuccessIcon">
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