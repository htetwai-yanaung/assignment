@extends('admin.layouts.app')

@section('content')
<div class="mt-3">
    <span>Item List</span> <i class="fa-solid fa-chevron-right"></i> <span class="label">Add Items</span>
</div>
<div class="bg-white p-3 shadow-sm rounded mt-3">
    <div class="container">
        <div class="row">
            <span class="fw-bold pb-3 fs-5">CREATE NEW ITEM</span>
        </div>
    </div>
    <form action="{{ route('item.store') }}" method="POST" class="container" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col">
                <span class="h6">Item Information</span>
                <div class="mt-3">
                    <label for="name" class="h6">Item Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control input-normal" placeholder="Input name">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @endError
                </div>
                <div class="mt-3">
                    <label for="category" class="h6">Select Category</label>
                    <select name="category" id="category" class="form-select">
                        <option value="" class="d-none">Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category')
                        <span class="text-danger">{{ $message }}</span>
                    @endError
                </div>
                <div class="mt-3">
                    <label for="price" class="h6">Price</label>
                    <input type="number" name="price" id="price" value="{{ old('price') }}" class="form-control input-normal" placeholder="Enter price">
                    @error('price')
                        <span class="text-danger">{{ $message }}</span>
                    @endError
                </div>
                <div class="mt-3">
                    <label for="summernote" class="h6">Description</label>
                    <textarea id="summernote" name="description">{{ old('description') }}</textarea>
                    @error('description')
                        <span class="text-danger">{{ $message }}</span>
                    @endError
                </div>
                <div class="mt-3">
                    <label for="condition" class="h6">Select Item Condition</label>
                    <select name="condition" id="condition" class="form-select">
                        <option value="" class="d-none">Select Item Condition</option>
                        @foreach ($conditions as $condition)
                            <option value="{{ $condition->id }}">{{ $condition->name }}</option>
                        @endforeach
                    </select>
                    @error('condition')
                        <span class="text-danger">{{ $message }}</span>
                    @endError
                </div>
                <div class="mt-3">
                    <label for="type" class="h6">Select Item Type</label>
                    <select name="type" id="type" class="form-select">
                        <option value="" class="d-none">Select Item Type</option>
                        @foreach ($types as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                    @error('type')
                        <span class="text-danger">{{ $message }}</span>
                    @endError
                </div>
                <div class="mt-3">
                    <span class="h6">Status</span>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="status" value="publish" id="publish">
                        <label class="form-check-label" for="publish">Publish</label>
                    </div>
                    @error('status')
                        <span class="text-danger">{{ $message }}</span>
                    @endError
                </div>
                <div class="mt-3">
                    <span class="h6">Item Photo</span>
                    <label for="photo" class="btn col-12 btn-outline-purple"><i class="fa-solid fa-image"></i> Choose a photo</label>
                    <input type="file" class="d-none" id="photo" name="photo">
                    @error('photo')
                        <span class="text-danger">{{ $message }}</span>
                    @endError
                </div>
            </div>
            <div class="col">
                <span class="h6">Owner Information</span>
                <div class="mt-3">
                    <label for="ownerName" class="h6">Owner Name</label>
                    <input type="text" name="ownerName" id="ownerName" value="{{ old('ownerName') }}" class="form-control input-normal" placeholder="Input name">
                    @error('ownerName')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mt-3">
                    <label for="phone" class="h6">Contact Number</label>
                    <input type="number" name="phone" id="phone" value="{{ old('phone') }}" class="form-control input-normal" placeholder="Enter phone number">
                    @error('phone')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mt-3">
                    <label for="address" class="h6">Address</label>
                    <textarea name="address" id="address" cols="30" rows="3" class="form-control" placeholder="Enter address">{{ old('address') }}</textarea>
                    @error('address')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                {{-- <div class="mt-3">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d488799.4874326692!2d95.90137815046135!3d16.8389524908704!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30c1949e223e196b%3A0x56fbd271f8080bb4!2sYangon!5e0!3m2!1sen!2smm!4v1676335872195!5m2!1sen!2smm" width="100%" height="550" style="border:0; border-radius: 5px" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div> --}}
                <div class="mt-3">
                    <div id="map" style="height: 550px; border-radius: 6px;"></div>
                    <input type="hidden" name="location" id="location">
                    @error('location')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <button type="submit" class="btn btn-purple float-end ms-3">Save</button>
                <a href="{{ route('item.index') }}" class="btn btn-outline-purple float-end">Cancle</a>
            </div>
        </div>
    </form>
</div>
@endsection

@section('scriptSource')
    <script>
        var map = L.map('map').setView([16.83998708049454, 96.17603208715407], 13);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        var marker = L.marker([16.83998708049454, 96.17603208715407]).addTo(map);

        var popup = L.popup();

        function onMapClick(e) {
            popup
                .setLatLng(e.latlng)
                .setContent("You clicked the map at " + e.latlng.toString())
                .openOn(map);
        }

        map.on('click', onMapClick);

        map.on('click', function(e){
            let coordinates = e.latlng;
            let latlng = coordinates.lat+ ', '+coordinates.lng;
            document.getElementById('location').value = latlng;
        });
    </script>
@endsection
