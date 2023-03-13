@extends('layouts.admin')

@section('title') Create User @endsection

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
                            <li class="breadcrumb-item"><a href="{{route('users.index')}}">User</a>
                            </li>
                            <li class="breadcrumb-item active">Create User
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
                        <form method="POST" action="{{ route('users.store') }}">
                        @csrf
                            <!-- Start Customer Name -->
                            <div class="row">
                                <h4 class="card-title customTitle mb-1">Customer Name</h4>
                                <div class="btn-group mb-1">
                                    <button class="addBtn me-1"><i class="fas fa-plus"></i> Add</button>
                                    <button class="removeBtn"><i class="fas fa-times"></i> Remove</button>
                                </div>
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
                                            <input id="last_name" type="text" class="form-control {{ $errors->has('full_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ old('last_name') }}" placeholder="Last Name">
                                            @if ($errors->has('last_name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('last_name') }}</strong>
                                                </span>
                                            @endif
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="email">Email <span class="text-danger asteric-sign">&#42;</span></label>
                                            <input id="email" type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Enter Email">
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
                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="estimator_name">Estimator<span class="text-danger asteric-sign">&#42;</span></label>
                                        <select class="form-control select" id="estimator_name">
                                            <option class="" hidden>Select Estimator</option>
                                            <option>Estimator1</option>
                                            <option>Estimator2</option>
                                            <option>Estimator3</option>
                                        </select>
                                            @if ($errors->has('estimator_name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('estimator_name') }}</strong>
                                                </span>
                                            @endif
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="priority_name">Priority <span class="text-danger asteric-sign">&#42;</span></label>
                                        <select class="form-control select" id="estimator_name">
                                            <option class="" hidden>Select Priority</option>
                                            <option>Priority2</option>
                                            <option>Priority3</option>
                                            <option>Priority4</option>
                                        </select>
                                            @if ($errors->has('last_name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('priority_name') }}</strong>
                                                </span>
                                            @endif
                                    </div>
                                </div>
                            </div>
                            <!-- Start Tracking Information -->
                            <!-- Start Vehic Information -->
                            <div class="row mt-2">
                                <h4 class="card-title customTitle">Vehicle</h4>
                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="estimator_name">Year / Make:<span class="text-danger asteric-sign">&#42;</span></label>
                                       <div class="row">
                                        <div class="col-sm-6 col-md-5 col-lg-3 mb-2 mb-md-0">
                                            <select class="form-control select" id="year">
                                                <option class="" hidden>Year</option>
                                                <option>Year1</option>
                                                <option>Year2</option>
                                                <option>Year3</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-6 col-md-7 col-lg-9">
                                            <select class="form-control select" id="estimator_name">
                                                <option class="" hidden>Select Estimator</option>
                                                <option>Estimator1</option>
                                                <option>Estimator2</option>
                                                <option>Estimator3</option>
                                            </select>
                                        </div>
                                       </div>
                                        @if ($errors->has('estimator_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('estimator_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="exterior_color">Exterior Color:<span class="text-danger asteric-sign">&#42;</span></label>
                                        <input id="exterior_name" type="text" class="form-control {{ $errors->has('exterior_name') ? ' is-invalid' : '' }}" name="exterior_name" value="{{ old('full_name') }}" placeholder="Color">
                                        @if ($errors->has('full_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('exterior_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="priority_name">Body Style: <span class="text-danger asteric-sign">&#42;</span></label>
                                        <select class="form-control select" id="estimator_name">
                                            <option class="" hidden>Select Priority</option>
                                            <option>Priority2</option>
                                            <option>Priority3</option>
                                            <option>Priority4</option>
                                        </select>
                                            @if ($errors->has('last_name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('priority_name') }}</strong>
                                                </span>
                                            @endif
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="interior_name">Interior Color:<span class="text-danger asteric-sign">&#42;</span></label>
                                        <input id="interior_name" type="text" class="form-control {{ $errors->has('interior_name') ? ' is-invalid' : '' }}" name="interior_name" value="{{ old('interior_name') }}" placeholder="Color">
                                        @if ($errors->has('full_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('interior_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="engine">Engine:<span class="text-danger asteric-sign">&#42;</span></label>
                                        <input id="engine" type="text" class="form-control {{ $errors->has('engine') ? ' is-invalid' : '' }}" name="engine" value="{{ old('engine') }}" placeholder="">
                                        @if ($errors->has('engine'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('engine') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="paint">Paint Code:<span class="text-danger asteric-sign">&#42;</span></label>
                                        <input id="paint" type="text" class="form-control {{ $errors->has('paint') ? ' is-invalid' : '' }}" name="paint" value="{{ old('paint') }}" placeholder="">
                                        @if ($errors->has('paint'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('paint') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="estimator_name">Mileage:<span class="text-danger asteric-sign">&#42;</span></label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-1">
                                                    <label class="form-label" for="in_mileage">In:<span class="text-danger asteric-sign">&#42;</span></label>
                                                    <input id="in_mileage" type="text" class="form-control {{ $errors->has('in_mileage') ? ' is-invalid' : '' }}" name="in_mileage" value="{{ old('engine') }}" placeholder="">
                                                    @if ($errors->has('engine'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('in_mileage') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-1">
                                                    <label class="form-label" for="out_mileage">Out:<span class="text-danger asteric-sign">&#42;</span></label>
                                                    <input id="out_mileage" type="text" class="form-control {{ $errors->has('out_mileage') ? ' is-invalid' : '' }}" name="out_mileage" value="{{ old('engine') }}" placeholder="">
                                                    @if ($errors->has('out_mileage'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('out_mileage') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="trim_code">Trim Code:<span class="text-danger asteric-sign">&#42;</span></label>
                                        <input id="trim_code" type="text" class="form-control mt-24 {{ $errors->has('trim_code') ? ' is-invalid' : '' }}" name="paint" value="{{ old('trim_code') }}" placeholder="">
                                        @if ($errors->has('paint'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('trim_code') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="trim_code">Production Date:<span class="text-danger asteric-sign">&#42;</span></label>
                                        <input id="trim_code" type="date" class="form-control {{ $errors->has('trim_code') ? ' is-invalid' : '' }}" name="paint" value="{{ old('trim_code') }}" placeholder="">
                                        @if ($errors->has('paint'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('trim_code') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="estimator_name">License Plate:<span class="text-danger asteric-sign">&#42;</span></label>
                                       <div class="row">
                                        <div class="col-md-9">
                                            <input id="trim_code" type="text" class="form-control {{ $errors->has('trim_code') ? ' is-invalid' : '' }}" name="paint" value="{{ old('trim_code') }}" placeholder="">
                                            @if ($errors->has('paint'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('trim_code') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-md-3">
                                            <select class="form-control select" id="estimator_name">
                                                <option class="" hidden>License</option>
                                                <option>License2</option>
                                                <option>License3</option>
                                                <option>License4</option>
                                            </select>
                                        </div>
                                       </div>
                                        @if ($errors->has('estimator_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('estimator_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- Start Insurence Information -->
                            <div class="row mt-2">
                                <h4 class="card-title customTitle">Insurence Information</h4>
                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="estimator_name">Insurence Company<span class="text-danger asteric-sign">&#42;</span></label>
                                        <select class="form-control select" id="year">
                                            <option class="" hidden>Select Insurence</option>
                                            <option>Insurence1</option>
                                            <option>Insurence2</option>
                                            <option>Insurence3</option>
                                        </select>
                                        @if ($errors->has('estimator_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('insurence') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="estimator_name">Claim Office<span class="text-danger asteric-sign">&#42;</span></label>
                                        <select class="form-control select" id="year">
                                            <option class="" hidden>Select Claim</option>
                                            <option>Claim1</option>
                                            <option>Claim2</option>
                                            <option>Claim3</option>
                                        </select>
                                        @if ($errors->has('claim'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('claim') }}</strong>
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
                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="adjuster">Adjuster:<span class="text-danger asteric-sign">&#42;</span></label>
                                        <input id="adjuster" type="text" class="form-control {{ $errors->has('adjuster') ? ' is-invalid' : '' }}" name="adjuster" value="{{ old('adjuster') }}" placeholder="">
                                        @if ($errors->has('adjuster'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('adjuster') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="adjuster">Policy Number:<span class="text-danger asteric-sign">&#42;</span></label>
                                        <div class="row">
                                            <div class="col-sm-6 col-md-7 col-lg-9 mb-2 mb-md-0">
                                                <input id="adjuster" type="number" class="form-control {{ $errors->has('policy') ? ' is-invalid' : '' }}" name="policy" value="{{ old('adjuster') }}" placeholder="">
                                                @if ($errors->has('policy'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('policy') }}</strong>
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
                                        <label class="form-label" for="insurence_agent">Insurence Agent:<span class="text-danger asteric-sign">&#42;</span></label>
                                        <div class="col-md-12">
                                            <input id="insurence_agent" type="text" class="form-control {{ $errors->has('insurence_agent') ? ' is-invalid' : '' }}" name="policy" value="{{ old('insurence_agent') }}" placeholder="">
                                            @if ($errors->has('policy'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('insurence_agent') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="insurence_agent">Deductible:<span class="text-danger asteric-sign">&#42;</span></label>
                                        <div class="row">
                                            <div class="col-md-5 col-lg-4 mb-2 mb-md-0">
                                                <select class="form-control select" id="year">
                                                    <option class="" hidden>$</option>
                                                    <option>$1</option>
                                                    <option>$2</option>
                                                    <option>$3</option>
                                                </select>
                                            </div>
                                            <div class="col-md-7 col-lg-4">
                                                <input id="deductible" type="text" class="form-control {{ $errors->has('deductible') ? ' is-invalid' : '' }}" name="policy" value="{{ old('deductible') }}" placeholder="">
                                                @if ($errors->has('deductible'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('deductible') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Start Insurence Information -->
                            <!-- Start Assignment Information -->
                            <div class="row mt-2">
                                <h4 class="card-title customTitle">Assignment Information</h4>
                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="claim_number">Claim Number:<span class="text-danger asteric-sign">&#42;</span></label>
                                        <input id="claim_number" type="number" class="form-control {{ $errors->has('claim_number') ? ' is-invalid' : '' }}" name="claim_number" value="{{ old('claim_number') }}" placeholder="">
                                        @if ($errors->has('claim_number'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('claim_number') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="claim_type">Claim Type:<span class="text-danger asteric-sign">&#42;</span></label>
                                        <select class="form-control select" id="year">
                                            <option class="" hidden>Vehicle</option>
                                            <option>Vehicle1</option>
                                            <option>Vehicle2</option>
                                            <option>Vehicle3</option>
                                        </select>
                                        @if ($errors->has('estimator_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('claim_type') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="claim_type">Type of Loss:<span class="text-danger asteric-sign">&#42;</span></label>
                                        <select class="form-control select" id="year">
                                            <option class="" hidden>Type of Loss</option>
                                            <option>Type of Loss</option>
                                            <option>Type of Loss</option>
                                            <option>Type of Loss</option>
                                        </select>
                                        @if ($errors->has('estimator_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('claim_type') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="trim_code">Loss Date/Time:<span class="text-danger asteric-sign">&#42;</span></label>
                                        <input id="trim_code" type="date" class="form-control {{ $errors->has('trim_code') ? ' is-invalid' : '' }}" name="paint" value="{{ old('trim_code') }}" placeholder="">
                                        @if ($errors->has('paint'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('trim_code') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="claim_type">Prayer:<span class="text-danger asteric-sign">&#42;</span></label>
                                        <select class="form-control select" id="year">
                                            <option class="" hidden>Insurence Company</option>
                                            <option>Insurence Company</option>
                                            <option>Insurence Company</option>
                                            <option>Insurence Company</option>
                                        </select>
                                        @if ($errors->has('estimator_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('claim_type') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="insurer_prepaid">Insurer Prepaid Amount:<span class="text-danger asteric-sign">&#42;</span></label>
                                        <input id="insurer_prepaid" type="text" class="form-control {{ $errors->has('insurer_prepaid') ? ' is-invalid' : '' }}" name="paint" value="{{ old('insurer_prepaid') }}" placeholder="">
                                        @if ($errors->has('paint'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('insurer_prepaid') }}</strong>
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