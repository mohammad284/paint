@extends('dashboard.layout.master')
@push('plugin-styles')
  <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/jquery-tags-input/jquery.tagsinput.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/dropzone/dropzone.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/bootstrap-colorpicker/bootstrap-colorpicker.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />
@endpush
@push('plugin-styles')    
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
@if(session()->has('message'))
<p class="message-box" >
    {{ session()->get('message') }}
</p>
@endif
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">{{__('active the coupon for')}} :</h6>
                <form class="forms-sample"  method="POST" enctype="multipart/form-data" action="/admin/activeCouponFor/{{$cop_id}}">
                    <div class="mb-3">
                        <div class="form-check form-check-inline">
                            <input type="checkbox" class="form-check-input" id="checkInlineChecked" checked>
                            <label class="form-check-label" for="checkInlineChecked">
                            {{__('All users')}}
                            </label>
                        </div>
                        <div><br></div>
                        <div class="form-check form-check-inline">
                            <input type="checkbox" class="form-check-input" id="checkInlineChecked" checked>
                            <label class="form-check-label" for="checkInlineChecked">
                            {{__('New users up to 10 days')}}
                            </label>
                        </div>
                        <div><br></div>
                        <div class="form-check form-check-inline">
                            <input type="checkbox" class="form-check-input" id="checkInlineChecked" checked>
                            <label class="form-check-label" for="checkInlineChecked">
                            {{__('Most bought this month')}}
                            </label>
                        </div>
                        <div><br></div>
                        <div class="form-check form-check-inline">
                            <input type="checkbox" class="form-check-input" id="checkInlineChecked" checked>
                            <label class="form-check-label" for="checkInlineChecked">
                            {{__('Most bought in a long time')}}
                            </label>
                        </div>
                        <div><br></div>

                    </div>
                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">select user</h4>
                                    <div class="mb-3">
                                    <label class="form-label">select user</label>
                                    <select class="js-example-basic-single form-select"  multiple="multiple" name="man_user[]" data-width="100%">
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->email}}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-primary" type="submit">{{__('active now')}}</button>
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
  <script src="{{ asset('assets/plugins/dropzone/dropzone.min.js') }}"></script>
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
  <script src="{{ asset('assets/js/dropzone.js') }}"></script>
  <script src="{{ asset('assets/js/dropify.js') }}"></script>
  <script src="{{ asset('assets/js/bootstrap-colorpicker.js') }}"></script>
  <script src="{{ asset('assets/js/datepicker.js') }}"></script>
  <script src="{{ asset('assets/js/timepicker.js') }}"></script>
@endpush