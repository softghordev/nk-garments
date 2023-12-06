@extends('admin.admin-dashboard')

@section('content')
<div class="content-body" style="min-height: 500px">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Party Sales Reports</h4>
            </div>
            <div class="row">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                                <tr>
                                   <th><strong>#</strong></th>
                                   <th><strong>Sale Type</strong></th>
                                   <th><strong>Party Name</strong></th>
                                   <th><strong>Sale Date</strong></th>
                                   <th><strong>Ordered By</strong></th>
                                   <th><strong>Delivery Date</strong></th>
                                   <th><strong>Delivery To</strong></th>
                                   <th><strong>Sold By</strong></th>
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
                                   <td>{{$sale->party_sale_id}}</td>
                                   <td>{{ $sale->sale->sale_type}}</td>
                                   <td>{{ $sale->sale->party?$sale->sale->party->party_name:''}}</td>
                                   <td>{{date('d M, Y', strtotime($sale->sale->sale_date))}}</td>
                                   <td>{{ $sale->order_by}}</td>
                                   <td>{{date('d M, Y', strtotime($sale->sale->delivery_date))}}</td>
                                   <td>{{$sale->sale->delivery_to}}</td>
                                   <td>{{$sale->sale->sold_by}}</td>
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

