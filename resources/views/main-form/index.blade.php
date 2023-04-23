@extends('layouts.admin')

@section('title')Forms @endsection

@section('content')

    <!-- Main content -->
    <section>
      <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('user.home')}}">Home</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('forms.index')}}">Forms</a>
                        </li>
                        <li class="breadcrumb-item active">Forms List
                        </li>
                    </ol>
                </div>
            </div>
        </div>
      </div>
      <div>
        <div class="row">
          <div class="col-12">
            <div class="card data-table">
                <div class="card-header">
                  <h4 class="m-0"><i class="fas fa-users mr-2"></i>&nbsp;Forms</h4>
                
                      <div class="d-flex">
                          <label style="margin-top: 10px;"><strong>Status :</strong></label>&nbsp; &nbsp;
                          <select id='status' class="form-control" style="width: 200px">
                              <option value="">All</option>
                              <option value="open">Open</option>
                              <option value="closed">Closed</option>
                          </select>
                      </div>
                      <div class="my_button_wrapper"></div>
                      <!-- <a href="{{ route('exportexcel') }}" class="dt-button create-new btn btn-primary">&nbsp;&nbsp;Export</a> -->
                      <a href="{{ route('forms.create') }}" class="dt-button create-new btn btn-primary"><i class="fas fa-plus"></i>&nbsp;&nbsp;Create New Form</a>
                  </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="formsTable" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Ro</th>
                    <th>Full Name</th>
                    <th>Year</th>
                    <th>Make</th>
                    <th>Model</th>
                    <th>Color</th>
                    <th>Estimator</th>
                    <th>Insurance Company</th>
                    <th>Due Date</th>
                    <th>Target Date</th>
                    <th>Wheel</th>
                    <th>Wheel Date</th>
                    <th>Alignment</th>
                    <th>Alignment Date</th>
                    <th>Decals</th>
                    <th>Decals Date</th>
                    <th>Glass</th>
                    <th>Glass Date</th>
                    <th>Adas</th>
                    <th>Adas Date</th>
                    <th data-orderable="false">Action</th>
                  </tr>
                  </thead>
              
                </table>
              </div>
          
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
		    </div>
       </div>    
      </div>
      <!-- /.container-fluid -->
    </section>
   
  @push('page_script')

      @include('include.dataTableScripts')   

      <script src="{{ asset('js/pages/forms/index.js') }}"></script>

  @endpush

@endsection