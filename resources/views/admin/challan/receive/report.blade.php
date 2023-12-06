@extends('admin.admin-dashboard')

@section('content')
<div class="content-body" style="min-height: 500px">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Receive Challan Reports</h4>
            </div>
            <div class="row">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                                <tr>
                                   <th><strong>Challan No</strong></th>
                                   <th><strong>Purchase Invoice No.</strong></th>
                                   <th><strong>Purchase Date</strong></th>
                                   <th><strong>Delivery Date</strong></th>
                                   <th><strong>Department</strong></th>
                                   <th><strong>Order By</strong></th>
                                   <th><strong>Received By</strong></th>
                                   <th><strong>Items</strong></th>
                                   <th style="width:20%"><strong>Details</strong></th>
                                   <th><strong>Quantity</strong></th>
                                   <th><strong>Total Packages</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($challans as $challan)
                                <tr>
                                   <td>{{$challan->receive_challan_id}}</td>
                                   <td>{{ $challan->challan->purchase_id}}</td>
                                   <td>{{date('d M, Y', strtotime($challan->challan->purchase_date))}}</td>
                                   <td>{{date('d M, Y', strtotime($challan->challan->delivery_date))}}</td>
                                   <td>{{$challan->challan->department}}</td>
                                   <td>{{ $challan->challan->order_by}}</td>
                                   <td>{{ $challan->challan->receive_by}}</td>
                                   <td>{{$challan->items->name}}</td>
                                   <td>{{$challan->details}}</td>
                                   <td>{{$challan->items->readable_qty($challan->qty)}}</td>
                                   <td>{{$challan->total_packages}}</td>
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
@endsection

