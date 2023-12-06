@extends('admin.admin-dashboard')

@section('content')
<div class="content-body" style="min-height: 500px">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Top Purchase Item List</h4>
            </div>
            <div class="row">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                                <tr>
                                    <th class="width80"><strong>#</strong></th>
                                    <th><strong>Itme Type</strong></th>
                                    <th><strong>Item Name</strong></th>
                                    <th><strong>Image</strong></th>
                                    <th><strong>Purchase</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=1; @endphp
                                @foreach ($result as $item)
                                <tr>
                                   <td><strong>{{$i++}}</strong></td>
                                   <td>{{$item->type}}</td>
                                   <td>{{$item->name}}</td>
                                   <td>
                                        <img src="{{ asset($item->image) }}" alt="item image" width="80px">
                                   </td>
                                   <td> {{ $item->readable_qty($item->purchase_count()) }}</td>
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
@endsection
