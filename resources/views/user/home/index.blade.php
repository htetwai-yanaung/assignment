@extends('user.layouts.app')

@section('content')
<div id="h-header" class="bg-light">
    <form action="{{ route('home.index') }}" method="get" id="search-box" class="d-flex">
        @csrf
        <div class="input-group me-2">
            <input type="text" name="searchKey" class="form-control w-50" placeholder="search ...">
            <select class="form-select" id="category">
                <option value="" class="d-none">Categroy</option>
                <option value="">All</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">search</button>
    </form>
</div>
<section id="h-section">
    <div class="d-flex justify-content-between">
        <h3>What are you looking for ?</h3>
        <a href="" class="text-decoration-none">View More <i class="fa-solid fa-angle-right"></i></a>
    </div>
    <div class="category-list">
        <a href="{{ route('home.search') }}" class="box bg-light">
            <i class="fa-solid fa-desktop"></i>
            <span>Computer</span>
        </a>
        <a href="{{ route('home.search') }}" class="box bg-light">
            <i class="fa-solid fa-mobile-screen-button"></i>
            <span>Phone</span>
        </a>
        <a href="{{ route('home.search') }}" class="box bg-light">
            <i class="fa-solid fa-house-chimney"></i>
            <span>Property</span>
        </a>
        <a href="{{ route('home.search') }}" class="box bg-light">
            <i class="fa-solid fa-music"></i>
            <span>Music</span>
        </a>
        <a href="{{ route('home.search') }}" class="box bg-light">
            <i class="fa-solid fa-shirt"></i>
            <span>Fashion</span>
        </a>
        <a href="{{ route('home.search') }}" class="box bg-light">
            <i class="fa-solid fa-screwdriver-wrench"></i>
            <span>Service</span>
        </a>
    </div>
    <div class="d-flex justify-content-between mt-5">
        <h3>Recent items</h3>
        <a href="" class="text-decoration-none">View More <i class="fa-solid fa-angle-right"></i></a>
    </div>
    <div class="container">
        <div class="row" id="itemList">
            @if (count($items) == 0)
            <div class="col">
                <h4 class="text-danger">No items found !</h4>
            </div>
            @else
            @foreach ($items as $item)
            <div class="col-3">
                <a href="{{ route('home.details', $item->id) }}" class="text-decoration-none">
                    <div class="card mb-3" style="width: 13rem;">
                        <img src="{{ asset('asset/images/'.$item->photo) }}" class="card-img-top p-2" alt="...">
                        <div class="card-body bg-light rounded">
                          <h5 class="card-title d-flex justify-content-between"><span class="text-dark">{{ Str::substr($item->name, 0, 10) }}...</span> <small class="fs-6 text-primary">{{ $item->condition->name }}</small></h5>
                          <p class="card-text">{{ $item->price }}ks</p>
                          <a href="#" class="d-flex align-items-center text-decoration-none mt-2">
                            <div class="user-icon bg-info"><i class="fa-solid fa-user"></i></div>
                            <span class="user-name h6 ms-2 text-muted">{{ Str::substr($item->owner->name,0,10) }}...</span>
                          </a>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
            @endif

        </div>
    </div>
</section>

<footer class="bg-light text-center p-3 ms-0">
    <p>All rights reserved.</p>
</footer>
@endsection

@section('scriptSource')
<script>
    $(document).ready(function() {
        $('#category').change(function() {
            $categoryId = $(this).val();
            $.ajax({
                type: 'get',
                url: 'http://127.0.0.1:8000/home/filter',
                data: {'category_id' : $categoryId},
                dataType: 'json',
                success: function(response){
                    $list = '';
                    for($i=0; $i<response.length; $i++){
                        $id = response[$i].id.toString();
                        $name = response[$i].name.substring(0, 10);
                        $ownerName = response[$i].owner.name.substring(0, 10);
                        $list += `
                        <div class="col-3">
                            <span onclick="toDetails(${$id})" class="text-decoration-none">
                                <div id="toDetails" class="card mb-3" style="width: 13rem;">
                                    <img src="{{ asset('asset/images/${response[$i].photo}') }}" class="card-img-top p-2" alt="...">
                                    <div class="card-body bg-light rounded">
                                    <h5 class="card-title d-flex justify-content-between"><span class="text-dark">${$name}</span> <small class="fs-6 text-primary">${response[$i].condition.name}</small></h5>
                                    <p class="card-text">${response[$i].price}ks</p>
                                    <a href="#" class="d-flex align-items-center text-decoration-none mt-2">
                                        <div class="user-icon bg-info"><i class="fa-solid fa-user"></i></div>
                                        <span class="user-name h6 ms-2 text-muted">${$ownerName}</span>
                                    </a>
                                    </div>
                                </div>
                            </span>
                        </div>
                        `;
                        $('#itemList').html($list);

                    }
                }
            })
        })
    })
    function toDetails(id){
        window.location.href = 'http://127.0.0.1:8000/home/details/'+id;
    }
</script>
@endsection
