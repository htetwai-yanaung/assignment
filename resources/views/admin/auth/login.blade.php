<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('asset/css/style.css') }}">

</head>
<body class="bg-light">
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-4 col-sm-8 col-10 offset-lg-4 offset-sm-2 offset-1 rounded p-3 shadow bg-white">
                <h3 class="text-center py-3 text-purple">LOG IN</h3>
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="mb-1 text-light-lg" for="">EMAIL</label>
                        <input type="email" name="email" placeholder="Enter your email ..." class="form-control input-normal @error('email') is-invalid @enderror">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="mb-1 text-light-lg" for="">PASSWORD</label>
                        <input type="password" name="password" placeholder="Enter your password ..." class="form-control input-normal @error('password') is-invalid @enderror">
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-purple col-12">Sign In</button>
                    </div>
                    <div class="text-center pb-3">
                        New on our platform? <a href="{{ url('register') }}" class="text-decoration-none text-purple">Create an account </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</html>
