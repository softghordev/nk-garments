@extends('admin.admin-dashboard')

@section('content')
<div class="content-body">
  <div class="container-fluid">
    <div class="card">
        <div class="card-header">
        <h4 class="card-title">Add Party</h4>
        </div>
        <form action="{{route('party.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <!-- row -->
            <div class="row mt-3">
                <!-- Basic Information -->
                <div class="col-xl-6 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="basic-form">
                                
                                <div class="mb-3 row">
                                    <label class="col-lg-4 col-form-label" for="party_type">Party Type<span class="text-danger">*</span> :</label>
                                    <div class="col-lg-8">
                                        <select name="party_type" id="party_type"  class="form-control input-rounded">
                                            <option value="">Select Party Type</option>
                                            <option value="Purchase Party">Purchase Party</option>
                                            <option value="Sales Party">Sales Party</option>
                                            <option value="Third Party Production">Third Party Production</option>
                                        </select>
                                        @if($errors->has('party_type'))
                                            <span class="invalid-feedback">{{ $errors->first('party_type') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-lg-4 col-form-label" for="party_name">Party Name <span class="text-danger">*</span> :</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="party_name" class="form-control input-rounded" value="{{ old('party_name') }}" id="name" placeholder="Party Name">
                                        @if($errors->has('party_name'))
                                            <span class="invalid-feedback">{{ $errors->first('party_name') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-lg-4 col-form-label" for="company_name">Company Name <span class="text-danger">*</span> :</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="company_name" class="form-control input-rounded" value="{{ old('company_name') }}" id="company_name" placeholder="Company Name">
                                        @if($errors->has('company_name'))
                                            <span class="invalid-feedback">{{ $errors->first('company_name') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-lg-4 col-form-label" for="owner_name">Owner Name <span class="text-danger">*</span> :</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="owner_name" class="form-control input-rounded" value="{{ old('owner_name') }}" id="owner_name" placeholder="Owner Name">
                                        @if($errors->has('owner_name'))
                                            <span class="invalid-feedback">{{ $errors->first('owner_name') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-lg-4 col-form-label" for="current_address">Company Address :</label>
                                    <div class="col-lg-8">
                                        <textarea name="company_address" class="form-file-input form-control" id="company_address" cols="30" rows="2" placeholder="Company Address"> {{ old('company_address') }}</textarea>
                                        @if($errors->has('company_address'))
                                            <span class="invalid-feedback">{{ $errors->first('company_address') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-lg-4 col-form-label" for="email">Email Address :</label>
                                    <div class="col-lg-8">
                                        <input type="email" name="email" class="form-control input-rounded"  value="{{ old('email') }}" id="email" placeholder="Email Address">
                                        @if($errors->has('email'))
                                            <span class="invalid-feedback">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-lg-4 col-form-label" for="web_page">Web Page :</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="web_page" class="form-control input-rounded" value="{{ old('web_page') }}" id="web_page" placeholder="Web Page">
                                        @if($errors->has('web_page'))
                                            <span class="invalid-feedback">{{ $errors->first('web_page') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-lg-4 col-form-label" for="business_phone">Business Phone :</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="business_phone" class="form-control input-rounded" value="{{ old('business_phone') }}" id="business_phone" placeholder="Business Phone">
                                        @if($errors->has('business_phone'))
                                            <span class="invalid-feedback">{{ $errors->first('business_phone') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-lg-4 col-form-label" for="home_phone">Home Phone :</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="home_phone" class="form-control input-rounded" value="{{ old('home_phone') }}" id="home_phone" placeholder="Home Phone">
                                        @if($errors->has('home_phone'))
                                            <span class="invalid-feedback">{{ $errors->first('home_phone') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-lg-4 col-form-label" for="phone">Phone <span class="text-danger">*</span> :</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="phone" class="form-control input-rounded" value="{{ old('phone') }}" id="phone" placeholder="Phone">
                                        @if($errors->has('phone'))
                                            <span class="invalid-feedback">{{ $errors->first('phone') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="basic-form">
                                <div class="mb-3 row">
                                    <label class="col-lg-4 col-form-label" for="country">Country :</label>
                                    <div class="col-lg-8">
                                        <select name="country" id="country"  class="form-control input-rounded">
                                            <option value="Bangladesh">Bangladesh</option>
                                        </select>
                                        @if($errors->has('country'))
                                            <span class="invalid-feedback">{{ $errors->first('country') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-lg-4 col-form-label" for="current_address">Party Bank Details :</label>
                                    <div class="col-lg-8">
                                        <textarea name="party_bank_details" class="form-file-input form-control" id="party_bank_details" cols="30" rows="2" placeholder="Party Bank Details"> {{ old('party_bank_details') }}</textarea>
                                        @if($errors->has('party_bank_details'))
                                            <span class="invalid-feedback">{{ $errors->first('party_bank_details') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-lg-4 col-form-label" for="image">Party Photo :</label>
                                    <div class="col-lg-8">
                                        <div class="holder">
                                            <img id="imgPreview" src="{{ url(asset('asset/placeholder_190x140c.png')) }}" alt="placeholder" class="upload_img "/>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="form-file">
                                                <input type="file" class="form-file-input form-control" name="image"  id="photo">
                                            </div>
                                            <span class="input-group-text search_icon">Upload</span>
                                        </div>
                                    </div>
                                </div>

                                 <div class="mb-3 row">
                                    <label class="col-lg-4 col-form-label" for="registration_date">Date :</label>
                                    <div class="col-lg-8">
                                        <input type="date" name="registration_date" class="form-control input-rounded" value="{{ old('registration_date') }}" id="registration_date" placeholder="registration_date">
                                        @if($errors->has('registration_date'))
                                            <span class="invalid-feedback">{{ $errors->first('registration_date') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-lg-4 col-form-label" for="current_address">Note :</label>
                                    <div class="col-lg-8">
                                        <textarea name="note" class="form-file-input form-control" id="note" cols="30" rows="2" placeholder="Note"> {{ old('note') }}</textarea>
                                        @if($errors->has('note'))
                                            <span class="invalid-feedback">{{ $errors->first('note') }}</span>
                                        @endif
                                    </div>
                                </div>
                            
                            </div>
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

@endsection
