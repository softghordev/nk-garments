@extends('admin.admin-dashboard')

@section('content')

<div class="content-body" style="min-height: 500px">
    <div class="container-fluid">
        <div class="card-header mb-3">
            <h4 class="card-title">Party Purchase</h4>
        </div>
    @if ($errors->any())
    <div class="row">

        @foreach ($errors->all() as $error)
        <div style="text-align: center" class="col-md-3">
            <ul>
                <li class="alert alert-danger" style="color: #FFF">{{ $error }}</li>
            </ul>
        </div>
        @endforeach
    </div>
    @endif
    <div class="row">
        <div class="col-sm-12">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">Manage Roles</h4>
                    </div>
                </div>
                <div class="iq-card-body">
                    <p>Edit & Update Roles</p>
                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped table-bordered">
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th width="280px">Action</th>
                            </tr>
                            @foreach ($roles as $key => $role)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $role->name }}</td>
                                <td>
                                    <a class="btn btn-info" href="{{ route('roles.show',$role->id) }}">Show</a>
                                    @can('role-edit')
                                    <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Edit</a>
                                    @endcan
                                    @can('role-delete')
                                    {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy',
                                    $role->id],'style'=>'display:inline']) !!}
                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                        </table>


                        {!! $roles->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    @endsection
