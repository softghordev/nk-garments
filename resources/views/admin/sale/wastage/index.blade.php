@extends('admin.admin-dashboard')
@section('extra_css')
<link href="{{asset('asset/vendor/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">
<style>
      @media print {
            body * {
                visibility: visible !important;
                color:#000 !important;
            }

            h4.card-title{
                color:#000 !important;   
            }
            .print_hidden{
                display: none !important;
            }
        }
</style>
@endsection
@section('content')
<div class="content-body" style="min-height: 500px">
    <div class="container-fluid">
        <div class="card">
            <form action="#" method="">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label"><strong>Customer Name</strong></label>
                                <input class="form-control" type="text" name="customer_name" autocomplete="off" value="{{ request('customer_name') }}" />
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label"><strong>Sale Date</strong></label>
                                <input class="form-control input-daterange-datepicker" type="text" name="sale_date" autocomplete="off" value="{{ request('sale_date') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label"><strong>Delivery Date</strong></label>
                                <input class="form-control input-daterange-datepicker" type="text" name="delivery_date" autocomplete="off" value="{{ request('delivery_date') }}">
                            </div>
                        </div> 
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label"><strong>Showroom</strong></label>
                                <select name="showroom" id="" class="form-control">
                                    <option value="">Select Showroom</option>
                                    @foreach($showrooms as $showroom)
                                    <option value="{{$showroom->name}}" {{ request('showroom')==$showroom->name?'SELECTED':'' }}>{{$showroom->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label"><strong>Sold By</strong></label>
                                <select name="sold_by" id="" class="form-control">
                                    <option value="">Select Sold By</option>
                                    @foreach($employees as $employee)
                                    <option value="{{$employee->employee_name}}" {{ request('sold_by')==$employee->employee_name?'SELECTED':'' }}>{{$employee->employee_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> 
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label"><strong>Order By</strong></label>
                                <select name="order_by" id="" class="form-control">
                                    <option value="">Select Order By</option>
                                    @foreach($employees as $employee)
                                    <option value="{{$employee->employee_name}}" {{ request('order_by')==$employee->employee_name?'SELECTED':'' }}>{{$employee->employee_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> 
                    </div>
                    <div class="row text-end">
                          <div class="col-md-12">
                            <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-search"></i> Filter</button>
                            <a href="{{ request()->url() }}" class="btn btn-warning btn-sm"><i class="fa fa-refresh"></i> Reset</a>
                            <button class="btn btn-primary btn-sm print_hidden print_button" onclick="print_receipt('print-area')"> 
                            <i class="fa fa-print"></i> Print
                            </button>
                        </div>   
                    </div>
                </div>
            </form>
        </div>
        <div  class="card print" id="print-area">
            <div class="card-header">
                <h4 class="card-title">Wastage Sales List</h4>
            </div>
            <div class="row">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                                <tr>
                                   <th class="width80"><strong>#</strong></th>
                                   <th><strong>Customer Name</strong></th>
                                   <th><strong>Address</strong></th>
                                   <th><strong>Phone</strong></th>
                                   <th><strong>Sold By</strong></th>
                                   <th><strong>Branch</strong></th>
                                   <th><strong>Delivery Date</strong></th>
                                   <th><strong>Total Price</strong></th>
                                   <th><strong>Paid</strong></th>
                                   <th><strong>Due</strong></th>
                                   <th class="print_hidden"><strong>Action</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=1; @endphp
                                @foreach ($sales as $sale)
                                <tr>
                                   <td><strong>{{$sale->id}}</strong></td>
                                   <td>{{ $sale->customer_name}}</td>
                                   <td>{{ $sale->customer_address}}</td>
                                   <td>{{ $sale->phone}}</td>
                                   <td>{{ $sale->sold_by}}</td>
                                    <td>{{ $sale->showroom}}</td>
                                   <td>{{date('d M, Y', strtotime($sale->delivery_date))}}</td>
                                   <td>{{$sale->receivable}}</td>
                                   <td>{{$sale->paid}}</td>
                                   <td>{{$sale->due}}</td>
                                   <td class="print_hidden">
                                       <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">Action</button>
                                            <div class="dropdown-menu">
                                                {{-- <a class="dropdown-item" href="">Edit</a> --}}
                                                <a class="dropdown-item" href="{{ route('wastage-sale.invoice',$sale->id) }}">Invoice</a>
                                                <a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target=".delete-modal" onclick="handle({{ $sale->id }})">Delete</a>
                                            </div>
                                        </div>
                                   </td>
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
@include('admin.inc.delete-modal')
@endsection

@section('extra_js')
<script src="{{asset('asset/vendor/moment/moment.min.js')}}"></script>
<script src="{{asset('asset/vendor/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('asset/js/plugins-init/bs-daterange-picker-init.js')}}"></script>
<script>
    //Delete Code
    function handle(id) {
       var url = "{{ route('wastage-sale.destroy', 'sale_id') }}".replace('sale_id', id);
        $("#delete-form").attr('action', url);
       $("#confirm-modal").modal('show');
    }

    function print_receipt(divName) {
        let printDoc = $('#' + divName).html();
        let originalContents = $('body').html();
        $("body").html(printDoc);
        window.print();
        $('body').html(originalContents);
    }

    //Side Menu Hidden
    // $('#main-wrapper').toggleClass("menu-toggle");
</script>
@endsection
