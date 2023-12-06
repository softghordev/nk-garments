@extends('admin.admin-dashboard')

@section('content')
<div class="content-body" style="min-height: 500px">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Party Purchase Reports</h4>
            </div>
            <div class="row">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                                <tr>
                                   <th><strong>#</strong></th>
                                   <th><strong>Party Name</strong></th>
                                   <th><strong>Department</strong></th>
                                   <th><strong>Purchase Date</strong></th>
                                   <th><strong>Delivery Date</strong></th>
                                    <th><strong>Items</strong></th>
                                   <th style="width:20%"><strong>Details</strong></th>
                                   <th><strong>Quantity</strong></th>
                                   <th><strong>Price</strong></th>
                                    <th><strong>Total Price</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=1; @endphp
                                @foreach ($purchases as $purchase)
                                <tr>
                                   <td>{{$purchase->purchase->id}}</td>
                                   <td>{{ $purchase->purchase->party->party_name}}</td>
                                   <td>{{ $purchase->purchase->department->name}}</td>
                                   <td>{{date('d M, Y', strtotime($purchase->purchase->purchase_date))}}</td>
                                   <td>{{date('d M, Y', strtotime($purchase->purchase->delivery_date))}}</td>
                                   <td>{{$purchase->items->name}}</td>
                                   <td>{{$purchase->details}}</td>
                                   <td>{{$purchase->items->readable_qty($purchase->qty)}}</td>
                                   <td>{{$purchase->rate}}</td>
                                   <td>{{$purchase->sub_total}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!! $purchases->appends(Request::except('_token'))->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

