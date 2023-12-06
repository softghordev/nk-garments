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

        .table > thead {
            text-align: center;
        }
    </style>
@endsection
@section('content')
<div class="content-body" style="min-height: 500px">
    <div class="container-fluid">
        <div class="card-header mb-3">
            <h4 class="card-title">Add Moving Challan</h4>
        </div>
        <div class="basic-form">
            <form method="POST" action="{{ route('moving-challan.store') }}">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Is Ready For Sale<span class="text-danger">*</span> :</label>
                            <div class="col-sm-9 mt-1">
                                <label class="radio-inline me-3"><input type="radio" value="0" name="for_sale" checked> No</label>
                                <label class="radio-inline me-3"><input type="radio" value="1" name="for_sale"> Yes</label>
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
                            <label class="col-sm-3 col-form-label">Party Name<span class="text-danger">*</span> :</label>
                            <div class="col-sm-9">
                                <select name="party_id" id="" class="form-control form-control-sm" required>
                                    @foreach($parties as $party)
                                    <option value="{{$party->id}}">{{$party->party_name}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('party_id'))
                                    <span class="invalid-feedback">{{ $errors->first('party_id') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Delivery to :</label>
                            <div class="col-sm-9">
                                <select name="delivery_to" id="" class="form-control form-control-sm">
                                    <option value="">Select Department</option>
                                    @foreach($departments as $department)
                                    <option value="{{$department->name}}">{{$department->name}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('delivery_to'))
                                    <span class="invalid-feedback">{{ $errors->first('delivery_to') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Delivery Form :</label>
                            <div class="col-sm-9">
                                <select name="delivery_from" id="" class="form-control form-control-sm">
                                    <option value="">Select Department</option>
                                    @foreach($departments as $department)
                                    <option value="{{$department->name}}">{{$department->name}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('delivery_from'))
                                    <span class="invalid-feedback">{{ $errors->first('delivery_from') }}</span>
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
                            <label class="col-sm-3 col-form-label">Release  By<span class="text-danger">*</span> :</label>
                            <div class="col-sm-9">
                                <select name="release_by" id="" class="form-control form-control-sm">
                                    @foreach($employees as $employee)
                                    <option value="{{$employee->employee_name}}">{{$employee->employee_name}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('release_by'))
                                    <span class="invalid-feedback">{{ $errors->first('release_by') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Receive By<span class="text-danger">*</span> :</label>
                            <div class="col-sm-9">
                                <select name="receive_by" id="" class="form-control form-control-sm">
                                    @foreach($employees as $employee)
                                    <option value="{{$employee->employee_name}}">{{$employee->employee_name}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('receive_by'))
                                    <span class="invalid-feedback">{{ $errors->first('receive_by') }}</span>
                                @endif
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
                            <label class="col-sm-3 col-form-label">Transport Details</label>
                            <div class="col-sm-9">
                                <textarea name="transport_details" id="" cols="60" rows="1" class="form-control form-control-sm"></textarea>
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
                        <button type="button" class="btn btn-primary mb-2" id="addrow">Add</button>
                        <div class="table-responsive">
                            <table class="table table-responsive-md mytable">
                                <thead>
                                    <tr>
                                        <th style="width: 10%"><strong>Item</strong></th>
                                        <th style="width: 20%"><strong>Item Details</strong></th>
                                        <th style="width: 20%"><strong>Qty</strong></th>
                                        <th style="width: 10%"><strong>Total Packages</strong></th>
                                        <th style="width: 15%"><strong>Packaging Details</strong></th>
                                        <th style="width:10%"><strong>Rate</strong></th>
                                        <th style="width: 15%"><strong>Sub Total</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i=1; @endphp

                                    <tr>
                                        <td>
                                            <select name="new_item[]" id="select2-dropdown" class="item-select">
                                                <option value="">Select Item</option>
                                                @foreach ($item as $val)
                                                    <option value="{{ $val->id }}" stock="{{ $val->main_unit_stock }}" data-details="{{ "Name: " . $val->name . ", Type: " . $val->type . ", Size: " . $val->size . ", Color: " . $val->color }}" data-mainunit-name="{{ $val->main_unit->name }}" data-subunit-name="{{ $val->sub_unit_name->name }}" data-subunit-related="{{ $val->unit_related_by->related_by }}" data-price="{{ $val->unit_price }}">{{ $val->name }}</option>
                                                @endforeach
                                            </select>
                                            
                                        </td>
                                        <td>
                                            <textarea name="item_details[]" id="item_details" cols="60" rows="1" class="form-control form-control-sm item-details"></textarea>
                                        </td>

                                        <td>
                                            <div class="quantity">
                                                <div class="main_unit">
                                                   <label class="main_unit_name"></label>
                                                    <input type="number" name="main_unit_qty[]" id="main_unit_qty" class="form-control form-control-sm main_unit_qty">
                                                </div>
                                                <div class="sub_unit">
                                                    <label class="sub_unit_name"></label>
                                                    <input type="number" name="sub_unit_qty[]" id="sub_unit_qty" class="form-control form-control-sm sub_unit_qty">
                                                    <input type="hidden" class="related_by" value="">
                                                </div>   
                                            </div>
                                        </td>
                                        <td>
                                            <input type="number" name="total_packages[]" id="total_packages" class="form-control form-control-sm total_packages">
                                        </td>
                                        <td>
                                            <textarea name="packaging_details[]" id="packaging_details" cols="60" rows="1" class="form-control form-control-sm packaging_details"></textarea>

                                        </td>
                                        <td>
                                            <input type="number" name="rate[]" id="rate" class="form-control form-control-sm rate">
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
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th class="text-end" style="font-size: 18px">GRAND TOTAL :  <strong id="text_payable" style="color: #7e7e7e">0</strong> Tk</th>
                                            <th>
                                                <input type="hidden" name="payable" id="input_payable" class="form-control form-control-sm" readonly>
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
        
   @include('admin.delivery-challan.scripts')
    
@endsection
