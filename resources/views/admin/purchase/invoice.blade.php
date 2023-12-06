@extends('admin.admin-dashboard')
@section('extra_css')
    <style>
        .print_button{
            width: 100px;
        }
        .invoice-header{

        }

        .party_info{
            color: #ffffff;
        }

        .company_info{
            float: right;
        }
        .company_info .address{
            color: #ffffff;
        }
        .table:not(.table-bordered) thead th {
            font-weight: 800;
            font-size: medium;
        }


        @media print {
            body * {
                visibility: visible !important;
                color:#000 !important;
            }
         
        }
    </style>
@endsection
@section('content')
<div class="content-body" style="min-height: 500px">
    <div class="container-fluid">
        <div class="card mt-3">
            <div class="card-header">
                <h3><strong>{{$purchase->purchase_type}} Invoice</strong></h3>
                <button class="btn btn-primary print_hidden print_button" onclick="print_receipt('print-area')">
                    <i class="fa fa-print"></i>
                    Print
                </button>
            </div>
            <div id="print-area" class="card-body print">
                <div class="invoice-header">
                    <div class="row mb-5">
                        <div class="mt-4 col-xl-6 col-lg-6 col-md-6 col-sm-6">
                            <div class="party_info">
                                <div class="name"><strong>Invoice No: {{$purchase->id}}</strong></div>
                                <div class="name"><strong>Party Name: {{$purchase->party->party_name}}</strong></div>
                                <div class="phone_no"><strong>Phone Number: {{$purchase->party->phone}}</strong></div>
                                <div class="sale_date"><strong>Purchase Date: {{date('d M, Y', strtotime($purchase->purchase_date))}}</strong></div>
                                <div class="delivery_date"><strong>Delivery Date: {{date('d M, Y', strtotime($purchase->delivery_date))}}</strong></div>
                            </div>
                        </div>
                        <div class="mt-4 col-xl-6 col-lg-6 col-md-6 col-sm-6 text-right">
                            <div class="company_info">
                                <div class="company_name">
                                    {{-- <img class="" src="{{asset('asset/images/logo.png')}}" alt="logo" width="250px"> --}}
                                    <h3><strong>New Kanak Hosiery & Garments (N.K)</strong></h3>
                                </div>
                                <div class="address">
                                    <span><strong>Narayanganj 1400, Bangladesh</strong></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="center">#</th>
                                <th>Item Name</th>
                                <th>Item Variation</th>
                                <th class="right">Rate</th>
                                <th class="center">Qty</th>
                                <th class="right">Sub Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($purchase->items as $key => $item)
                                <tr>
                                    <td class="center">{{ ++$key }}</td>
                                    <td class="left strong">{{ $item->items->name }}</td>
                                    <td class="left strong">
                                        @if($item->variation)
                                            {{ $item->variation->name }}
                                        @endif
                                    </td>
                                    <td class="right">BDT {{ $item->rate }}</td>
                                    <td class="center">
                                        @if($item->main_unit_qty){{ $item->main_unit_qty }} {{ $item->items->main_unit->name }}@endif
                                        @if($item->sub_unit_qty) {{ $item->sub_unit_qty }} {{ $item->items->sub_unit?$item->items->sub_unit->name:"" }} @endif
                                    </td>
                                    <td class="right">BDT {{ $item->sub_total }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-sm-4"></div>
                    <div class="col-lg-5 col-sm-6 ms-auto">
                        <table class="table table-clear">
                            <tbody>
                                <tr>
                                    <td class="left"><strong>Total :</strong></td>
                                    <td class="right">BDT {{ number_format($purchase->items->sum('sub_total'),2) }}</td>
                                </tr>
                                <tr>
                                    <td class="left"><strong>Grand Total :</strong></td>
                                    <td class="right">BDT {{ number_format($purchase->payable,2) }}</td>
                                </tr>
                                <tr>
                                    <td class="left"><strong>Total Paid :</strong></td>
                                    <td class="right">BDT {{ number_format($purchase->paid,2) }}</td>
                                </tr>
                                <tr>
                                    <td class="left"><strong>Due :</strong></td>
                                    <td class="right">BDT {{ number_format($purchase->due,2) }}</td>
                                </tr>
                            </tbody>
                        </table>
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
    // clear localstore
    function print_receipt(divName) {
        let printDoc = $('#' + divName).html();
        let originalContents = $('body').html();
        $("body").html(printDoc);
        window.print();
        $('body').html(originalContents);
    }

</script>
@endsection
