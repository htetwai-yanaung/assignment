@extends('admin.layouts.app')

@section('content')
<div class="mt-3">
    <span>Item List</span> <i class="fa-solid fa-chevron-right"></i> <span class="label">Edit Items</span>
</div>
<div class="bg-white p-3 shadow-sm rounded mt-3">
    <div class="container">
        <div class="row">
            <span class="fw-bold pb-3 fs-5">EDIT ITEM</span>
        </div>
    </div>
    <form action="{{ route('item.update', $item->id) }}" method="POST" class="container" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col">
                <span class="h6">Item Information</span>
                <div class="mt-3">
                    <label for="name" class="h6">Item Name</label>
                    <input type="text" name="name" id="name" value="{{ $item->name, old('name') }}" class="form-control input-normal" placeholder="Input name">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @endError
                </div>
                <div class="mt-3">
                    <label for="category" class="h6">Select Category</label>
                    <select name="category" id="category" class="form-select">
                        <option value="" class="d-none">Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @if($item->category_id == $category->id) selected @endif>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category')
                        <span class="text-danger">{{ $message }}</span>
                    @endError
                </div>
                <div class="mt-3">
                    <label for="price" class="h6">Price</label>
                    <input type="number" name="price" id="price" value="{{ $item->price, old('price') }}" class="form-control input-normal" placeholder="Enter price">
                    @error('price')
                        <span class="text-danger">{{ $message }}</span>
                    @endError
                </div>
                <div class="mt-3">
                    <label for="summernote" class="h6">Description</label>
                    <textarea id="summernote" name="description">{{ $item->description, old('description') }}</textarea>
                    @error('description')
                        <span class="text-danger">{{ $message }}</span>
                    @endError
                </div>
                <div class="mt-3">
                    <label for="condition" class="h6">Select Item Condition</label>
                    <select name="condition" id="condition" class="form-select">
                        <option value="" class="d-none">Select Item Condition</option>
                        @foreach ($conditions as $condition)
                            <option value="{{ $condition->id }}" @if($item->condition_id == $condition->id) selected @endif>{{ $condition->name }}</option>
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
                            <option value="{{ $type->id }}" @if($item->type_id == $type->id) selected @endif>{{ $type->name }}</option>
                        @endforeach
                    </select>
                    @error('type')
                        <span class="text-danger">{{ $message }}</span>
                    @endError
                </div>
                <div class="mt-3">
                    <span class="h6">Status</span>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="status" @if($item->status == 'publish') checked  @endif value="publish" id="publish">
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
                    <input type="text" name="ownerName" id="ownerName" value="{{ $item->owner->name, old('ownerName') }}" class="form-control input-normal" placeholder="Input name">
                    @error('ownerName')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mt-3">
                    <label for="phone" class="h6">Contact Number</label>
                    <input type="number" name="phone" id="phone" value="{{ $item->owner->phone, old('phone') }}" class="form-control input-normal" placeholder="Enter phone number">
                    @error('phone')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mt-3">
                    <label for="address" class="h6">Address</label>
                    <textarea name="address" id="address" cols="30" rows="3" class="form-control" placeholder="Enter address">{{ $item->owner->address, old('address') }}</textarea>
                    @error('address')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mt-3">
                    <div id="map" style="height: 550px; border-radius: 6px;"></div>
                    <input type="hidden" name="location" value="{{ $item->owner->location }}" id="location">
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
