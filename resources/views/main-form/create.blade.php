@extends('layouts.admin')

@section('title') Create Form @endsection

@section('content')

@push('page_style')

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css">

@endpush

    <!-- Basic multiple Column Form section start -->
    <section id="multiple-column-form">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('user.home')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{route('forms.index')}}">Forms</a>
                            </li>
                            <li class="breadcrumb-item active">Create Form
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <!-- <h4 class="card-title">Create User</h4> -->
                    </div>
                    <div class="card-body">
                        <form method="POST" action="">
                            @csrf
                            <div>
                                    <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="full_name">Ro <span class="text-danger asteric-sign">&#42;</span></label>
                                                    <input id="full_name" type="text" class="form-control {{ $errors->has('ro') ? ' is-invalid' : '' }}" name="ro" value="{{ old('ro') }}" placeholder="Ro">
                                                    @if ($errors->has('ro'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('ro') }}</strong>
                                                        </span>
                                                    @endif
                                            </div>
                                        </div>
                            </div>
                            <!-- Start Customer Name -->
                            <div class="row">
                                <h4 class="card-title customTitle mb-1">Customer Name</h4>
                                {{-- <div class="btn-group mb-1">
                                    <button class="addBtn me-1"><i class="fas fa-plus"></i> Add</button>
                                    <button class="removeBtn"><i class="fas fa-times"></i> Remove</button>
                                </div> --}}
                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="full_name">Full Name <span class="text-danger asteric-sign">&#42;</span></label>
                                            <input id="full_name" type="text" class="form-control {{ $errors->has('full_name') ? ' is-invalid' : '' }}" name="full_name" value="{{ old('full_name') }}" placeholder="Full Name">
                                            @if ($errors->has('full_name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('full_name') }}</strong>
                                                </span>
                                            @endif
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="last_name">Last Name <span class="text-danger asteric-sign">&#42;</span></label>
                                            <input id="last_name" type="text" class="form-control {{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ old('last_name') }}" placeholder="Last Name">
                                            @if ($errors->has('last_name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('last_name') }}</strong>
                                                </span>
                                            @endif
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="email">Email <span class="text-danger asteric-sign"></span></label>
                                            <input id="email" type="text" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email">
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="phone_number">Phone Number <span class="text-danger asteric-sign">&#42;</span></label><br>
                                        <input type="hidden" name="phone_code" id="phone_code" value="{{ old('phone_code') }}"/>
                                        <input type="hidden" name="iso_code" id="iso_code" value="{{ old('iso_code') }}"/>
                                        <input id="phone_number" type="text" class="form-control {{ $errors->has('phone_number') ? ' is-invalid' : '' }}" name="phone_number" value="{{ old('phone_number') }}" placeholder="Phone Number">
                                        @if ($errors->has('phone_number'))
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $errors->first('phone_number') }}</strong>
                                            </span>
                                        @elseif($errors->has('phone_code'))
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $errors->first('phone_code') }}</strong>
                                            </span>
                                        @elseif($errors->has('iso_code'))
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $errors->first('iso_code') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div> 
                                <!-- <div class="col-12">
                                    <button type="Submit" class="btn btn-primary me-1">Submit</button>
                                </div> -->
                            </div>
                            <!-- End Customer Name -->
                            <!-- Start Tracking Information -->
                            <div class="row mt-2">
                                <h4 class="card-title customTitle">Tracking Information</h4>
                                <div class="col-md-12 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="estimator_name">Estimator<span class="text-danger asteric-sign">&#42;</span></label>
                                        <select class="form-control select {{ $errors->has('estimator_name') ? ' is-invalid' : '' }}" id="estimator_name" name="estimator_name">
                                            <option value="">Select Estimator</option>
                                            
                                            @foreach($estimators as $key => $estimator)
                                                <option value="{{ $estimator->id }}" @if(old('estimator_name') == $estimator->id) {{ 'selected' }} @endif>{{ $estimator->name }}</option>
                                            @endforeach
                                            
                                        </select>
                                        {{-- @if ($errors->has('estimator_name')) --}}
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('estimator_name') }}</strong>
                                            </span>
                                        {{-- @endif --}}
                                    </div>
                                </div>
                                {{-- <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="priority">Priority
                                            <span class="text-danger asteric-sign"></span>
                                        </label>
                                        <input id="priority" type="text" class="form-control {{ $errors->has('priority') ? ' is-invalid' : '' }}" name="priority" value="{{ old('priority') }}" placeholder="Priority">
                                        @if ($errors->has('priority'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('priority') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div> --}}
                            </div>
                            <!-- Start Tracking Information -->
                            <!-- Start Vehic Information -->
                            <div class="row mt-2">
                                <h4 class="card-title customTitle">Vehicle</h4>
                                <div class="col-md-4 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="estimator_name">Year :<span class="text-danger asteric-sign">&#42;</span></label>
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6 col-lg-8 mb-2 mb-md-0">
                                                
                                                <input id="year" type="number" class="form-control {{ $errors->has('year') ? ' is-invalid' : '' }}" name="year" value="{{ old('year') }}" placeholder="Year" maxlength="4">
                                                @if ($errors->has('year'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('year') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="mb-1">   
                                    <label class="form-label" for="estimator_name">Make :<span class="text-danger asteric-sign">&#42;</span></label>
                                        <div class="row"> 
                                            <div class="col-sm-6 col-md-6 col-lg-8 mb-2 mb-md-0">
                                            
                                                <input id="make" type="text" class="form-control {{ $errors->has('make') ? ' is-invalid' : '' }}" name="make" value="{{ old('make') }}" placeholder="Make">
                                                @if ($errors->has('make'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('make') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            </div>
                                </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="mb-1">   
                                    <label class="form-label" for="estimator_name">Model:<span class="text-danger asteric-sign">&#42;</span></label>
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6 col-lg-8 mb-2 mb-md-0">
                                            
                                                <input id="model" type="text" class="form-control {{ $errors->has('model') ? ' is-invalid' : '' }}" name="model" value="{{ old('model') }}" placeholder="Model">
                                                @if ($errors->has('model'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('model') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        {{-- <div class="col-sm-6 col-md-7 col-lg-9"> --}}
                                            {{-- <select class="form-control select" id="estimator_name">
                                                <option class="" hidden>Select Estimator</option>
                                                <option>Estimator1</option>
                                                <option>Estimator2</option>
                                                <option>Estimator3</option>
                                            </select> --}}
                                        {{-- </div> --}}
                                       </div>
                                        {{-- @if ($errors->has('estimator_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('estimator_name') }}</strong>
                                            </span>
                                        @endif --}}
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="exterior_color">Exterior Color:<span class="text-danger asteric-sign"></span></label>
                                        <input id="exterior_color" type="text" class="form-control {{ $errors->has('exterior_color') ? ' is-invalid' : '' }}" name="exterior_color" value="{{ old('exterior_color') }}" placeholder="Exterior Color">
                                        @if ($errors->has('exterior_color'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('exterior_color') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                {{-- <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="priority_name">Body Style: <span class="text-danger asteric-sign"></span></label>
                                        <input id="body_style" type="text" class="form-control {{ $errors->has('body_style') ? ' is-invalid' : '' }}" name="body_style" value="{{ old('body_style') }}" placeholder="Body Style">
                                            @if ($errors->has('body_style'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('body_style') }}</strong>
                                                </span>
                                            @endif
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="interior_name">Interior Color:<span class="text-danger asteric-sign"></span></label>
                                        <input id="interior_color" type="text" class="form-control {{ $errors->has('interior_color') ? ' is-invalid' : '' }}" name="interior_color" value="{{ old('interior_color') }}" placeholder="Interior Color">
                                        @if ($errors->has('full_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('interior_color') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="engine">Engine:<span class="text-danger asteric-sign"></span></label>
                                        <input id="engine" type="text" class="form-control {{ $errors->has('engine') ? ' is-invalid' : '' }}" name="engine" value="{{ old('engine') }}" placeholder="Engine">
                                        @if ($errors->has('engine'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('engine') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div> --}}
                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="paint_code">Paint Code:<span class="text-danger asteric-sign"></span></label>
                                        <input id="paint_code" type="text" class="form-control {{ $errors->has('paint_code') ? ' is-invalid' : '' }}" name="paint_code" value="{{ old('paint_code') }}" placeholder="Paint Code">
                                        @if ($errors->has('paint_code'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('paint_code') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="estimator_name">Mileage:<span class="text-danger asteric-sign"></span></label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-1">
                                                    <label class="form-label" for="mileage_in">In:<span class="text-danger asteric-sign"></span></label>
                                                    <input id="mileage_in" type="text" class="form-control {{ $errors->has('mileage_in') ? ' is-invalid' : '' }}" name="mileage_in" value="{{ old('mileage_in') }}" placeholder="In">
                                                    @if ($errors->has('mileage_in'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('mileage_in') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-1">
                                                    <label class="form-label" for="mileage_out">Out:<span class="text-danger asteric-sign"></span></label>
                                                    <input id="mileage_out" type="text" class="form-control {{ $errors->has('mileage_out') ? ' is-invalid' : '' }}" name="mileage_out" value="{{ old('mileage_out') }}" placeholder="Out">
                                                    @if ($errors->has('mileage_out'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('mileage_out') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="trim_code">Trim Code:<span class="text-danger asteric-sign"></span></label>
                                        <input id="trim_code" type="text" class="form-control mt-24 {{ $errors->has('trim_code') ? ' is-invalid' : '' }}" name="trim_code" value="{{ old('trim_code') }}" placeholder="Trim Code" name="trim_code">
                                        @if ($errors->has('trim_code'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('trim_code') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="trim_code">Production Date:</label>
                                        <input id="production_date" type="text" max="<?php echo date("Y-m"); ?>" class="form-control {{ $errors->has('production_date') ? ' is-invalid' : '' }}" name="production_date" value="{{ old('production_date') }}" placeholder="Production Date">
                                        @if ($errors->has('production_date'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('production_date') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="estimator_name">License Plate:<span class="text-danger asteric-sign"></span></label>
                                       <div class="row">
                                        <div class="col-md-9">
                                            <input id="license_plate" type="text" class="form-control {{ $errors->has('license_plate') ? ' is-invalid' : '' }}" name="license_plate" value="{{ old('license_plate') }}" placeholder="License Plate">
                                            @if ($errors->has('license_plate'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('license_plate') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-md-3">
                                            <select class="form-control select" id="licence_state" name="licence_state">
                                                <option value="" hidden>License State</option>
                                                <option value="California">California</option>
                                                <option value="Texas">Texas</option>
                                                <option value="Florida">Florida</option>
                                                <option value="Ohio">Ohio</option>
                                                <option value="Alaska">Alaska</option>
                                            </select>
                                        </div>
                                       </div>
                                        {{-- @if ($errors->has('estimator_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('estimator_name') }}</strong>
                                            </span>
                                        @endif --}}
                                    </div>
                                </div>
                            </div>
                            <!-- Start Insurance Information -->
                            <div class="row mt-2">
                                <h4 class="card-title customTitle">Insurance Information</h4>
                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="estimator_name">Insurance Company<span class="text-danger asteric-sign">&#42;</span></label>
                                        <input id="insurance_company" type="text" class="form-control {{ $errors->has('insurance_company') ? ' is-invalid' : '' }}" name="insurance_company" value="{{ old('insurance_company') }}" placeholder="Insurance Company">
                                        @if ($errors->has('insurance_company'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('insurance_company') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                {{-- <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="claim_office">Claim Office<span class="text-danger asteric-sign">&#42;</span></label>
                                        <input id="claim_office" type="text" class="form-control {{ $errors->has('claim_office') ? ' is-invalid' : '' }}" name="claim_office" value="{{ old('claim_office') }}" placeholder="Claim Office">
                                        @if ($errors->has('claim_office'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('claim_office') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div> --}}
                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="insurance_phone_number">Phone Number </label><br>
                                        <input id="insurance_phone_number" type="text" class="form-control {{ $errors->has('insurance_phone_number') ? ' is-invalid' : '' }}" name="insurance_phone_number" value="{{ old('insurance_phone_number') }}" placeholder="Phone Number">
                                        @if ($errors->has('insurance_phone_number'))
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $errors->first('insurance_phone_number') }}</strong>
                                            </span>
                                        @elseif($errors->has('phone_code'))
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $errors->first('phone_code') }}</strong>
                                            </span>
                                        @elseif($errors->has('iso_code'))
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $errors->first('iso_code') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="adjuster">Adjuster:<span class="text-danger asteric-sign"></span></label>
                                        <input id="adjuster" type="text" class="form-control {{ $errors->has('adjuster') ? ' is-invalid' : '' }}" name="adjuster" value="{{ old('adjuster') }}" placeholder="Adjuster">
                                        @if ($errors->has('adjuster'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('adjuster') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                {{-- <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="policy_number">Policy Number:<span class="text-danger asteric-sign">&#42;</span></label>
                                        <div class="row">
                                            <div class="col-sm-12 col-md-12 col-lg-12 mb-2 mb-md-0">
                                                <input id="policy_number" type="text" class="form-control {{ $errors->has('policy_number') ? ' is-invalid' : '' }}" name="policy_number" value="{{ old('policy_number') }}" name="policy_number" placeholder="Policy Number">
                                                @if ($errors->has('policy_number'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('policy_number') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="col-sm-6 col-md-5 col-lg-3">
                                                <input id="adjuster" type="number" class="form-control {{ $errors->has('policy') ? ' is-invalid' : '' }}" name="policy" value="{{ old('policy') }}" placeholder="">
                                                @if ($errors->has('policy'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('policy') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="insurance_agent">Insurance Agent:<span class="text-danger asteric-sign">&#42;</span></label>
                                        <div class="col-md-12">
                                            <input id="insurance_agent" type="text" class="form-control {{ $errors->has('insurance_agent') ? ' is-invalid' : '' }}" name="insurance_agent" value="{{ old('insurance_agent') }}" placeholder="Insurance Agent">
                                            @if ($errors->has('insurance_agent'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('insurance_agent') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="deductible">Deductible:<span class="text-danger asteric-sign"></span></label>
                                        <div class="row">
                                            <div class="col-md-12 col-lg-12 mb-12 mb-md-0">
                                                <input id="deductible" type="text" class="form-control {{ $errors->has('deductible') ? ' is-invalid' : '' }}" name="deductible" value="{{ old('deductible') }}" placeholder="Deductible">
                                                @if ($errors->has('deductible'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('deductible') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            {{-- <div class="col-md-7 col-lg-4">
                                                <input id="deductible" type="text" class="form-control {{ $errors->has('deductible') ? ' is-invalid' : '' }}" name="policy" value="{{ old('deductible') }}" placeholder="">
                                                @if ($errors->has('deductible'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('deductible') }}</strong>
                                                </span>
                                                @endif
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Start Insurance Information -->
                            <!-- Start Assignment Information -->
                            <div class="row mt-2">
                                {{-- <h4 class="card-title customTitle">Assignment Information</h4> --}}
                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="claim_number">Claim Number:<span class="text-danger asteric-sign"></span></label>
                                        <input id="claim_number" type="text" class="form-control {{ $errors->has('claim_number') ? ' is-invalid' : '' }}" name="claim_number" value="{{ old('claim_number') }}" placeholder="Claim Number">
                                        @if ($errors->has('claim_number'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('claim_number') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                {{-- <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="claim_type">Claim Type:<span class="text-danger asteric-sign">&#42;</span></label>
                                        <input id="claim_type" type="text" class="form-control {{ $errors->has('claim_type') ? ' is-invalid' : '' }}" name="claim_type" value="{{ old('claim_type') }}" placeholder="Claim Type">
                                        @if ($errors->has('claim_type'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('claim_type') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div> --}}
                                {{-- <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="loss_type">Type of Loss:<span class="text-danger asteric-sign"></span></label>
                                        <input id="loss_type" type="text" class="form-control {{ $errors->has('loss_type') ? ' is-invalid' : '' }}" name="loss_type" value="{{ old('loss_type') }}" placeholder="Type of Loss">
                                        @if ($errors->has('loss_type'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('loss_type') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div> --}}
                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="loss_time">Loss Date/Time:<span class="text-danger asteric-sign"></span></label>
                                        <input id="loss_time" type="date" max="<?php echo date("Y-m-d"); ?>" class="form-control {{ $errors->has('loss_time') ? ' is-invalid' : '' }}" name="loss_time" value="{{ old('loss_time') }}" placeholder="Loss Date/Time">
                                        @if ($errors->has('loss_time'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('loss_time') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                {{-- <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="claim_type">Payer:<span class="text-danger asteric-sign"></span></label>
                                        <input id="payer" type="text" class="form-control {{ $errors->has('payer') ? ' is-invalid' : '' }}" name="payer" value="{{ old('payer') }}" placeholder="Payer">
                                        @if ($errors->has('payer'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('payer') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div> --}}
                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="insurance_prepaid_amount">Insurer Prepaid Amount:<span class="text-danger asteric-sign"></span></label>
                                        <input id="insurance_prepaid_amount" type="text" class="form-control {{ $errors->has('insurance_prepaid_amount') ? ' is-invalid' : '' }}" name="insurance_prepaid_amount" value="{{ old('insurance_prepaid_amount') }}" placeholder="Insurer Prepaid Amount">
                                        @if ($errors->has('insurance_prepaid_amount'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('insurance_prepaid_amount') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- End Assignment Information -->
                            <div class="col-12">
                                    <button type="Submit" class="btn btn-primary me-1">Submit</button>
                                </div> 
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Basic Floating Label Form section end -->



@push('page_script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

    
   <script>

        var isoCode = ($("#iso_code").val()) ? ($("#iso_code").val()) : ('US');
        //  phone 1 input
        var phoneInput = document.querySelector("#phone_number");
        var phoneInstance = window.intlTelInput(phoneInput, {
            autoPlaceholder: "off",
            separateDialCode: true,
            initialCountry: isoCode
            // utilsScript: '{{URL::asset("frontend/build/js/utils.js")}}',
        });


        $("#phone_code").val(phoneInstance.getSelectedCountryData().dialCode);
        $("#iso_code").val(phoneInstance.getSelectedCountryData().iso2);
        phoneInput.addEventListener("countrychange",function() {
            $("#phone_code").val(phoneInstance.getSelectedCountryData().dialCode);
            $("#iso_code").val(phoneInstance.getSelectedCountryData().iso2);
        });

        
    </script>
@endpush

@endsection