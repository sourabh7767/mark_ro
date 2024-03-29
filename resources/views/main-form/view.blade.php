@extends('layouts.admin')

@section('title') View Form @endsection

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
                            <li class="breadcrumb-item active">View Form
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 text-end mb-2">
                <button class="btnWarning" data-bs-toggle="modal" data-bs-target="#addNotesModal">
                    <i class="fas fa-edit"></i>
                    Add to notes
                </button>
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
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button"  class="btn btn-primary submit-notes">Save</button>
                        </div>
                        </div>
                    </div>
                    </div>
                <!-- End NotesModal -->
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <!-- <h4 class="card-title">Create User</h4> -->
                    </div>
                    <div class="card-body">
                        
                        <h4 class="card-title customTitle">Main Form</h4>
                        <table id="w0" class="table table-striped table-bordered detail-view mb-2">
                            <tbody>
                            <tr>
                                <th>RO</th>
                                <td colspan="1">{{ !empty($customer['ro'])? $customer['ro'] : ""  }}</td>
                                <th>Status</th>
                                <td colspan="1">{{ !empty($customer['status'])? ucfirst($customer['status']) : ""  }}</td>
                            </tr>
                            </tbody>
                        </table>
                        <input type="hidden" class="main_form_id" value="{{@$customer['main_form_id']}}" />
                        <!-- Start Customer Name -->
                        <div class="row">
                            <h4 class="card-title customTitle">Customer Info</h4>
                            <div class="card-body">
                                <table id="w0" class="table table-striped table-bordered detail-view">
                                    <tbody>
                                    <tr>
                                        <th>First Name</th>
                                        <td colspan="1">{{ $customer['full_name'] }}</td>
                                        <th>Last Name</th>
                                        <td colspan="1">{{$customer['last_name']}}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td colspan="1">
                                        @if(!empty($customer['email']))
                                        <a href="mailto:{{$customer['email']}}">{{ !empty($customer['email'])? $customer['email'] : ""  }}</a>
                                        @else
                                            NA
                                        @endif
                                        </td>
                                        <th>Phone Number</th>
                                        <td colspan="1">{{$customer['phone_code'].$customer['phone_number']}}</td>
                                    </tr>                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- End Customer Name -->
                        <!-- Start Tracking Information -->
                        <div class="row mt-2">
                            <h4 class="card-title customTitle">Tracking Information</h4>
                            <div class="col-md-12 col-12">
                                <div class="mb-1">
                                    <table id="w0" class="table table-striped table-bordered detail-view">
                                        <tbody>
                                            <tr>
                                                <th>Estimator</th>
                                                <td colspan="1">{{ $customer['estimator_name'] }}</td>
                                            </tr>                     
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- Start Tracking Information -->
                        <!-- Start Vehic Information -->
                        <div class="row mt-2">
                            <h4 class="card-title customTitle">Vehicle</h4>
                            <div class="col-md-6 col-12">
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                </div>
                            </div>

                            <div class="card-body">
                                <table id="w0" class="table table-striped table-bordered detail-view">
                                    <tbody>
                                        <tr>
                                            <th>Year</th>
                                            <td colspan="1">{{ $customer['year'] }}</td>
                                            <th>Make</th>
                                            <td colspan="1">{{$customer['make']}}</td>
                                        </tr>
                                        <tr>
                                            <th>Model</th>
                                            <td colspan="1">{{ !empty($customer['model'])? $customer['model'] : ""  }}
                                            </td>
                                            <th>Exterior Color</th>
                                            <td colspan="1">{{ !empty($customer['exterior_color']) ? $customer['exterior_color'] : "" }}</td>
                                        </tr>
                                        <tr>
                                            <th>Paint Code</th>
                                            <td colspan="1">{{ !empty($customer['paint_code'])? $customer['paint_code'] : ""  }}
                                            </td>
                                            <th>Mileage In</th>
                                            <td colspan="1">{{ !empty($customer['mileage_in'])? $customer['mileage_in'] : ""  }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Mileage Out</th>
                                            <td colspan="1">{{ !empty($customer['mileage_in'])? $customer['mileage_in'] : ""  }}
                                            </td>
                                            <th>Trim Code</th>
                                            <td colspan="1">{{ !empty($customer['trim_code'])? $customer['trim_code'] : ""  }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Production Date</th>
                                            <td colspan="1">{{ !empty($customer['production_date'])? $customer['production_date'] : ""  }}
                                            </td>
                                            <th>License Plate</th>
                                            <td colspan="1">{{ !empty($customer['license_plate'])? $customer['license_plate'] : ""  }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>License State</th>
                                            <td colspan="1">{{ !empty($customer['licence_state']) ? $customer['licence_state'] : ""  }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Start Insurance Information -->
                        <div class="row mt-2">
                            <h4 class="card-title customTitle">Insurance Information</h4>

                            <div class="card-body">
                                <table id="w0" class="table table-striped table-bordered detail-view">
                                  <tbody>
                                    <tr>
                                      <th>Insurance Company</th>
                                      <td colspan="1">{{ $customer['insurance_company'] }}</td>
                                      <th>Insurance Phone Number</th>
                                      <td colspan="1">{{!empty($customer['insurance_phone_number'])?$customer['insurance_phone_number']:""}}</td>
                                    </tr>
                                    <tr>
                                      <th>Adjuster</th>
                                        <td colspan="1">{{ !empty($customer['adjuster'])? $customer['model'] : ""  }}
                                        </td>
                                      <th>Deductible</th>
                                      <td colspan="1">{{!empty($customer['deductible'])?$customer['deductible']:""}}</td>
                                    </tr>
                                    <tr>
                                        <th>Claim Number</th>
                                        <td colspan="1">{{ !empty($customer['claim_number'])? $customer['claim_number'] : ""  }}
                                        </td>
                                        <th>Loss Time</th>
                                        <td colspan="1">{{ !empty($customer['loss_time'])?  date("d/m/Y", strtotime($customer['loss_time'])) : ""  }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Insurance Prepaid Amount</th>
                                        <td colspan="1">{{ !empty($customer['insurance_prepaid_amount'])? $customer['insurance_prepaid_amount'] : ""  }}
                                        </td>
                                    </tr>
                                  </tbody>
                                </table>
                            </div>
                        </div>
                            <div>
                                <h4 class="card-title customTitle">Notes</h4>
                                <table id="w0" class='table table-striped table-bordered detail-view mb-2'>
                                <thead>
                                    <tr>
                                        <th class="thead">Notes</th>
                                        <th class="thead">Created at</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($notes as $noteKey => $noteValue)
                                    <tr>
                                        <td>{{$noteValue->notes}}</td>
                                        <td>{{$noteValue->created_at}}</td>
                                    </tr>
                                    @empty
                                        No data found
                                    @endforelse
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Basic Floating Label Form section end -->
    @push('page_script')
        <script>
                $(document).ready(function() {
                    $('.submit-notes').click(function() {
                        var notes = $(".notes").val();
                        var main_form_id = $(".main_form_id").val();
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