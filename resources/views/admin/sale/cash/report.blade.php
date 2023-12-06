@extends('admin.admin-dashboard')

@section('content')
<div class="content-body" style="min-height: 500px">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Cash Sales Reports</h4>
            </div>
            <div class="row">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                                <tr>
                                   <th><strong>#</strong></th>
                                    <th><strong>Customer Name</strong></th>
                                   <th><strong>Address</strong></th>
                                   <th><strong>Phone</strong></th>
                                   <th><strong>Sold By</strong></th>
                                   <th><strong>Branch</strong></th>
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
                                @foreach ($sales as $sale)
                                <tr>
                                   <td>{{$sale->sale_id}}</td>
                                   <td>{{ $sale->sale->customer_name}}</td>
                                   <td>{{ $sale->sale->customer_address}}</td>
                                   <td>{{ $sale->sale->phone}}</td>
                                   <td>{{ $sale->sale->sold_by}}</td>
                                    <td>{{ $sale->sale->showroom}}</td>
                                   <td>{{date('d M, Y', strtotime($sale->sale->delivery_date))}}</td>
                                   <td>{{$sale->items->name}}</td>
                                   <td>{{$sale->details}}</td>
                                   <td>{{$sale->items->readable_qty($sale->qty)}}</td>
                                   <td>{{$sale->rate}}</td>
                                   <td>{{$sale->sub_total}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!! $sales->appends(Request::except('_token'))->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

