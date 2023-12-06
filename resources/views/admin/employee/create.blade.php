@extends('admin.admin-dashboard')

@section('content')
<div class="content-body">
  <div class="container-fluid">
    <div class="card">
        <div class="card-header">
        <h4 class="card-title">Add Employee</h4>
        </div>
        <form action="{{route('employee.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <!-- row -->
            <div class="row mt-3">
                <!-- Basic Information -->
                <div class="col-xl-6 col-lg-6">
                    <div class="card">
                        <div class="card-header bg-success">
                            <h4 class="card-title">Basic Information</h4>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">

                                <div class="mb-3 row">
                                    <label class="col-lg-4 col-form-label" for="name">Employee Name <span class="text-danger">*</span> :</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="employee_name" class="form-control input-rounded" value="{{ old('employee_name') }}" id="name" placeholder="Employee Name">
                                        @if($errors->has('employee_name'))
                                            <span class="invalid-feedback">{{ $errors->first('employee_name') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-lg-4 col-form-label" for="department_id">Department <span class="text-danger">*</span> :</label>
                                    <div class="col-lg-8">
                                        <select name="department_id" id="department_id"  class="form-control input-rounded">
                                            <option value="">Select Department</option>
                                            @foreach($departments as $department)
                                                <option value="{{$department->id}}">{{$department->name}}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('department_id'))
                                            <span class="invalid-feedback">{{ $errors->first('department_id') }}</span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="mb-3 row">
                                    <label class="col-lg-4 col-form-label" for="designation">Designation<span class="text-danger">*</span> :</label>
                                    <div class="col-lg-8">
                                        <select name="designation" id="designation"  class="form-control input-rounded">
                                            <option value="">Select Staff</option>
                                            <option value="Staff">Staff</option>
                                            <option value="Operator">Operator</option>
                                        </select>
                                        @if($errors->has('designation'))
                                            <span class="invalid-feedback">{{ $errors->first('designation') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-lg-4 col-form-label" for="employee_type">Employee Type <span class="text-danger">*</span> :</label>
                                    <div class="col-lg-8">
                                        <select name="employee_type" id="employee_type"  class="form-control input-rounded">
                                            <option value="">Employee Type</option>
                                            <option value="Salary">Salary</option>
                                            <option value="Production">Production</option>
                                        </select>
                                        @if($errors->has('employee_type'))
                                            <span class="invalid-feedback">{{ $errors->first('employee_type') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-lg-4 col-form-label" for="name">Join Date <span class="text-danger">*</span> :</label>
                                    <div class="col-lg-8">
                                        <input type="date" name="join_date" class="form-control input-rounded" value="{{ old('join_date') }}" id="join_date">
                                        @if($errors->has('join_date'))
                                            <span class="invalid-feedback">{{ $errors->first('join_date') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-lg-4 col-form-label" for="phone">Mobile Number <span class="text-danger">*</span> :</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="phone" class="form-control input-rounded" value="{{ old('phone') }}" id="phone" placeholder="Mobile Number">
                                        @if($errors->has('phone'))
                                            <span class="invalid-feedback">{{ $errors->first('phone') }}</span>
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
                                    <label class="col-lg-4 col-form-label" for="email">Photo :</label>
                                    <div class="col-lg-8">
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
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-lg-4 col-form-label" for="current_address">Current Address <span class="text-danger">*</span> :</label>
                                    <div class="col-lg-8">
                                        <textarea name="current_address" class="form-file-input form-control" id="current_address" cols="30" rows="3" placeholder="Current Address"> {{ old('current_address') }}</textarea>
                                        @if($errors->has('current_address'))
                                            <span class="invalid-feedback">{{ $errors->first('current_address') }}</span>
                                        @endif
                                    </div>
                                </div>
    
                                <div class="mb-3 row">
                                    <label class="col-lg-4 col-form-label" for="note">Note :</label>
                                    <div class="col-lg-8">
                                        <textarea name="note" class="form-file-input form-control" id="note" cols="30" rows="3" placeholder="Note">
                                            {{ old('note') }}
                                        </textarea>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- Personal Information -->
                <div class="col-xl-6 col-lg-6">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h4 class="card-title">Personal Information</h4>
                        </div>

                        <div class="card-body">
                            <div class="basic-form">

                                <div class="mb-3 row">
                                    <label class="col-lg-4 col-form-label" for="fathers_name">Fathers Name <span class="text-danger">*</span> :</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="fathers_name" class="form-control input-rounded" value="{{ old('fathers_name') }}" id="fathers_name" placeholder="Fathers Name">
                                        @if($errors->has('fathers_name'))
                                            <span class="invalid-feedback">{{ $errors->first('fathers_name') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-lg-4 col-form-label" for="mothers_name">Mothers Name <span class="text-danger">*</span> :</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="mothers_name" class="form-control input-rounded" value="{{ old('mothers_name') }}"  id="mothers_name" placeholder="Mothers Name">
                                        @if($errors->has('mothers_name'))
                                            <span class="invalid-feedback">{{ $errors->first('mothers_name') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-lg-4 col-form-label" for="spouse_name">Spouse Name :</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="spouse_name" class="form-control input-rounded" value="{{ old('spouse_name') }}" id="spouse_name" placeholder="Spouse Name">
                                        @if($errors->has('spouse_name'))
                                            <span class="invalid-feedback">{{ $errors->first('spouse_name') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-lg-4 col-form-label" for="name">Date Of Birth<span class="text-danger">*</span> :</label>
                                    <div class="col-lg-8">
                                        <input type="date" name="date_of_birth" class="form-control input-rounded" value="{{ old('date_of_birth') }}" id="date_of_birth">
                                        @if($errors->has('date_of_birth'))
                                            <span class="invalid-feedback">{{ $errors->first('date_of_birth') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-lg-4 col-form-label" for="nid">NID :</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="nid" class="form-control input-rounded" value="{{ old('nid') }}" id="nid" placeholder="NID">
                                        @if($errors->has('nid'))
                                            <span class="invalid-feedback">{{ $errors->first('nid') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-lg-4 col-form-label" for="blood_group">Blood Group :</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="blood_group" class="form-control input-rounded" value="{{ old('blood_group') }}" id="blood_group" placeholder="Blood Group">
                                        @if($errors->has('blood_group'))
                                            <span class="invalid-feedback">{{ $errors->first('blood_group') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-lg-4 col-form-label" for="permanent_address">Permanent Address <span class="text-danger">*</span> :</label>
                                    <div class="col-lg-8">
                                        <textarea name="permanent_address" class="form-file-input form-control" id="permanent_address" cols="30" rows="3" placeholder="Permanent Address">{{ old('permanent_address') }}</textarea>
                                        @if($errors->has('permanent_address'))
                                            <span class="invalid-feedback">{{ $errors->first('permanent_address') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-lg-4 col-form-label" for="emergency_contact">Emergency Contact :</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="emergency_contact" class="form-control input-rounded" value="{{ old('emergency_contact') }}" id="emergency_contact" placeholder="Emergency Contact">
                                        @if($errors->has('emergency_contact'))
                                            <span class="invalid-feedback">{{ $errors->first('emergency_contact') }}</span>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- row -->
            <div class="row mt-3">
                <!-- Educational and Training Information -->
                <div class="col-xl-6 col-lg-6">
                    <div class="card">
                        <div class="card-header bg-success">
                            <h4 class="card-title">Educational and Training Information</h4>
                        </div>

                        <div class="card-body">
                            <div class="basic-form">

                                <div class="mb-3 row">
                                    <label class="col-lg-4 col-form-label" for="educational_qualification">Educational Qualification <span class="text-danger">*</span> :</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="educational_qualification" value="{{ old('educational_qualification') }}" class="form-control input-rounded" id="educational_qualification" placeholder="Educational Qualification">
                                        @if($errors->has('educational_qualification'))
                                            <span class="invalid-feedback">{{ $errors->first('educational_qualification') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-lg-4 col-form-label" for="educational_details">Educational Details :</label>
                                    <div class="col-lg-8">
                                        <textarea name="educational_details" class="form-file-input form-control" id="educational_details" cols="30" rows="2" placeholder="Educational Details">{{ old('educational_details') }}</textarea>
                                        @if($errors->has('educational_details'))
                                            <span class="invalid-feedback">{{ $errors->first('educational_details') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-lg-4 col-form-label" for="training">Training :</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="training" class="form-control input-rounded" value="{{ old('training') }}" id="training" placeholder="Training">
                                        @if($errors->has('training'))
                                            <span class="invalid-feedback">{{ $errors->first('training') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-lg-4 col-form-label" for="experience">Experience :</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="experience" class="form-control input-rounded" value="{{ old('experience') }}" id="experience" placeholder="Experience">
                                        @if($errors->has('experience'))
                                            <span class="invalid-feedback">{{ $errors->first('experience') }}</span>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- Salary and Other Information -->
                <div class="col-xl-6 col-lg-6">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h4 class="card-title">Salary and Other Information</h4>
                        </div>

                        <div class="card-body">
                            <div class="basic-form">
                                
                                <div class="mb-3 row">
                                    <label class="col-lg-4 col-form-label" for="basic_salary">Basic Salary <span class="text-danger">*</span> :</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="basic_salary" class="form-control input-rounded" value="{{ old('basic_salary') }}" id="basic_salary" placeholder="Basic Salary">
                                        @if($errors->has('basic_salary'))
                                            <span class="invalid-feedback">{{ $errors->first('basic_salary') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-lg-4 col-form-label" for="house_rent">House Rent:</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="house_rent" class="form-control input-rounded" value="{{ old('house_rent') }}" id="house_rent" placeholder="House Rent">
                                        @if($errors->has('house_rent'))
                                            <span class="invalid-feedback">{{ $errors->first('house_rent') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-lg-4 col-form-label" for="medical_allowance">Medical Allowance :</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="medical_allowance" class="form-control input-rounded" value="{{ old('medical_allowance') }}" id="medical_allowance" placeholder="Medical Allowance">
                                        @if($errors->has('medical_allowance'))
                                            <span class="invalid-feedback">{{ $errors->first('medical_allowance') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-lg-4 col-form-label" for="child_allowance">Child Allowance :</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="child_allowance" class="form-control input-rounded" value="{{ old('child_allowance') }}" id="child_allowance" placeholder="Child Allowance">
                                        @if($errors->has('child_allowance'))
                                            <span class="invalid-feedback">{{ $errors->first('child_allowance') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-lg-4 col-form-label" for="communication_allowance">Communication Allowance :</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="communication_allowance" class="form-control input-rounded" value="{{ old('communication_allowance') }}" id="communication_allowance" placeholder="Communication Allowance">
                                        @if($errors->has('communication_allowance'))
                                            <span class="invalid-feedback">{{ $errors->first('communication_allowance') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-lg-4 col-form-label" for="special_allowance">Special Allowance <span class="text-danger">*</span> :</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="special_allowance" class="form-control input-rounded" value="{{ old('special_allowance') }}" id="special_allowance" placeholder="Special Allowance">
                                        @if($errors->has('special_allowance'))
                                            <span class="invalid-feedback">{{ $errors->first('special_allowance') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-lg-4 col-form-label" for="lta">LTA :</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="lta" class="form-control input-rounded" value="{{ old('lta') }}" id="lta" placeholder="LTA">
                                        @if($errors->has('lta'))
                                            <span class="invalid-feedback">{{ $errors->first('lta') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-lg-4 col-form-label" for="bonus">Bonus :</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="bonus" class="form-control input-rounded" value="{{ old('bonus') }}" id="bonus" placeholder="Bonus">
                                        @if($errors->has('bonus'))
                                            <span class="invalid-feedback">{{ $errors->first('bonus') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-lg-4 col-form-label" for="total_salary">Total Salary <span class="text-danger">*</span> :</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="total_salary" class="form-control input-rounded" value="{{ old('total_salary') }}" id="total_salary" placeholder="Total Salary">
                                        @if($errors->has('total_salary'))
                                            <span class="invalid-feedback">{{ $errors->first('total_salary') }}</span>
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
