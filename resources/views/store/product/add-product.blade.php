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
  <link href="{{ asset('assets/plugins/@mdi/css/materialdesignicons.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/prismjs/prism.css') }}" rel="stylesheet" />
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
<!-- Message -->
@if(session()->has('message'))
<p class="message-box" >
    {{ session()->get('message') }}
</p>
@endif

@section('content')

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{__('add new product')}}</h4>
            <form class="forms-sample"  method="POST" enctype="multipart/form-data" action="/admin/storeNewProduct">
                @csrf

                <div class="row mb-12">
                    <div class="col-md-6">
                        <label for="exampleInputNumber1" class="form-label">{{__('product name/en')}}</label>
                        <input class="form-control mb-4 mb-md-0" name="product_name_en"  required/>
                    </div>
                    <div class="col-md-6">
                        <label for="exampleInputNumber1" class="form-label">{{__('product name/gr')}}</label>
                        <input class="form-control mb-4 mb-md-0" name="company_name_gr"  required/>
                    </div>
                    <div >
                        <br>
                    </div>
                    <div class="col-md-6">
                        <label for="exampleInputNumber1" class="form-label">{{__('company name/gr')}}</label>
                        <input class="form-control mb-4 mb-md-0" name="company_name"  required/>
                    </div>
                    <div class="col-md-6">
                        <label for="exampleInputNumber1" class="form-label">{{__('amount')}}</label>
                        <input class="form-control mb-4 mb-md-0" name="amount"  required/>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label"> {{__('color')}} </label>
                        <select class="js-example-basic-single form-select" id="" name="color_id"  data-width="100%" >
                        <option selected="" value="" disabled>{{__('select color')}}</option>
                            @foreach($colors as $color)
                                <option value='{{ $color->id }}'>{{$color->name}}</option>
                            @endforeach 
                        </select>
                    </div>
                    <div >
                        <br>
                    </div>
                    <div class="col-md-6">
                        <label for="exampleInputNumber1" class="form-label">{{__('Selling price')}}</label>
                        <input class="form-control mb-4 mb-md-0" name="Selling_price"  required/>
                    </div>
                    <div class="col-md-6">
                        <label for="exampleInputNumber1" class="form-label">{{__('buying price')}}</label>
                        <input class="form-control mb-4 mb-md-0" name="buying_price"  required/>
                    </div>
                    <div >
                        <br>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label"> {{__('size')}} </label>
                        <select class="js-example-basic-single form-select" id="" name="size_id"  data-width="100%" >
                        <option selected="" value="" disabled>{{__('select size')}}</option>
                            @foreach($sizes as $size)
                                <option value='{{ $size->id }}'>{{$size->size}}</option>
                            @endforeach 
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label"> {{__('category')}} </label>
                        <select class="js-example-basic-single form-select" id="" name="category_id"  data-width="100%" >
                        <option selected="" value="" disabled>{{__('select category')}}</option>
                            @foreach($categories as $category)
                                <option value='{{ $category->id }}'>{{$category->translate('en')->name}}</option>
                            @endforeach 
                        </select>
                    </div>
                    <div class="row">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">{{__('image')}}</h6>
                                <input type="file"  name="image[]"  multiple="multiple" required/>
                            </div>
                        </div>
                    </div>
                    <div >
                        <br>
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