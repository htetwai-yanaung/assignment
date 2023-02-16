@extends('user.layouts.app')

@section('content')
<section id="h-section" style="height: 200vh;">
    <div class="d-inline-block bg-light rounded p-2">
        <a href="{{ route('home.index') }}" class="text-decoration-none">Home</a> <i class="fa-solid fa-angle-right"></i> Fashion <i class="fa-solid fa-angle-right"></i> <span>Details</span>
    </div>
    <div class="container mt-3">
        <div class="row">
            <div class="col details-image bg-light">
                <img src="{{ asset('asset/images/'.$item->photo) }}" alt="">
            </div>
        </div>
        <div class="row">
            <div class="col d-flex flex-column justify-content-between">
                <div class="mt-3">
                    <h4>{{ $item->name }}</h4>
                    <h5 class="text-primary">${{ $item->price }}</h5>
                </div>
                <div class="d-flex mt-3">
                    <div class="d-flex flex-column align-items-center me-5">
                        <span class="h6">Type</span>
                        <span class="alert alert-danger border-0 px-1 py-0">{{ $item->type->name }}</span>
                    </div>
                    <div class="d-flex flex-column align-items-center me-5">
                        <span class="h6">Condition</span>
                        <span class="alert alert-primary border-0 px-1 py-0">{{ $item->condition->name }}</span>
                    </div>
                    <div class="d-flex flex-column align-items-center me-5">
                        <span class="h6">Status</span>
                        <span class="alert alert-success border-0 px-1 py-0">{{ $item->status=='publish'?'available':'unavailable' }}</span>
                    </div>
                </div>
                <div class="mt-3">
                    <h5>Product Description</h5>
                    <input type="hidden" id="description" value="{{ $item->description }}">
                    <p id="desc"></p>
                </div>
                <div class="">
                    <h5>Owner Information</h5>
                    <div class="shadow-sm px-3 py-2 rounded">
                        <h6><i class="fa-solid fa-phone py-1"></i> Contact Number</h6>
                        <span class="py-1">{{ $item->owner->phone }}</span>
                    </div>
                </div>
                <div class="d-flex align-items-center bg-light px-3 py-2 rounded shadow-sm mt-3">
                    <div class="user-icon bg-warning">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <div class="ms-3 d-flex flex-column justify-content-center">
                        <span>{{ $item->owner->name }}</span>
                        <small class="text-muted">{{ $item->owner->address }}</small>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="mt-3">
                    <input type="hidden" id="location" value="{{ $item->owner->location }}">
                    <h6><i class="fa-solid fa-location-dot"></i> Location</h6>
                    <h6>{{ $item->owner->address }}</h6>
                </div>
                <div class="mt-3">
                    <div id="map" style="height: 500px; border-radius: 6px;"></div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection


@section('scriptSource')
    <script>
        let latlng = document.getElementById('location').value;
        latlng = latlng.split(",");
        let lat = latlng[0];
        let lng = latlng[1].trim();

        var map = L.map('map').setView([lat, lng], 13);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        var marker = L.marker([lat, lng]).addTo(map);

        map.on('click', (e)=>{
            var popup = L.popup()
            .setLatLng(latlng)
            .setContent('<p>Hello world!<br />This is a nice popup.</p>')
            .openOn(map);
        })

        let description = document.getElementById('description').value;
        document.getElementById('desc').innerHTML = `${description}`;
    </script>
@endsection
