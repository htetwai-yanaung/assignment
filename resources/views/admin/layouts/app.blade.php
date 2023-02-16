<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Point of Sale</title>

    <!--bootstrap5 css link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!--font-awesome cdn link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--custom css link-->
    <link rel="stylesheet" href="{{ url('asset/css/style.css') }}">
    <!--leaflet css-->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
    integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI="
    crossorigin=""/>
</head>
<body class="bg-light">
<header class="bg-white shadow">
    <a href="" class="logo">Dashboard</a>
    <nav>
        <a href="{{ route('item.index') }}" class="nav-item @if(Route::currentRouteName() == 'item.index' || Route::currentRouteName() == 'item.create') active @endif"><i class="fa-solid fa-house"></i>Item</a>
        <a href="{{ route('category.index') }}" class="nav-item @if(Route::currentRouteName() == 'category.index' || Route::currentRouteName() == 'category.create') active @endif"><i class="fa-solid fa-list"></i>category</a>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-btn"><i class="fa-solid fa-arrow-right-from-bracket"></i>Logout</button>
        </form>
    </nav>
</header>
<section class="p-3">
    <div class="container bg-white rounded shadow-sm p-2">
        <div class="row justify-content-end">
            <div class="col-6 d-flex justify-content-end align-items-center">
                <span class="fw-bold lh-lg me-3 text-purple">Admin</span>
                <div class="profile-btn">
                    <img src="{{ asset('asset/images/default-male-user.png') }}" class="profile-btn-img rounded-circle" alt="">
                </div>
            </div>
        </div>
        <div class="profile bg-white rounded shadow">
            <div class="p-img-container">
                <img class="profile-img rounded-circle" src="{{ asset('asset/images/default-male-user.png') }}" alt="">
            </div>
            <div class="text-center my-2">
                <span class="fw-bold text-purple">Htet Wai Yan Aung</span>
            </div>
            <div class="">
                <a href="" class="profile-item"><i class="fa-solid fa-gear"></i> Profile</a>
                <a href="" class="profile-item"><i class="fa-solid fa-lock"></i> Change Passwrod</a>
                <form action="" method="POST">
                    @csrf
                    <button class="profile-item"><i class="fa-solid fa-arrow-right-from-bracket"></i> logout</button>
                </form>
            </div>
        </div>
    </div>
    @yield('content')
</section>
<footer class="px-3">
    <div class="footer container bg-white rounded shadow-sm">
        <p class="text-center p-3">All rights reserved. Designed by <span>Htet Wai Yan Aung</span></p>
    </div>
</footer>
</body>

 <!-- leaflet js -->
 <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>

 <!-- include libraries(jQuery, bootstrap) -->
 <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

 <!-- include summernote css/js -->
 <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
 <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

 <!--bootstrap js link-->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

 @yield('scriptSource')

<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            height: 150,
        });
    });
</script>

<script>
    let profile = document.querySelector('.profile');
    let profileBtn = document.querySelector('.profile-btn');
    profileBtn.onclick = () => {
        profile.classList.toggle('active');
    }
    window.onscroll = () => {
        profile.classList.remove('active');
    }
</script>
</html>

