@extends('dashboard.layout.master')
@push('plugin-styles')
  <link href="{{ asset('assets/plugins/dropzone/dropzone.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/jquery-tags-input/jquery.tagsinput.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/bootstrap-colorpicker/bootstrap-colorpicker.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/@mdi/css/materialdesignicons.min.css') }}" rel="stylesheet" />
@endpush
@push('plugin-styles')
  <link href="{{ asset('assets/plugins/prismjs/prism.css') }}" rel="stylesheet" />
  <?php
  $lang = Session('locale');
  if ($lang != "en") {
      $lang = "ar";
  }
?>
  @if($lang == 'en')
  <link href="{{ asset('assets/massageltr.css') }}" rel="stylesheet" />
  @else
  <link href="{{ asset('assets/massage.css') }}" rel="stylesheet" />
  @endif
@endpush

@section('content')
@if ($errors->any())
    <div class="message-box">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ __($error) }}</li>
            @endforeach
        </ul>
    </div>
@endif
@push('plugin-styles')

@endpush

@section('content')

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">{{__('add new user')}}</h4>
        <form class="forms-sample"  method="POST" enctype="multipart/form-data" action="/admin/storeUser">
            @csrf

            <div class="row mb-6">
                <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('first name')}}</label>
                    <input class="form-control mb-4 mb-md-0" name="first_name"  required/>
                    @if ($errors->has('first_name'))
                      <span class="text-danger">{{ $errors->first('first_name') }}</span>
                    @endif 
                </div>
                <div class="col-md-6">
                    <label class="form-label">{{__('last name')}}:</label>
                    <input class="form-control mb-4 mb-md-0" name="last_name" required/>
                    @if ($errors->has('last_name'))
                      <span class="text-danger">{{ $errors->first('last_name') }}</span>
                    @endif 
                </div>
                <div >
                <br>
              </div>
                <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('email')}}</label>
                    <input class="form-control mb-4 mb-md-0" name="email"  required/>
                    @if ($errors->has('email'))
                      <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="col-md-6">
                    <label class="form-label">{{__('mobile')}}:</label>
                    <input class="form-control mb-4 mb-md-0" name="mobile" required/>
                    @if ($errors->has('mobile'))
                      <span class="text-danger">{{ $errors->first('mobile') }}</span>
                    @endif
                </div>
                <div >
                <br>
              </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="exampleFormControlSelect1" class="form-label">{{__('gender')}}</label>
                    @if ($errors->has('gender'))
                      <span class="text-danger">{{ $errors->first('gender') }}</span>
                    @endif
                    <select class="js-example-basic-single form-select" name="gender" id="exampleFormControlSelect"  data-width="100%" required>
                      <option selected disabled>{{__('gender')}}</option>
                          <option value="1">{{__('male')}}</option>
                          <option value="0">{{__('female')}}</option>
                          <option value="2">{{__('other')}}</option>
                    </select>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="exampleFormControlSelect1" class="form-label">{{__('postal code')}}</label>
                    @if ($errors->has('postal_code'))
                      <span class="text-danger">{{ $errors->first('postal_code') }}</span>
                    @endif
                    <select class="js-example-basic-single form-select" name="postal_code" id="exampleFormControl"  data-width="100%" required>
                      <option selected disabled>{{__('postal code')}}</option>
                        @foreach($postals as $postal)
                          <option value="{{$postal->id}}">{{$postal->Postal_Code}}-{{$postal->Place_Name}}</option>
                        @endforeach 
                    </select>
                  </div>
                </div>
                <div >
                  <br>
                </div>
                <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('Street number')}}</label>
                    <input class="form-control mb-4 mb-md-0" name="street_num"  required/>
                    @if ($errors->has('street_num'))
                      <span class="text-danger">{{ $errors->first('street_num') }}</span>
                    @endif
                </div>
                <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('home number')}}</label>
                    <input class="form-control mb-4 mb-md-0" name="home_num" required/>
                    @if ($errors->has('home_num'))
                      <span class="text-danger">{{ $errors->first('home_num') }}</span>
                    @endif
                </div>
                <div >
                  <br>
                </div>
                <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('password')}}</label>
                    <input class="form-control mb-4 mb-md-0" name="password"  required/>
                    @if ($errors->has('password'))
                      <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('comfirm password')}}</label>
                    <input class="form-control mb-4 mb-md-0" name="password_confirmation" required/>
                    @if ($errors->has('password'))
                      <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>
            </div>

            <button type="submit" class="btn btn-primary me-2">{{__('save')}}</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/prismjs/prism.js') }}"></script>
  <script src="{{ asset('assets/plugins/clipboard/clipboard.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/inputmask/jquery.inputmask.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/typeahead-js/typeahead.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/jquery-tags-input/jquery.tagsinput.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/dropzone/dropzone.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/dropify/js/dropify.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/bootstrap-colorpicker/bootstrap-colorpicker.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/data-table.js') }}"></script>
  <script src="{{ asset('assets/js/form-validation.js') }}"></script>
  <script src="{{ asset('assets/js/bootstrap-maxlength.js') }}"></script>
  <script src="{{ asset('assets/js/inputmask.js') }}"></script>
  <script src="{{ asset('assets/js/select2.js') }}"></script>
  <script src="{{ asset('assets/js/typeahead.js') }}"></script>
  <script src="{{ asset('assets/js/tags-input.js') }}"></script>
  <script src="{{ asset('assets/js/dropzone.js') }}"></script>
  <script src="{{ asset('assets/js/dropify.js') }}"></script>
  <script src="{{ asset('assets/js/bootstrap-colorpicker.js') }}"></script>
  <script src="{{ asset('assets/js/datepicker.js') }}"></script>
  <script src="{{ asset('assets/js/timepicker.js') }}"></script>
@endpush