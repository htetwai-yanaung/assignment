@extends('user.layouts.app')

@section('content')
<section id="h-section">
    <div class="d-inline-block bg-light rounded p-2">
        <a href="{{ route('home.index') }}" class="text-decoration-none">Home</a> <i class="fa-solid fa-angle-right"></i> <span>Search</span>
    </div>
    <div class="container">
        <div class="row mt-3">
            <div class="col-4 p-0">
                <div>
                    <h4>Filter By</h4>
                </div>
                <form action="{{ route('home.search') }}" method="get">
                    @csrf
                    <div>
                        <span>Sorting</span>
                    <div class="d-flex">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sorting" id="latest">
                            <label class="form-check-label" for="latest">Latest</label>
                        </div>
                        <div class="form-check ms-5">
                            <input class="form-check-input" type="radio" name="sorting" id="popular">
                            <label class="form-check-label" for="popular">Popular</label>
                        </div>
                    </div>
                    </div>
                    <div class="mt-3">
                        <label for="name">Item Name</label>
                        <input type="text" name="itemName" class="form-control bg-light" placeholder="Input Name">
                    </div>
                    <div class="mt-3">
                        <label for="">Price Range</label>
                        <div class="d-flex">
                            <input type="text" name="min" class="form-control me-1 bg-light" placeholder="min">
                            <input type="text" name="max" class="form-control ms-1 bg-light" placeholder="max">
                        </div>
                    </div>
                    <div class="mt-3">
                        <label>Category</label>
                        <select name="category" class="form-select bg-light">
                            <option value="" class="d-none">Choose One</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mt-3">
                        <label>Item Condition</label>
                        <select name="condition" class="form-select bg-light">
                            <option value="" class="d-none">Choose One</option>
                            @foreach ($conditions as $condition)
                                <option value="{{ $condition->id }}">{{ $condition->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mt-3">
                        <label>Type</label>
                        <select name="type" class="form-select bg-light">
                            <option value="" class="d-none">Choose One</option>
                            @foreach ($types as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary col-12 mt-3">Apply Filter</button>
                </form>
            </div>
            <div class="col-8">
                <div class="row">
                    @if (count($items) == 0)
                        <div class="col">
                            <h4 class="text-danger">No items found !</h4>
                        </div>
                    @else
                    @foreach ($items as $item)
                    <div class="col-4">
                        <a href="{{ route('home.details',$item->id) }}" class="text-decoration-none">
                            <div class="card mb-3" style="width: 13rem;">
                                <img src="{{ asset('asset/images/'.$item->photo) }}" class="card-img-top p-2" alt="...">
                                <div class="card-body bg-light rounded">
                                  <h5 class="card-title d-flex justify-content-between"><span class="text-dark">{{ Str::substr($item->name, 0, 10) }}...</span> <small class="fs-6 text-primary">{{ $item->condition->name }}</small></h5>
                                  <p class="card-text">${{ $item->price }}</p>
                                  <a href="#" class="d-flex align-items-center text-decoration-none mt-2">
                                    <div class="user-icon bg-info"><i class="fa-solid fa-user"></i></div>
                                    <span class="user-name h6 ms-2 text-muted">{{ Str::substr($item->owner->name,0,10) }} ...</span>
                                  </a>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
