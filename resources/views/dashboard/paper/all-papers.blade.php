@extends('dashboard.layout.master')
@push('plugin-styles')
  <link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
@endpush
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
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush
@push('plugin-styles')
  <link href="{{ asset('assets/plugins/@mdi/css/materialdesignicons.min.css') }}" rel="stylesheet" />
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
        <h6 class="card-title">{{__('wallpaper type')}}</h6>
        <a type="button"  href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"> {{__('Add a new wallpaper type')}}</a>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>{{__('name/en')}}</th>
                <th>{{__('name/gr')}}</th>
                <!-- <th>{{__('created at')}}</th> -->
                <th class="action">{{__('option')}}</th>
              </tr>
            </thead>
            <tbody>
                @foreach($papers as $paper)
                <tr>
                    <td>{{$paper->translate('en')->name}}</td>
                    <td>{{$paper->translate('de')->name}}</td>
                    <!-- <td>{{$paper->created_at}}</td> -->
                    <td class="action"> 
                      <a  title="{{__('edit')}}" href="#" data-bs-toggle="modal" data-bs-target="#paper-{{$paper->id}}"><i data-feather="edit"></i></i></a>
                      <a  title="{{__('delete')}}" href="/admin/deletePaper/{{$paper->id}}" onclick="showSwal('mixin')"><i data-feather="trash"></i></i></a>
                    </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">{{__('Add a new wallpaper type')}}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
            <form class="forms-sample"  method="POST" enctype="multipart/form-data" action="/admin/addPaper">
            @csrf

            <div class="row mb-12">
                <div class="col-md-12">
                    <label for="exampleInputNumber1" class="form-label">{{__('name/en')}}</label>
                    <input class="form-control mb-4 mb-md-0" name="name_en"  required/>
                </div>
                <div class="col-md-12">
                    <label for="exampleInputNumber1" class="form-label">{{__('name/gr')}}</label>
                    <input class="form-control mb-4 mb-md-0" name="name_gr"  required/>
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
@foreach($papers as $paper)
    <div class="modal fade" id="paper-{{$paper->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">{{__('edit wallpaper')}}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
                <form class="forms-sample"  method="POST" enctype="multipart/form-data" action="/admin/updatePaper/{{$paper->id}}">
                    @csrf

                    <div class="row mb-12">
                        <div class="col-md-12">
                        <label for="exampleInputNumber1" class="form-label">{{__('name/en')}}</label>
                        <input class="form-control mb-4 mb-md-0" value="{{$paper->translate('en')->name}}" name="name_en"  required/>
                    </div>
                    <div class="col-md-12">
                        <label for="exampleInputNumber1" class="form-label">{{__('name/gr')}}</label>
                        <input class="form-control mb-4 mb-md-0" value="{{$paper->translate('de')->name}}" name="name_gr"  required/>
                    </div>
                        <div >
                        <br>
                    </div>
                    </div>

                    <button type="submit" class="btn btn-primary me-2">{{__('edit')}}</button>
                </form>
            </div>
              
          </div>
        </div>
    </div>
@endforeach
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
@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/sweet-alert.js') }}"></script>
@endpush