@extends('layouts.admin')

@section('title')Forms @endsection

@section('content')
<style>
  div.dataTables_wrapper {
        width: 100%;
        margin: 0 auto;
    }
</style>
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
                <table id="formsTable" style="width:100%" class="table table-bordered table-hover">
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

      <!-- Add dataModal -->
      <div class="modal fade" id="addDataModal" tabindex="-1" aria-labelledby="addNotesModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered data-form-model" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title">Add Data</h5>
                      <button type="button" class="closeIcon" data-bs-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true"><i class="fas fa-times"></i></span>
                      </button>
                  </div>
                  <div class="modal-body-div">

                  </div>    
              </div>
          </div>
      </div>
      <!-- End dataModal -->

      <!-- view Notes Modal -->
      <div class="modal fade" id="viewNotesModal" tabindex="-1" aria-labelledby="viewNotesModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered data-form-model" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title">Notes Data</h5>
                      <button type="button" class="closeIcon" data-bs-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true"><i class="fas fa-times"></i></span>
                      </button>
                  </div>
                  <div class="modal-body view-notes-model-content">
                      
                  </div>
                      
              </div>
          </div>
      </div>
      <!-- view Notes Modal -->

      <!-- Add NotesModal -->
      <div class="modal fade" id="addNotesModal" tabindex="-1" aria-labelledby="addNotesModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Notes</h5>
                            <button type="button" class="closeIcon" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="fas fa-times"></i></span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group text-start">
                                <label for="exampleFormControlTextarea1" class='labelTxt'>Notes</label>
                                <textarea class="form-control notes" id="exampleFormControlTextarea1" rows="5" placeholder='Notes'></textarea>
                                <input type="hidden" id="main_form_id_add_notes" name="main_form_id" value="" />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button"  class="btn btn-primary submit-notes">Save</button>
                        </div>
                        </div>
                    </div>
                    </div>
                <!-- End NotesModal -->
      <!-- /.container-fluid -->
    </section>
   
  @push('page_script')

      @include('include.dataTableScripts')   
      <script src="{{ asset('js/pages/forms/index.js') }}"></script>

      <script>
                
                  $(document).on('click', '.add-data', function() {
                        var main_form_id = $(this).data("id");
                        $.ajax({
                            url: "{{route('add.form.data')}}"+"?main_form_id=" + main_form_id,
                            type: 'GET',
                            success: function(response) {
                                $(".modal-body-div").html(response)   ;
                                $('#addDataModal').modal('show');                                   
                                $(".add-form").on('submit', function(e) {
                                  e.preventDefault(); 
                                  var formData = $(this).serialize();
                                  $.ajax({
                                        url: "{{route('save.form.data.extra')}}",
                                        type: 'POST',
                                        data: formData,
                                        success: function(response) {
                                          if (response.success) {
                                              table.draw();           
                                              swal("Good job!", "Notes Added!", "success")
                                              $('#addDataModal').modal('hide');        
                                          }else{
                                            var errors = response.errors;
                                            for (var field in errors) {
                                                // Display error messages for each field
                                                var fieldErrors = errors[field];
                                                for (var i = 0; i < fieldErrors.length; i++) {
                                                    var errorMessage = fieldErrors[i];
                                                    swal("Oops!", errorMessage, "error");
                                                    return false;
                                                }
                                            }
                                          }
                                          
                                        },
                                        error: function(jqXHR, textStatus, errorThrown) {
                                            console.error(textStatus, errorThrown);
                                            swal("Oops!", "Something went wrong!", "error");
                                        }
                                    });
                                });
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                console.error(textStatus, errorThrown);
                                swal("Oops!", "Something went wrong!", "error");
                            }
                        });
                  });

                  $(document).on('click', '.view-notes', function() {
                    var main_form_id = $(this).data("id");
                    
                    $.ajax({
                            url: "{{route('view.notes')}}"+"?main_form_id=" + main_form_id,
                            type: 'GET',
                            success: function(response) {
                                $(".view-notes-model-content").html(response);
                                $('#viewNotesModal').modal('show');                                   
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                console.error(textStatus, errorThrown);
                                swal("Oops!", "Something went wrong!", "error");
                            }
                          });
                  });

                  $(document).on('click', '.add-notes', function() {
                      var main_form_id = $(this).data("id");
                      $("#main_form_id_add_notes").val(main_form_id);
                      $('#addNotesModal').modal('show');                                   
                  });



                  // $(document).on('click', '.submit-data', function() {
                  //       //var notes = $(".notes").val();
                  //       //var main_form_id = $(".main_form_id").val();
                  //       var 
                          // $.ajax({
                          //     url: "{{route('save.form.data.extra')}}",
                          //     type: 'POST',
                          //     success: function(response) {
                          //         $(".add-main-form").append(response)   ;
                          //         $('#addNotesModal').modal('show');                                   
                          //     },
                          //     error: function(jqXHR, textStatus, errorThrown) {
                          //         console.error(textStatus, errorThrown);
                          //         swal("Oops!", "Something went wrong!", "error");
                          //     }
                          // });
                  // });

                  
      </script>
      <script>
                $(document).ready(function() {
                    $('.submit-notes').click(function() {
                        var notes = $(".notes").val();
                        var main_form_id = $("#main_form_id_add_notes").val();
                        if(main_form_id == ""){
                            alert("Please add notes");
                            return false;
                        }
                        $.ajax({
                        url: "{{route('forms.add.notes')}}",
                        type: 'POST',
                        data: {
                            main_form_id: main_form_id,
                            notes: notes
                        },
                        success: function(response) {
                            var data = $.parseJSON(response);
                            if(data.status == 1){
                                swal("Good job!", "Notes Added!", "success")
                                $('#addNotesModal').modal('hide');
                                location.reload();
                            }else{
                                swal("Oops!", "Something went wrong!", "error");
                                //alert("Some error,Please try again");
                            }

                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.error(textStatus, errorThrown);
                            swal("Oops!", "Something went wrong!", "error");
                        }
                        });
                    });
                });
        </script>
  @endpush

@endsection