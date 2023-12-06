@extends('admin.admin-dashboard')

@section('content')
    <div class="content-body" style="min-height: 500px">
        <div class="container-fluid">
            <div class="row">
                <div class="col-5">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Brand</h4>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                <form method="POST" action="{{ route('brand.store') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label"> Name<span class="text-danger">*</span> :</label>
                                            <input type="text" class="form-control" placeholder="Brand Name"
                                                name="name">
                                            @error('name')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Status</label>
                                            <select id="inputState" class="default-select form-control" name="status">
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success">Add</button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-7">
                    <div class="card">
                        <div class="card-header">
                                <h4 class="card-title">Brands List</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-responsive-md">
                                    <thead>
                                        <tr>
                                            <th class="width80"><strong>#</strong></th>
                                            <th><strong>NAME</strong></th>
                                            <th><strong>STATUS</strong></th>
                                            <th><strong>EDIT</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i=1; @endphp
                                        @foreach ($result as $item)
                                        <tr>
                                            <td><strong>{{$i++}}</strong></td>
                                            <td>{{$item->name}}</td>
                                            <td>
                                                @if ($item->status == 1)
                                                <span class="badge light badge-success">Active</span>
                                                @else
                                                <span class="badge light badge-warning">Inactive</span>
                                                @endif
                                            </td>
                                        <td>
                                            <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg{{$item->id}}">Edit</button>
                                            <div class="modal fade bd-example-modal-lg{{$item->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit {{$item->name}}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="POST" action={{url('brand/'.$item->id)}}>
                                                                @method('PUT')
                                                                @csrf
                                                            <div class="row">
                                                                <div class="mb-3 col-md-6">
                                                                    <label class="form-label"> Name</label>
                                                                    <input type="text" class="form-control" value="{{$item->name}}"
                                                                        name="name">

                                                                </div>
                                                                <div class="mb-3 col-md-6">
                                                                    <label class="form-label">Status</label>
                                                                    <select id="inputState" class="default-select form-control" name="status">
                                                                        <option value="1" @if($item->status==1) {{"selected"}} @endif>Active</option>
                                                                        <option value="0" @if($item->status==0) {{"selected"}} @endif>Inactive</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                                                            <button type="sumit" class="btn btn-primary">Save changes</button>
                                                        </div>
                                                    </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('extra_js')

@endsection
