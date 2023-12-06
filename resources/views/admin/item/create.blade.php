@extends('admin.admin-dashboard')
@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="card">

            <div class="card-header">
                <h4 class="card-title">Create Iteam</h4>
            </div>

            <div class="basic-form  mt-3">
                <form method="POST" action="{{ route('item.store') }}" enctype="multipart/form-data">
                    @csrf
                
                    <div class="row card-body">
                        <div class="col-6">
                            <div class="">
                                <label class="form-label">Type:</label>
                                <select class="default-select size-2 form-control wide mb-3" name="type">
                                    <option value="Regular">Regular</option>
                                    <option value="Wastase">Wastase</option>
                                </select>
                                @if($errors->has('type'))
                                        <span class="invalid-feedback">{{ $errors->first('type') }}</span>
                                @endif
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Name<span class="text-danger">*</span> :</label>
                                <input type="text" class="form-control input-rounded" placeholder="Name" name="name">
                                @if($errors->has('name'))
                                    <span class="invalid-feedback">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
        
                            <div class="mb-3">
                                <label class="form-label">Weight :</label>
                                <input type="text" class="form-control input-rounded" placeholder="Weight" name="weight">
                                @if($errors->has('weight'))
                                    <span class="invalid-feedback">{{ $errors->first('weight') }}</span>
                                @endif
                            </div>
                         
                            <div class="mb-3">
                                <label class="form-label">Count :</label>
                                <input type="text" class="form-control input-rounded" placeholder="Count" name="count">
                                @if($errors->has('count'))
                                    <span class="invalid-feedback">{{ $errors->first('count') }}</span>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Brand :</label>
                                <select class="default-select size-2 form-control wide mb-3" name="brand">
                                    <option value="">select brand</option>
                                    @foreach ($brand as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('brand'))
                                    <span class="invalid-feedback">{{ $errors->first('brand') }}</span>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Single Dye :</label>
                                <input type="text" class="form-control input-rounded" placeholder="Single Dye" name="single_dye">
                                @if($errors->has('single_dye'))
                                    <span class="invalid-feedback">{{ $errors->first('single_dye') }}</span>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Double Dye :</label>
                                <input type="text" class="form-control input-rounded" placeholder="Double Dye" name="double_dye">
                                @if($errors->has('double_dye'))
                                    <span class="invalid-feedback">{{ $errors->first('double_dye') }}</span>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Wash :</label>
                                <input type="text" class="form-control input-rounded" placeholder="Wash" name="wash">
                                @if($errors->has('wash'))
                                    <span class="invalid-feedback">{{ $errors->first('wash') }}</span>
                                @endif
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Roll :</label>
                                <input type="text" class="form-control input-rounded" placeholder="Roll" name="roll">
                                @if($errors->has('roll'))
                                    <span class="invalid-feedback">{{ $errors->first('roll') }}</span>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Main Unit<span class="text-danger">*</span> :</label>
                                <select name="main_unit_id" id="" class="form-control main_unit">
                                    @foreach ($units as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('main_unit_id'))
                                    <span class="invalid-feedback">{{ $errors->first('main_unit_id') }}</span>
                                @endif
                            </div>
    
                            <div class="mb-3">
                                <label class="form-label">Sub Unit</label>
                                <select name="sub_unit_id" id="" class="form-control sub_unit">
                                    @if($first_unit->related_unit)
                                        <option value="{{ $first_unit->related_unit->id }}">{{ $first_unit->related_unit->name }}</option>
                                    @else
                                        <option value="">No Related Unit Found</option>
                                    @endif
                                </select>
                                @if($errors->has('sub_unit_id'))
                                    <span class="invalid-feedback">{{ $errors->first('sub_unit_id') }}</span>
                                @endif
                            </div>
        
                            <div class="mb-3">
                                <label class="form-label">Finished :</label>
                                <input type="text" class="form-control input-rounded" placeholder="Finished" name="finished">
                                @if($errors->has('finished'))
                                    <span class="invalid-feedback">{{ $errors->first('finished') }}</span>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label class="form-label">GSM :</label>
                                <input type="text" class="form-control input-rounded" placeholder="GSM" name="gsm">
                                @if($errors->has('gsm'))
                                    <span class="invalid-feedback">{{ $errors->first('gsm') }}</span>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Source :</label>
                                <input type="text" class="form-control input-rounded" placeholder="Source" name="source">
                                @if($errors->has('source'))
                                    <span class="invalid-feedback">{{ $errors->first('source') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">               
                                <div class="form-group sizes">
                                    <label for="Sizes">Sizes</label>
                                    @if($errors->has('size'))
                                    <div class="alert alert-danger">{{ $errors->first('size') }}</div>
                                    @endif
                                    <div class="row">
                                        <div class="col-8">
                                            <input type="text" name="size[]" class="form-control">
                                        </div>
                                        <div class="col-1">
                                            <a href="" class="btn btn-danger remove_parent" style="">X</a>
                                        </div>
                                    </div>
                                </div>
    
                                <a href="" class="btn btn-success add_input" style=""><i class="fa fa-plus"> Add Another</i></a>
                                <div class="form-group colors mt-4">
                                    <label for="Colors">Colors</label>
                                    @if($errors->has('color'))
                                    <div class="alert alert-danger">{{ $errors->first('color') }}</div>
                                    @endif
                                    <div class="row">
                                        <div class="col-8">
                                            <input type="text" name="color[]" class="form-control">
                                        </div>
                                        <div class="col-1">
                                            <a href="" class="btn btn-danger remove_parent" style="">X</a>
                                        </div>
                                    </div>
                                </div>
                        
                                <a href="" class="btn btn-success add_color" style=""><i class="fa fa-plus"> Add Another</i></a>
                            </div>
    

                            <div class="mb-3">
                                <label class="form-label">Show Variation :</label>
                                <select class="form-control input-rounded" name="show_variation" id="">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                                @if($errors->has('cone'))
                                    <span class="invalid-feedback">{{ $errors->first('cone') }}</span>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Cone :</label>
                                <input type="text" class="form-control input-rounded" placeholder="Cone" name="cone">
                                @if($errors->has('cone'))
                                    <span class="invalid-feedback">{{ $errors->first('cone') }}</span>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Production Type :</label>
                                <input type="text" class="form-control input-rounded" placeholder="Production Type" name="production_type">
                                @if($errors->has('production_type'))
                                    <span class="invalid-feedback">{{ $errors->first('production_type') }}</span>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label class="form-label">CSP :</label>
                                <input type="text" class="form-control input-rounded" placeholder="CSP" name="csp">
                                @if($errors->has('csp'))
                                    <span class="invalid-feedback">{{ $errors->first('csp') }}</span>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Twist :</label>
                                <input type="text" class="form-control input-rounded" placeholder="twist" name="twist">
                                @if($errors->has('twist'))
                                    <span class="invalid-feedback">{{ $errors->first('twist') }}</span>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Item Image</label>
                                <div class="holder">
                                    <img id="imgPreview" src="{{ url(asset('asset/placeholder_190x140c.png')) }}" alt="placeholder" class="upload_img "/>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="form-file">
                                        <input type="file" class="form-file-input form-control" name="image"   id="photo">
                                    </div>
                                    <span class="input-group-text search_icon">Upload</span>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Unit Price<span class="text-danger">*</span> :</label>
                                <input type="text" class="form-control input-rounded" placeholder="Unit Price" name="unit_price">
                                @if($errors->has('unit_price'))
                                    <span class="invalid-feedback">{{ $errors->first('unit_price') }}</span>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Unit Price For Salary<span class="text-danger">*</span> :</label>
                                <input type="text" class="form-control input-rounded" placeholder="Unit Price For Salary" name="unit_price_for_salary">
                                @if($errors->has('unit_price_for_salary'))
                                    <span class="invalid-feedback">{{ $errors->first('unit_price_for_salary') }}</span>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Note</label>
                                <textarea name="note" id="" cols="30" rows="7" class="form-control"`></textarea>
                                @if($errors->has('note'))
                                    <span class="invalid-feedback">{{ $errors->first('note') }}</span>
                                @endif
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
</div>


@endsection

@section('extra_css')
<style>
    .holder {
        height: 150px;
        width: 200px;
        border: 2px solid rgb(255, 251, 251);
    }
    .upload_img {
        max-width: 190px;
        max-height: 140px;
        min-width: 190px;
        min-height: 140px;
    }
    /* input[type="file"] {
        margin-top: 5px;
    } */
    .heading {
        font-family: Montserrat;
        font-size: 45px;
        color: green;
    }

    .sizes .row,
    .colors .row {
        margin-top: 7px;
    }

    a.add_input,a.add_color {
        font-size: 11px;
        padding: 8px 7px;
    }
</style>
@endsection

@section('extra_js')
<script>
$(document).ready(()=>{
      $('#photo').change(function(){
        const file = this.files[0];
        console.log(file);
        if (file){
          let reader = new FileReader();
          reader.onload = function(event){
            console.log(event.target.result);
            $('#imgPreview').attr('src', event.target.result);
          }
          reader.readAsDataURL(file);
        }
      });
    });
</script>

 <script>
        $('.main_unit').change(function(){
            $('.sub_unit').html('<option value="">No Related Unit Found</option>');
            var main_unit_id=$(this).find(':selected').val();
            var main_unit_text=$(this).find(':selected').text();

            let url = "{{ route('unit.get_related', 'my_id') }}".replace('my_id', main_unit_id);;
            $.ajax({
                url: url,
                method: 'GET',
                success: function (data) {
                    if(data){
                        var sub_value='<option value="">Select Unit</option><option value="'+data.id+'">'+data.name+'</option>';
                        $('.sub_unit').html(sub_value);
                    }else{
                        $('.sub_unit').html('<option value="">No Related Unit Found</option>');
                        // opening Stock
                    }
                }
            });
        });

        $('.sub_unit').change(function(){
            var sub_unit_id=$(this).find(':selected').val();
            var sub_unit_text=$(this).find(':selected').text();

            var main_unit_id=$('.main_unit').find(':selected').val();
            var main_unit_text=$('.main_unit').find(':selected').text();
        });
    </script>

    <script>
        $(".add_input").click(function(event){
            // alert("hello");
            event.preventDefault();
            $(".sizes").append(`<div class="row">
                  <div class="col-8">
                      <input type="text" name="size[]" class="form-control">
                  </div>
                  <div class="col-1">
                      <a href="" class="btn btn-danger remove_parent" style="">X</a>
                  </div>
                </div>`);
        });

        $(".add_color").click(function(event){
            // alert("hello");
            event.preventDefault();
            $(".colors").append(`<div class="row">
                  <div class="col-8">
                    <input type="text" name="color[]" class="form-control">
                  </div>
                  <div class="col-1">
                      <a href="" class="btn btn-danger remove_parent" style="">X</a>
                  </div>
                </div>`);
        });

        $(document).on('click', '.remove_parent',function(){
            event.preventDefault();
            $(this).parent().parent().remove();
        });
    </script>


@endsection
