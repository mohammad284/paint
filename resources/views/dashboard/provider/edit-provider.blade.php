@extends('dashboard.layout.master')
@push('plugin-styles')
  <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/jquery-tags-input/jquery.tagsinput.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/bootstrap-colorpicker/bootstrap-colorpicker.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/prismjs/prism.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/@mdi/css/materialdesignicons.min.css') }}" rel="stylesheet" />
@endpush
@push('plugin-styles')
  <?php
  $lang = Session('locale');
  if ($lang != "en") {
      $lang = "de";
  }
?>
  @if($lang == 'en')
  <link href="{{ asset('assets/massageltr.css') }}" rel="stylesheet" />
  @else
  <link href="{{ asset('assets/massage.css') }}" rel="stylesheet" />
  @endif
@endpush
@if ($errors->any())
    <div class="message-box">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ __($error) }}</li>
            @endforeach
        </ul>
    </div>
@endif
@section('content')



<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title"></h6>
        <p class="text-muted mb-3">{{__('edit provider')}}</p>
        <form class="forms-sample"  method="POST" enctype="multipart/form-data" action="/admin/updateProvider/{{$provider->id}}">
            @csrf

            <div class="row mb-6">
                <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('first name')}}:</label>
                    <input class="form-control mb-4 mb-md-0" name="first_name" value="{{$provider->first_name}}"  required/>
                </div>
                <div class="col-md-6">
                    <label class="form-label">{{__('last name')}}:</label>
                    <input class="form-control mb-4 mb-md-0" name="last_name" value="{{$provider->last_name}}" required/>
                </div>
                <div >
                <br>
              </div>
                <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('email')}}:</label>
                    <input class="form-control mb-4 mb-md-0" name="email" value="{{$provider->email}}"  required/>
                </div>
                <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('mobile')}}:</label>
                    <input class="form-control mb-4 mb-md-0" name="mobile" value="{{$provider->mobile}}"  required/>
                </div>
                <div >
                <br>
              </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="exampleFormControlSelect1" class="form-label">{{__('postal code')}}</label>
                    <select class="js-example-basic-single form-select" name="postal_code" id="postal_code"  data-width="100%" required>
                      <option selected value="{{$provider['postal']->id}}">{{$provider['postal']->Postal_Code}}</option>
                        @foreach($postals as $postal)
                          <option value="{{$postal->id}}">{{$postal->Postal_Code}}-{{$postal->Place_Name}}</option>
                        @endforeach 
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="exampleFormControlSelect1" class="form-label">{{__('gender')}}</label>
                    <select class="js-example-basic-single form-select" name="gender" id="gender"  data-width="100%" required>
                      <option selected value="{{$provider->gender}}">@if($provider->gender == 0){{__('mall')}}@elseif($provider->gender == 1){{__('female')}}@else{{__('other')}}@endif</option>
                          <option value="1">{{__('male')}}</option>
                          <option value="0">{{__('female')}}</option>
                          <option value="2">{{__('other')}}</option>
                    </select>
                  </div>
                </div>                
                <div >
                  <br>
                </div>
              <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('company name')}}:</label>
                    <input class="form-control mb-4 mb-md-0" name="company_name" value="{{$provider->company_name}}"  required/>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="exampleFormControlSelect1" class="form-label">{{__('Legal form')}}</label>
                    <select class="js-example-basic-single form-select" name="Legal_form" id="Legal_form"  data-width="100%" required>
                      <option selected value="{{$provider->Legal_form}}">{{$provider->Legal_form}}</option>

                          <option value="Natürliche Person / Einzelunternehmen">{{__('Natürliche Person / Einzelunternehmen')}}</option>
                          <option value="GmbH">{{__('GmbH')}}</option>
                          <option value="AG">{{__('AG')}}</option>
                          <option value="GbR">{{__('GbR')}}</option>
                          <option value="UG (haftungsbeschränkt)">{{__('UG (haftungsbeschränkt)')}}</option>
                          <option value="EK (Einzelkaufmann) / eU (Einzelunternehmer)">{{__('EK (Einzelkaufmann) / eU (Einzelunternehmer)')}}</option>
                          <option value="eingetragener Kaufmann (e.K)">{{__('eingetragener Kaufmann (e.K)')}}</option>
                          <option value="oHG, KG (einschl. GmbH & Co.KG)">{{__('oHG, KG (einschl. GmbH & Co.KG)')}}</option>
                          <option value="Ltd">{{__('Ltd')}}</option>
                          <option value="Sonstige Rechtsform">{{__('Sonstige Rechtsform')}}</option>
                    </select>
                  </div>
                </div>
                <div >
                  <br>
                </div>
              <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('Street number')}}</label>
                    <input class="form-control mb-4 mb-md-0" name="street_num" value="{{$provider->street_num}}" required/>
                </div>
                <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('home number')}}</label>
                    <input class="form-control mb-4 mb-md-0" name="home_num" value="{{$provider->home_num}}" required/>
                </div>
                <div >
                  <br>
                </div>
              <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('password')}}:</label>
                    <input class="form-control mb-4 mb-md-0" name="password" value=""   />
                </div>
                <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('comfirm password')}}:</label>
                    <input class="form-control mb-4 mb-md-0" name="password_confirmation"  value=""  />
                </div>
                <div >
                  <br>
                </div>
                <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('work_range')}}</label>
                    <input class="form-control mb-4 mb-md-0" name="work_range" value="{{$provider->work_range}}" required/>
                </div>
                <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('com_description')}}</label>
                    <textarea id="maxlength-textarea" class="form-control" name="com_description"  rows="4" >{{$provider->com_description}}</textarea>
                </div>

            </div>

            <button type="submit" class="btn btn-primary me-2">{{__('edit')}}</button>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/inputmask/jquery.inputmask.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/typeahead-js/typeahead.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/jquery-tags-input/jquery.tagsinput.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/dropify/js/dropify.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/bootstrap-colorpicker/bootstrap-colorpicker.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/form-validation.js') }}"></script>
  <script src="{{ asset('assets/js/bootstrap-maxlength.js') }}"></script>
  <script src="{{ asset('assets/js/inputmask.js') }}"></script>
  <script src="{{ asset('assets/js/select2.js') }}"></script>
  <script src="{{ asset('assets/js/typeahead.js') }}"></script>
  <script src="{{ asset('assets/js/tags-input.js') }}"></script>
  <script src="{{ asset('assets/js/dropify.js') }}"></script>
  <script src="{{ asset('assets/js/bootstrap-colorpicker.js') }}"></script>
  <script src="{{ asset('assets/js/datepicker.js') }}"></script>
  <script src="{{ asset('assets/js/timepicker.js') }}"></script>
@endpush
@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush
