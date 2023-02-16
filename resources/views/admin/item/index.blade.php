@extends('admin.layouts.app')

@section('content')
<div class="d-flex flex-column mt-3">
    <span class="label">Items List</span>
    <div class="align-self-end">
        <a href="{{ route('item.create') }}" class="btn btn-purple"><i class="fa-solid fa-plus"></i> Add Items</a>
    </div>
    <div class="d-flex align-items-center">
        <label for="rowCount">show:</label>
        <select name="rowCount" id="rowCount" class="form-select ms-2" style="width: 110px;">
            <option value="15">15 rows</option>
            <option value="10">10 rows</option>
            <option value="5">5 rows</option>
        </select>
    </div>
</div>
<div class="mt-3">
    @if (session('fail'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <span>{{ session('fail') }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <span>{{ session('success') }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
</div>
<div class="bg-white shadow-sm rounded mt-3">
    <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col" class="text-center" style="width: 100px;">Action</th>
            <th scope="col">No</th>
            <th scope="col">Item</th>
            <th scope="col">Category</th>
            <th scope="col" style="width: 40%;">Description</th>
            <th scope="col">Price</th>
            <th scope="col">Owner</th>
            <th scope="col">Publish</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($items as $key=>$item)
          <tr>
            <td class="td-1 text-center">
                <a href="{{ route('item.edit', $item->id) }}" class="action edit-btn" data-bs-toggle="tooltip" data-bs-title="Edit"><i class="fa-solid fa-pen"></i></a>
                <a href="{{ route('item.delete', $item->id) }}" class="action delete-btn ms-2" data-bs-toggle="tooltip" data-bs-title="Delete"><i class="fa-solid fa-trash"></i></a>
            </td>
            <td class="td-1">{{ ($items->currentPage()-1)*10 + ($key+1) }}</td>
            <td class="td-1">{{ $item->name }}</td>
            <td class="td-1">{{ $item->category->name }}</td>
            <td class="td-1">{{ substr($item->description, 0, 100) }}...</td>
            <td class="td-1">{{ $item->price }}</td>
            <td class="td-1">{{ $item->owner->name }}</td>
            <td class="td-1">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" @if($item->status == 'publish') checked @endif role="switch" id="switch" value="{{ $item->id }}">
                </div>
            </td>
          </tr>
          @endforeach
        </tbody>
    </table>
</div>
<div>
    {{ $items->links() }}
</div>
@endsection


@section('scriptSource')
    <script>
        $(document).ready(function() {
            $('[id="switch"]').change(function (){


                if($(this).is(":checked")){
                    $data = {
                        'id' : $(this).val(),
                        'status' : 'publish'
                    };
                    changeStatus($data);
                }else{
                    $data = {
                        'id' : $(this).val(),
                        'status' : 'unpublish'
                    };
                    changeStatus($data);
                }

                function changeStatus($data) {
                    $.ajax({
                        type: 'get',
                        url: 'http://127.0.0.1:8000/item/change/status',
                        data: $data,
                        dataType: 'json',
                    })
                }
            })
        })
    </script>
@endsection

