@extends('dashboard.layout.master')
@push('plugin-styles')
  <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/jquery-tags-input/jquery.tagsinput.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/bootstrap-colorpicker/bootstrap-colorpicker.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />
@endpush
@push('plugin-styles')
  <link href="{{ asset('assets/plugins/@mdi/css/materialdesignicons.min.css') }}" rel="stylesheet" />
@endpush
@push('plugin-styles')
  <link href="{{ asset('assets/plugins/prismjs/prism.css') }}" rel="stylesheet" />
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
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 style="font-size:20px;" class="card-title">{{__('about us')}}</h6>
        <form class="forms-sample" method="POST" enctype="multipart/form-data" action="/admin/updateAboutUs">
          @csrf
          <div class="row mb-6">

            <div class="col-md-6">
                <label for="exampleInputNumber1" class="form-label">{{__('email support')}}</label>
                <input class="form-control mb-4 mb-md-0" value="{{$about_us->email_support}}" name="email_support"  required/>
            </div>
            <div class="col-md-6">
                <label class="form-label">{{__('mobile')}}:</label>
                <input class="form-control mb-4 mb-md-0" value="{{$about_us->mobile}}" name="mobile"  required/>
            </div>
            <div >
                <br>
            </div>
            <div class="col-md-6">
                <label for="exampleInputNumber1" class="form-label">{{__('phone')}}</label>
                <input class="form-control mb-4 mb-md-0" value="{{$about_us->phone}}" name="phone"  required/>
            </div>
            <div class="col-md-6">
                <label class="form-label">{{__('faceBook')}}:</label>
                <input class="form-control mb-4 mb-md-0" value="{{$about_us->faceBook}}" name="faceBook"  required/>
            </div>
            <div >
                <br>
            </div>
            <div class="col-md-6">
                <label for="exampleInputNumber1" class="form-label">{{__('whatsapp')}}</label>
                <input class="form-control mb-4 mb-md-0" value="{{$about_us->whatsapp}}" name="whatsapp"  required/>
            </div>
            <div class="col-md-6">
                <label class="form-label">{{__('twitter')}}:</label>
                <input class="form-control mb-4 mb-md-0" value="{{$about_us->twitter}}" name="twitter"  required/>
            </div>
            <div >
                <br>
            </div>
            <div class="col-md-6">
                <label for="exampleInputNumber1" class="form-label">{{__('Instagram')}}</label>
                <input class="form-control mb-4 mb-md-0" value="{{$about_us->Instagram}}" name="Instagram"  required/>
            </div>
            <div class="col-md-6">
                <label class="form-label">{{__('telegram')}}:</label>
                <input class="form-control mb-4 mb-md-0" value="{{$about_us->telegram}}" name="telegram"  required/>
            </div>
            <div >
                <br>
            </div>
            <div class="col-md-6">
                <label for="exampleInputText1" class="form-label">{{__('bio/en')}}</label>
                <textarea style="height: 150px;" class="form-control" name="bio_en" required>{{$about_us->translate('en')->bio}}</textarea>
            </div>
            <div class="col-md-6">
                <label for="exampleInputText1" class="form-label">{{__('bio/gr')}}</label>
                <textarea style="height: 150px;" class="form-control" name="bio_gr" required>{{$about_us->translate('de')->bio}}</textarea>
            </div>
          </div>
          <button class="btn btn-primary" type="submit">{{__('save')}}</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/prismjs/prism.js') }}"></script>
  <script src="{{ asset('assets/plugins/clipboard/clipboard.min.js') }}"></script>

@endpush
@push('custom-scripts')
  <script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush
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