@extends('admin.admin-dashboard')

@section('content')
<div class="content-body" style="min-height: 500px">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">List of Received Challan</h4>
            </div>
            <div class="row">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                                <tr>
                                   <th><strong>Challan Number</strong></th>
                                   <th><strong>Purchase Invoice No.</strong></th>
                                   <th><strong>Purchased Date</strong></th>
                                   <th><strong>Delivery Date</strong></th>
                                   <th><strong>Department</strong></th>
                                   <th><strong>Order By</strong></th>
                                   <th><strong>Received By</strong></th>
                                   <th><strong>Transport Details</strong></th>
                                   <th><strong>Action</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=1; @endphp
                                @foreach ($challans as $challan)
                                <tr>
                                    <td>{{$challan->id}}</td>
                                    <td>{{ $challan->purchase_id}}</td>
                                    <td>{{date('d M, Y', strtotime($challan->purchase_date))}}</td>
                                    <td>{{date('d M, Y', strtotime($challan->delivery_date))}}</td>
                                    <td>{{$challan->department}}</td>
                                    <td>{{$challan->order_by}}</td>
                                    <td>{{$challan->receive_by}}</td>
                                    <td>{{$challan->transport_details}}</td>
                                   <td>
                                       <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">Action</button>
                                            <div class="dropdown-menu">
                                                 <a class="dropdown-item" href="{{ route('receive-challan.invoice',$challan->id) }}">Invoice</a>
                                                <a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target=".delete-modal" onclick="handle({{ $challan->id }})">Delete</a>
                                            </div>
                                        </div>
                                   </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!! $challans->appends(Request::except('_token'))->links() !!}
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
       var url = "{{ route('receive-challan.destroy', 'challan_id') }}".replace('challan_id', id);
        $("#delete-form").attr('action', url);
       $("#confirm-modal").modal('show');
     }

    //Side Menu Hidden
    // $('#main-wrapper').toggleClass("menu-toggle");
</script>
@endsection
