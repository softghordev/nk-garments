@extends('admin.admin-dashboard')
@section('extra_css')
    <style>
        .datepicker.datepicker-dropdown th.datepicker-switch,
        .datepicker.datepicker-dropdown th.next,
        .datepicker.datepicker-dropdown th.prev {
            color: #FFFFFF;
        }
        .quantity {
            width: 100%;
            text-align: center;
        }

        .quantity .main_unit {
            width: 48%;
            float: left;
            margin-right: 5px;
        }

        .quantity .sub_unit {
            width: 48%;
            float: left;
            margin-right: 5px;
        }
        
        .main_unit_name,
        .sub_unit_name {
            display: block;
            font-size: 14px;
            margin-bottom: 5px;
        }

        .table > thead {
            text-align: center;
        }
    </style>
@endsection
@section('content')
<div class="content-body" style="min-height: 500px">
    <div class="container-fluid">
        <div class="card-header mb-3">
            <h4 class="card-title">Add Delivery Challan</h4>
        </div>
        <div class="basic-form">
            <form method="POST" action="{{ route('delivery-challan.store') }}">
                @csrf
                <div class="row">
                     <div class="col-6">
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Showroom <span class="text-danger">*</span> :</label>
                            <div class="col-sm-9">
                                <select name="showroom" id="" class="form-control form-control-sm" required>
                                    @foreach($showrooms as $showroom)
                                    <option value="{{$showroom->name}}">{{$showroom->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                
                    <div class="col-6">
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Sale Date :</label>
                            <div class="col-sm-9">
                                <div id="datepicker2" class="input-group date" data-date-format="yyyy-mm-dd">
                                    <input class="form-control form-control-sm" type="text" readonly
                                        name="sale_date" style="width: 100%" />
                                    <span class="input-group-addon">
                                        <i class="glyphicon glyphicon-calendar"></i>
                                    </span>
                                </div>
                                @if($errors->has('sale_date'))
                                    <span class="invalid-feedback">{{ $errors->first('sale_date') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Invoice Number :</label>
                            <div class="col-sm-9">
                                <input class="form-control form-control-sm" type="text" value="{{ $party_sale->id }}" readonly name="party_sale_id" />
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Delivery Address :</label>
                            <div class="col-sm-9">
                                <textarea class="form-control form-control-sm" name="delivery_address" id="" cols="30" rows="1"></textarea>
                                @if($errors->has('delivery_address'))
                                    <span class="invalid-feedback">{{ $errors->first('delivery_address') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Delivery Date<span class="text-danger">*</span> :</label>
                            <div class="col-sm-9">
                                <div id="datepicker" class="input-group date" data-date-format="yyyy-mm-dd">
                                    <input class="form-control form-control-sm" type="text" readonly
                                        name="delivery_date" />
                                    <span class="input-group-addon">
                                        <i class="glyphicon glyphicon-calendar"></i>
                                    </span>
                                </div>
                                @if($errors->has('delivery_date'))
                                    <span class="invalid-feedback">{{ $errors->first('delivery_date') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Dispatched By<span class="text-danger">*</span> :</label>
                            <div class="col-sm-9">
                                <select name="dispatched_by" id="" class="form-control form-control-sm">
                                    @foreach($employees as $employee)
                                    <option value="{{$employee->employee_name}}">{{$employee->employee_name}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('dispatched_by'))
                                    <span class="invalid-feedback">{{ $errors->first('dispatched_by') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Order By<span class="text-danger">*</span> :</label>
                            <div class="col-sm-9">
                                <select name="order_by" id="" class="form-control form-control-sm">
                                    @foreach($employees as $employee)
                                    <option value="{{$employee->employee_name}}">{{$employee->employee_name}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('order_by'))
                                    <span class="invalid-feedback">{{ $errors->first('order_by') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Transport Details</label>
                            <div class="col-sm-9">
                                <textarea name="transport_details" id="" cols="60" rows="1" class="form-control form-control-sm"></textarea>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-6">
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Mode Of Transport</label>
                            <div class="col-sm-9">
                                <textarea name="mode_of_transport" id="" cols="60" rows="1" class="form-control form-control-sm"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Note</label>
                            <div class="col-sm-9">
                                <textarea name="note" id="" cols="60" rows="1" class="form-control form-control-sm"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-responsive-md mytable">
                                <thead>
                                    <tr>
                                        <th style="width: 15%"><strong>Item Name</strong></th>
                                        <th style="width: 15%"><strong>Item Details</strong></th>
                                        <th style="width: 25%"><strong>Qty</strong></th>
                                        <th style="width: 10%"><strong>Total Packages</strong></th>
                                        <th style="width: 10%"><strong>Packaging Details</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($party_sale->items as $key => $item )
                                        
                                    <tr>
                                        <td>
                                           <p>{{ $item->items->name }} @if($item->item_variation_id)- V : {{ $item->variation->name }}@endif</p>
                                            
                                            @if($item->item_variation_id) 
                                            <input name="item_variation_id[]" type="hidden" value="{{$item->item_variation_id}}">
                                            @endif
                                           <input type="hidden" name="new_item[]" value="{{ $item->item_id}}">
                                            <input type="hidden" name="party_sale_item_id[]" value="{{ $item->id}}">
                                        </td>
                                        <td>
                                            <textarea name="item_details[]"  cols="60" rows="1" class="form-control form-control-sm item-details">{{ $item->details }}</textarea>
                                        </td>

                                        <td>
                                            <div class="quantity">
                                                <div class="main_unit">
                                                    <label class="main_unit_name">{{ $item->items->main_unit->name }}</label>
                                                    <input type="text" data-sub_qty="{{ $item->due_main_unit_qty}}" name="main_unit_qty[]" id="main_unit_qty" class="form-control form-control-sm main_unit_qty" value="{{ $item->due_main_unit_qty}}">
                                                </div>
                                                <div class="sub_unit">
                                                    <label class="sub_unit_name">{{ $item->items->sub_unit_name?$item->items->sub_unit_name->name:'' }}</label>
                                                    <input type="text" data-sub_qty="{{ $item->due_sub_unit_qty}}" name="sub_unit_qty[]" id="sub_unit_qty" class="form-control form-control-sm sub_unit_qty" value="{{ $item->due_sub_unit_qty}}">
                                                    <input type="hidden" class="related_by" value="">
                                                </div>
                                                </div>   
                                            </div>
                                        </td>
                                        <td>
                                            <input type="number" name="total_packages[]" id="total_packages" class="form-control form-control-sm total_packages">
                                        </td>
                                        <td>
                                            <textarea name="packaging_details[]" id="packaging_details" cols="60" rows="1" class="form-control form-control-sm packaging_details"></textarea>

                                        </td>
                            
                                    </tr>
                                    @endforeach

                                </tbody>

                                <tfoot>
                                
                                    <tr class="">
                                        <th class="text-end" colspan="2"></th>
                                        <th class="text-center">Total : {{ $party_sale->items->sum('qty') }}</th>
                                        <th><strong></strong></th>
            
                                    </tr>
                                </tfoot>
                            </table>
                          
                        </div>
                    </div>
                     <div class="col-xl-12 col-lg-12 px-5 mb-3">
                        <button class="btn btn-success" type="submit">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('extra_js')
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#select2-dropdown').select2();
        });
    </script>
    <script>
        $(function() {
            $("#datepicker").datepicker({
                autoclose: true,
                todayHighlight: true,
            }).datepicker('update', new Date());
        });
    </script>
    <script>
        $(function() {
            $("#datepicker2").datepicker({
                autoclose: true,
                todayHighlight: true,
            }).datepicker('update', new Date());
        });

    </script>
    <script>

        function empty_field_check(placeholder) {
            if (placeholder == null) {
                placeholder = 0;
            } else if (placeholder.trim() == "") {
                placeholder = 0;
            }
            return placeholder;
        }

       $(document).ready(function () {
            $('.main_unit_qty').on('input', function () {
                let obj = $(this);
                let dataSubQty = obj.data('main_unit');
                let dueSubQtyValue = parseFloat(obj.val());

                // Ensure that the value is at least 1
                if (isNaN(dueSubQtyValue) || dueSubQtyValue < 1) {
                    toastr.warning('The quantity in sub unit cannot be less than 1');
                    obj.val(1);
                } else if (dueSubQtyValue > parseFloat(dataSubQty)) {
                    toastr.warning('The quantity in sub unit cannot exceed');
                    obj.val(dataSubQty);
                }
            });
        });

         $(document).ready(function () {
            $('.sub_unit_qty').on('input', function () {
                let obj = $(this);
                let dataSubQty = obj.data('sub_qty');
                let dueSubQtyValue = parseFloat(obj.val());

                // Ensure that the value is at least 1
                if (isNaN(dueSubQtyValue) || dueSubQtyValue < 1) {
                    toastr.warning('The quantity in sub unit cannot be less than 1');
                    obj.val(1);
                } else if (dueSubQtyValue > parseFloat(dataSubQty)) {
                    toastr.warning('The quantity in sub unit cannot exceed');
                    obj.val(dataSubQty);
                }
            });
        });

        
    </script>
        
    
@endsection
