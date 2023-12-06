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
            max-width: 48%;
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

        #addrow{
            display: none;
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
            <h4 class="card-title">Create Wastage Sale</h4>
        </div>
        <div class="basic-form">
            <form method="POST" action="{{ route('wastage-sale.store') }}">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Customer Name<span class="text-danger">*</span> :</label>
                            <div class="col-sm-9">
                                <input class="form-control form-control-sm" type="text" name="customer_name" />
                                @if($errors->has('customer_name'))
                                    <span class="invalid-feedback">{{ $errors->first('customer_name') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Showroom :</label>
                            <div class="col-sm-9">
                                <select name="showroom" id="" class="form-control form-control-sm">
                                    <option value="">Select Showroom</option>
                                    @foreach($showrooms as $showroom)
                                    <option value="{{$showroom->name}}">{{$showroom->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Address</label>
                            <div class="col-sm-9">
                                <textarea name="customer_address" id="" cols="60" rows="1" class="form-control form-control-sm"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Delivery Date<span class="text-danger">*</span> :</label>
                            <div class="col-sm-9">
                                <div id="datepicker2" class="input-group date" data-date-format="yyyy-mm-dd">
                                    <input class="form-control form-control-sm" type="text" readonly
                                        name="delivery_date" style="width: 100%" />
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
                            <label class="col-sm-3 col-form-label">Phone :</label>
                            <div class="col-sm-9">
                                <input class="form-control form-control-sm" type="text" name="phone" />
                                @if($errors->has('phone'))
                                    <span class="invalid-feedback">{{ $errors->first('phone') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Delivery To :</label>
                            <div class="col-sm-9">
                                <textarea name="delivery_to" id="" cols="60" rows="1" class="form-control form-control-sm"></textarea>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-6">
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Sale Date<span class="text-danger">*</span> :</label>
                            <div class="col-sm-9">
                                <div id="datepicker" class="input-group date" data-date-format="yyyy-mm-dd">
                                    <input class="form-control form-control-sm" type="text" readonly
                                        name="sale_date" />
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
                            <label class="col-sm-3 col-form-label">Sold By<span class="text-danger">*</span> :</label>
                            <div class="col-sm-9">
                                <select name="sold_by" id="" class="form-control form-control-sm">
                                    <option value="">Select Sold By</option>
                                    @foreach($employees as $employee)
                                    <option value="{{$employee->employee_name}}">{{$employee->employee_name}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('sold_by'))
                                    <span class="invalid-feedback">{{ $errors->first('sold_by') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-6">
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Note :</label>
                            <div class="col-sm-9">
                                <textarea name="note" id="" cols="60" rows="1" class="form-control form-control-sm"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <button type="button" class="btn btn-primary mb-2" id="addrow">Add</button>
                        <div class="table-responsive">
                            <table class="table table-responsive-md mytable">
                                <thead>
                                    <tr>
                                        <th style="width: 10%"><strong>Item</strong></th>
                                        <th><strong>Item Details</strong></th>
                                        <th><strong>Stock</strong></th>
                                        <th><strong>Variation</strong></th>
                                        <th style="width: 25%"><strong>Qty</strong></th>
                                        <th style="width:10%"><strong>Rate</strong></th>
                                        <th style="width:10%"><strong>Commission</strong></th>
                                        <th style="width: 10%"><strong>Sub Total</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <select name="new_item[]" id="select2-dropdown" class="item-select">
                                                <option value="">Select Item</option>
                                                @foreach ($item as $val)
                                                    <option value="{{ $val->id }}" data-stock="{{$val->readable_qty($val->stock())}}" data-details="{{ "Name: " . $val->name . ", Type: " . $val->type}}" data-mainunit-name="{{ $val->main_unit->name }}" data-subunit-name="{{ $val->sub_unit_name->name }}" data-subunit-related="{{ $val->unit_related_by->related_by }}" data-price="{{ $val->unit_price }}">{{ $val->name }}</option>
                                                @endforeach
                                            </select>
                                            
                                        </td>
                                        <td>
                                            <textarea name="item_details[]" id="item_details" cols="60" rows="1" class="form-control form-control-sm item-details"></textarea>
                                        </td>
                                        <td>
                                             <input type="text" id="stock" class="form-control form-control-sm stock" readonly>
                                        </td>
                                        <td>
                                            <select class="form-control form-control-sm variation" name="item_variation_id[]">
                                                <option value="">Select</option>
                                            </select>
                                        </td>

                                        <td>
                                            <div class="quantity">
                                                <div class="main_unit">
                                                   <label class="main_unit_name"></label>
                                                    <input type="number" name="main_unit_qty[]" id="main_unit_qty" class="form-control form-control-sm main_unit_qty">
                                                </div>
                                                <div class="sub_unit">
                                                    <label class="sub_unit_name"></label>
                                                    <input type="text" name="sub_unit_qty[]" id="sub_unit_qty" class="form-control form-control-sm sub_unit_qty">
                                                    <input type="hidden" class="related_by" name="related_by[]" value="">
                                                </div>   
                                            </div>
                                        </td>
                                        <td>
                                            <input type="number" name="rate[]" id="rate" class="form-control form-control-sm rate">
                                        </td>
                                        <td>
                                            <input type="number" name="commission[]" id="commission" class="form-control form-control-sm commission">
                                        </td>
                                        <td>
                                            <input type="number" name="sub_total[]" id="sub_total" class="form-control form-control-sm sub_total" readonly>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="table-responsive">
                                <table class="table table-responsive-md">
                                    <thead>
                                        <tr style="width: 100%">
                                            <th class="text-end" style="width: 70%;font-size: 15px">Total Invoice Amount :</th>
                                            <th>
                                                <input type="text" name="receivable" id="input_receivable" class="form-control form-control-sm" readonly>
                                            </th>
                                        </tr>

                                        <tr style="width: 100%">
                                            <th class="text-end" style="width: 70%;font-size: 15px">Discount Amount :</th>
                                            <th>
                                                <input type="text" name="total_discount" id="input_discount" class="form-control form-control-sm">
                                            </th>
                                        </tr>

                                        <tr style="width: 100%">
                                            <th class="text-end" style="width: 70%;font-size: 15px">Total Commission :</th>
                                            <th>
                                                <input type="text" name="total_commission" id="input_commission" class="form-control form-control-sm" readonly>
                                            </th>
                                        </tr>

                                        <tr style="width: 100%">
                                            <th class="text-end" style="width: 70%;font-size: 15px">Paid Amount <span class="text-danger">*</span>:</th>
                                            <th>
                                                <input type="text" name="pay_amount" id="pay_amount" class="form-control form-control-sm" readonly>
                                            </th>
                                        </tr>

                                        <tr style="width: 100%">
                                            <th class="text-end" style="width: 70%;font-size: 15px">Bank Account :</th>
                                            <th>
                                                <select name="bank_account_id" id="bank_account_id" class="form-control">
                                                    @foreach ($bank_accounts as $bank)
                                                    <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                                                    @endforeach
                                                </select>
                                            </th>
                                        </tr>

                                    </thead>
                                </table>
                            </div>
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
        
   @include('admin.sale.scripts')
    
@endsection
