@extends('dashboard.layout.master')
@push('plugin-styles')
  <link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
@endpush
@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
  
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
        <h6 class="card-title">{{__('building types')}}</h6>
        <a type="button"  href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"> {{__('add building type')}}</a>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>{{__('name/en')}}</th>
                <th>{{__('name/gr')}}</th>
                <th>{{__('created at')}}</th>
                <th class="action">{{__('option')}}</th>
              </tr>
            </thead>
            <tbody>
                @foreach($buildings as $building)
                <tr>
                    <td>{{$building->translate('en')->name}}</td>
                    <td>{{$building->translate('de')->name}}</td>
                    <td>{{$building->created_at}}</td>
                    <td class="action"> 
                    <a  title="{{__('edit')}}" href="#" data-bs-toggle="modal" data-bs-target="#building-{{$building->id}}"><i data-feather="edit"></i></i></a>
                        <a  title="{{__('delete')}}" href="/admin/deleteBuil/{{$building->id}}"  onclick="showSwal('mixin')"><i data-feather="trash"></i></i></a>
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
              <h5 class="modal-title" id="exampleModalLabel">{{__('add building type')}}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
            <form class="forms-sample"  method="POST" enctype="multipart/form-data" action="/admin/addBuild">
            @csrf

            <div class="row mb-6">
                <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('building/en')}}</label>
                    <input class="form-control mb-4 mb-md-0" name="name_en"  required/>
                </div>
                <div class="col-md-6">
                    <label class="form-label">{{__('building/gr')}}:</label>
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

      @foreach($buildings as $building)
    <div class="modal fade" id="building-{{$building->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">{{__('edit building type')}}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
            <form class="forms-sample"  method="POST" enctype="multipart/form-data" action="/admin/updateBuil/{{$building->id}}">
            @csrf

            <div class="row mb-6">
                <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('building/en')}}</label>
                    <input class="form-control mb-4 mb-md-0" name="name_en" value="{{$building->translate('en')->name}}" required/>
                </div>
                <div class="col-md-6">
                    <label class="form-label">{{__('building/gr')}}:</label>
                    <input class="form-control mb-4 mb-md-0" name="name_gr" value="{{$building->translate('de')->name}}" required/>
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