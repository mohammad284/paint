@extends('dashboard.layout.master')
@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/@mdi/css/materialdesignicons.min.css') }}" rel="stylesheet" />
@endpush
@push('plugin-styles')
  <link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
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
<!-- Message -->
@if ($errors->any())
    <div class="message-box">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ __($error) }}</li>
            @endforeach
        </ul>
    </div>
@endif
<!-- ./Message -->
@section('content')


<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">{{__('notifications text')}}</h6>
        {{-- <a type="button"  href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"> {{__('Add a new notifications text')}}</a> --}}
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>{{__('not_en')}}</th>
                <th>{{__('not_gr')}}</th>
                <th>{{__('type')}}</th>
                <th>{{__('created at')}}</th>
                <th class="action">{{__('option')}}</th>
              </tr>
            </thead>
            <tbody>
                @foreach($all_texts as $text)
                <tr>
                    <td>{{$text->not_en}}</td>
                    <td>{{$text->not_gr}}</td>
                    <td>{{$text->type}}</td>
                    <td>{{$text->created_at}}</td>
                    <td class="action"> 
                    <a  title="{{__('edit')}}" href="#" data-bs-toggle="modal" data-bs-target="#text-{{$text->id}}"><i data-feather="edit"></i></i></a>
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
              <h5 class="modal-title" id="exampleModalLabel">{{__('Add a new not text')}}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
            <form class="forms-sample"  method="POST" enctype="multipart/form-data" action="/admin/addNotText">
            @csrf

            <div class="row mb-12">
                <div class="col-md-12">
                    <label for="exampleInputNumber1" class="form-label">{{__('not_en')}}</label>
                    <input class="form-control mb-4 mb-md-0" name="not_en"  required/>
                </div>
                <div class="col-md-12">
                    <label for="exampleInputNumber1" class="form-label">{{__('not_gr')}}</label>
                    <input class="form-control mb-4 mb-md-0" name="not_gr"  required/>
                </div>

                <div >
                <br>
              </div>
              <div class="col-md-12">
                    <label for="exampleInputNumber1" class="form-label">{{__('type')}}</label>
                    <input class="form-control mb-4 mb-md-0" name="type"  required/>
                </div>
            </div>

            <button type="submit" class="btn btn-primary me-2">{{__('save')}}</button>
        </form>
            </div>
              
          </div>
        </div>
      </div>
    @foreach($all_texts as $text)
    <div class="modal fade" id="text-{{$text->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">{{__('edit text')}}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
            <form class="forms-sample"  method="POST" enctype="multipart/form-data" action="/admin/updateNotText/{{$text->id}}">
            @csrf

            <div class="row mb-12">
                <div class="col-md-12">
                    <label for="exampleInputNumber1" class="form-label">{{__('not_en')}}</label>
                    <textarea id="maxlength-textarea" class="form-control" name = "not_en"  rows="6" >{{$text->not_en}}</textarea>
                </div>
                <div class="col-md-12">
                    <label for="exampleInputNumber1" class="form-label">{{__('not_gr')}}</label>
                    <textarea id="maxlength-textarea" class="form-control"  name = "not_gr"  rows="6" >{{$text->not_gr}}</textarea>
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