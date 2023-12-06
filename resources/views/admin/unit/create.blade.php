@extends('admin.admin-dashboard')

@section('content')
    <div class="content-body" style="min-height: 500px">
        <div class="container-fluid">
            <div class="row">
                <div class="col-5">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Unit</h4>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                <form method="POST" action="{{ route('unit.store') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Name<span class="text-danger">*</span> :</label>
                                            <input type="text" class="form-control input-rounded" name="name" value="{{ old('name') }}" placeholder="e.g. Kg">
                                            @if($errors->has('name'))
                                                <span class="invalid-feedback">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Related To Unit</label>
                                            <select name="related_to_unit_id" id="related_to_unit_id"  class="form-control input-rounded">
                                                <option value="">Select Unit</option>
                                                @foreach ($units as $item)
                                                    <option value="{{ $item->id }}" {{ old("related_to_unit_id")==$item->id?"SELECTED":"" }}>{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('related_to_unit_id'))
                                                <span class="invalid-feedback">{{ $errors->first('related_to_unit_id') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Operator</label>
                                            <select name="related_sign" id="related_sign"  class="form-control input-rounded">
                                                <option value="">Select Operator Sign</option>
                                                <option value="*" {{ old("related_sign")=="*"?"SELECTED":"" }}>(*) Multiply Operator</option>
                                            </select>
                                            @if($errors->has('related_sign'))
                                                <span class="alert alert-danger">{{ $errors->first('related_sign') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Related By Value</label>
                                            <input type="number" class="form-control input-rounded" placeholder="Unit Name" name="related_by" value="{{ old("related_by") }}">
                                            @if($errors->has('related_by'))
                                                <span class="alert alert-danger">{{ $errors->first('related_by') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3 col-md-12">
                                            <h4 class="final_text" style="text-align:center;"></h4>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success">Add</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-7">
                    <div class="card">
                        <div class="card-header">
                                <h4 class="card-title">Units List</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-responsive-md">
                                    <thead>
                                        <tr>
                                            <th class="width80"><strong>#</strong></th>
                                            <th><strong>NAME</strong></th>
                                            <th><strong>Related To</strong></th>
                                            <th><strong>Related Sign</strong></th>
                                            <th><strong>Related By</strong></th>
                                            <th><strong>Result</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i=1; @endphp
                                        @foreach ($result as $item)
                                        <tr>
                                            <td><strong>{{$i++}}</strong></td>
                                            <td>{{$item->name}}</td>
                                            <td>{{ $item->related_unit?$item->related_unit->name:"-" }}</td>
                                            <td>{{ $item->related_sign?$item->related_sign:"-" }}</td>
                                            <td>{{ $item->related_by?$item->related_by:"-" }}</td>
                                            <td>@if($item->related_unit){{ $item->name }} = 1 {{ $item->related_unit?$item->related_unit->name:"-" }} {{ $item->related_sign?$item->related_sign:"-" }} {{ $item->related_by?$item->related_by:"-" }}@endif</td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('extra_js')
   <script>
 
        $('select[name="related_to_unit_id"]').change(function(){
            update_final_text();
        });

        $('select[name="related_sign"]').change(function(){
            update_final_text();
        });

        $('input[name="related_by"]').change(function(){
            update_final_text();
        });

        function update_final_text(){
            // alert("HELLO");
            var string ="1 ";
            string+=$('input[name="name"]').val();
            string+=" = 1";
            string+=$('select[name="related_to_unit_id"]').find(":selected").text();
            string+=" ";
            string+=$('select[name="related_sign"]').find(":selected").val();
            string+=" ";
            string+=$('input[name="related_by"]').val();
            $('.final_text').html(string);
        }
    </script>
@endsection
