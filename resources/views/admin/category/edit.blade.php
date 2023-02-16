@extends('admin.layouts.app')

@section('content')
<div class="mt-3">
    <span>Categories</span> <i class="fa-solid fa-chevron-right"></i> <span class="label">Add Categories</span>
</div>
<div class="bg-white p-3 shadow-sm rounded mt-3">
    <div class="container">
        <div class="row">
            <span class="fw-bold pb-3 fs-5">Add Categories</span>
        </div>
    </div>
    <form action="{{ route('category.update', $category->id) }}" method="POST" class="container" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-6">
                <div class="mt-3">
                    <label for="name" class="h6">Category</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" class="form-control input-normal" placeholder="Input name">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mt-3">
                    <span class="h6">Item Photo</span>
                    <label for="photo" class="btn col-12 btn-outline-purple"><i class="fa-solid fa-image"></i> Choose a photo</label>
                    <input type="file" name="photo" class="d-none" id="photo">
                    @error('photo')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mt-3">
                    <span class="h6">Status</span>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="status" @if($category->status == 'publish') checked @endif value="publish" id="publish">
                        <label class="form-check-label" for="publish">Publish</label>
                    </div>
                    @error('status')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-purple float-end ms-3">Save</button>
                    <a href="{{ route('category.index') }}" class="btn btn-outline-purple float-end">Cancle</a>
                </div>
            </div>
            <div class="col-6">
                <div class="category-image">
                    @if ($category->photo == null)
                        <img src="{{ asset('asset/images/default-image-icon-missing-picture.jpg') }}" class="rounded">
                    @else
                        <img src="{{ asset('asset/images/'.$category->photo) }}" class="rounded">
                    @endif
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
