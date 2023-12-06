@extends('admin.admin-dashboard')

@section('content')
<div class="content-body" style="min-height: 500px">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Employee List</h4>
            </div>
            <div class="row">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                                <tr>
                                    <th class="width80"><strong>#</strong></th>
                                    <th><strong>ID</strong></th>
                                    <th><strong>Employee Name</strong></th>
                                    <th><strong>Photo</strong></th>
                                    <th><strong>Department</strong></th>
                                    <th><strong>Designation</strong></th>
                                    <th><strong>Employee Type</strong></th>
                                    <th><strong>Joining Date</strong></th>
                                    <th><strong>Mobile Number</strong></th>
                                    <th><strong>Action</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=1; @endphp
                                @foreach ($result as $item)
                                <tr>
                                    <td><strong>{{$i++}}</strong></td>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->employee_name}}</td>
                                    <td>
                                        <img src="{{ asset($item->image) }}" alt="item image" width="20%">
                                    </td>
                                    <td>{{$item->department->name}}</td>
                                    <td>{{$item->designation}}</td>
                                    <td>{{$item->employee_type}}</td>
                                    <td>{{date('d M, Y', strtotime($item->joint_date))}}</td>
                                    <td>{{$item->phone}}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">Action</button>
                                            <div class="dropdown-menu">
                                                {{-- <a class="dropdown-item" href="">Edit</a> --}}
                                                <a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target=".delete-modal" onclick="handle({{ $item->id }})">Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>  
                        </table>
                        {!! $result->appends(Request::except('_token'))->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.inc.delete-modal')
@endsection

@section('extra_js')
<script>
    //Delete Code
    function handle(id) {
       var url = "{{ route('employee.destroy', 'employee_id') }}".replace('employee_id', id);
        $("#delete-form").attr('action', url);
       $("#confirm-modal").modal('show');
     }
</script>
@endsection