<form class="add-form">
<div class="modal-body add-main-form">
<input type="hidden" name="main_form_id" value="{{$mainFormId}}" />   
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="exampleFormControlTextarea1" class='labelTxt'>Wheel</label>
                    <input type="checkbox" @if($data->wheel) checked="checked" @endif name="wheel" value="1" />
                </div>
                <div class="form-group col-md-6">
                    <div class="d-flex align-items-center">
                        <label for="exampleFormControlTextarea1" class='labelTxt me-1'>Wheel Date</label>
                        <input type="date" name="wheel_date" value="{{@$data->wheel_date}}" />
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="d-flex align-items-center">
                        <label for="exampleFormControlTextarea1" class='labelTxt'>Alignment</label>
                        <input type="checkbox" @if($data->alignment) checked="checked" @endif name="alignment" value="1" />
                    </div>    
                </div>
                <div class="form-group col-md-6">
                    <div class="d-flex align-items-center">
                        <label for="exampleFormControlTextarea1" class='labelTxt'>Alignment Date</label>
                        <input type="date" name="alignment_date" value="{{@$data->alignment_date}}" />
                    </div>    
                </div>
                <div class="form-group col-md-6">
                    <div class="d-flex align-items-center">
                        <label for="exampleFormControlTextarea1" class='labelTxt'>Decals</label>
                        <input type="checkbox" @if($data->decals) checked="checked" @endif name="decals" value="1" />
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="d-flex align-items-center">
                        <label for="exampleFormControlTextarea1" class='labelTxt'>Decals Date</label>
                        <input type="date" name="decals_date" value="{{@$data->decals_date}}" />
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="d-flex align-items-center">
                        <label for="exampleFormControlTextarea1" class='labelTxt'>Glass</label>
                        <input type="checkbox" @if($data->glass) checked="checked" @endif name="glass" value="1" />
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="d-flex align-items-center">
                        <label for="exampleFormControlTextarea1" class='labelTxt'>Glass Date</label>
                        <input type="date" name="glass_date" value="{{@$data->glass_date}}" />
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="d-flex align-items-center">
                        <label for="exampleFormControlTextarea1" class='labelTxt'>Adas</label>
                        <input type="checkbox" @if($data->adas) checked="checked" @endif name="adas" value="1" />
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="d-flex align-items-center">
                        <label for="exampleFormControlTextarea1" class='labelTxt'>Adas Date</label>
                        <input type="date" name="adas_date" value="{{@$data->adas_date}}" />
                    </div>
                </div>
            </div>
                  
</div>
              <div class="modal-footer">
                  <input type="submit" name="submit" value="Save"  class="btn btn-primary submit-data">
              </div>
</div>
