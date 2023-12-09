<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <title>Login</title>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Login</div>
                    <div class="card-body">
                        {{-- Your login form --}}
                        <form method="POST" action="{{ url('/login') }}">
                            @csrf

                            <label for="email">Email:</label>
                            <input type="email" name="email" id="email" required>

                            <label for="password">Password:</label>
                            <input type="password" name="password" id="password" required>

                            <button type="submit">Login</button>
                        </form>
                        {{-- End of your login form --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="container mt-3">
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
</body>
</html>
