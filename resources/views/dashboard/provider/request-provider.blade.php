@extends('dashboard.layout.master')
@push('plugin-styles')
  <link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
@endpush
@push('plugin-styles')
  <link href="{{ asset('assets/plugins/@mdi/css/materialdesignicons.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/prismjs/prism.css') }}" rel="stylesheet" />
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
        <h6 class="card-title">{{__('requested')}}</h6>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
              <th>{{__('first name')}}</th>
                <th>{{__('last name')}}</th>
                <th>{{__('email')}}</th>
                <th>{{__('mobile')}}</th>
                <th>{{__('gender')}}</th>
                <th>{{__('postal code')}}</th>
                <th>{{__('city')}}</th>
                <th>{{__('created at')}}</th>
                <th class="action">{{__('option')}}</th>
              </tr>
            </thead>
            <tbody>
                @foreach($providers as $provider)
                <tr>
                <td>{{$provider->first_name}}</td>
                    <td>{{$provider->last_name}}</td>
                    <td>{{$provider->email}}</td>
                    <td>{{$provider->mobile}}</td>
                    @if($provider->gender == '1')<td>{{__('male')}}</td> @endif 
                    @if($provider->gender == '0')<td>{{__('female')}}</td> @endif 
                    @if($provider->gender == '2')<td>{{__('other')}}</td> @endif 
                    <td>{{$provider['postal']->Postal_Code}}</td>
                    <td>{{$provider['postal']->Place_Name}}</td>
                    <td>{{$provider->created_at}}</td>
                    <td class="action"> 
                      <a  type="button"  title="{{__('more details')}}" href="/admin/detailsProvider/{{$provider->id}}"> <i data-feather="eye"></i></i></a>
                      <a  type="button"  title="{{__('accept')}}" href="#" data-bs-toggle="modal" data-bs-target="#accept-{{$provider->id}}"> <i data-feather="check-square"></i></i></a>
                      <a  type="button"  title="{{__('delete')}}" href="/admin/deleteProvider/{{$provider->id}}"  onclick="showSwal('mixin')"><i data-feather="trash"></i></i></a>
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
@foreach($providers as $provider)
    <div class="modal fade" id="accept-{{$provider->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">{{__('certificates/licences')}}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
                <form class="forms-sample"  method="POST" enctype="multipart/form-data" action="/admin/acceptProvider/{{$provider->id}}">
                    @csrf
                      <h3 style="font-weight:bold;padding:15px;"> Certificates </h3>
                      <div class="mb-3">
                        <div class="form-check form-check-inline">
                          <input type="checkbox" name="certificates[]" value="master" class="form-check-input" id="checkInlineChecked" >
                          <label class="form-check-label" for="checkInlineChecked">
                          master
                          </label>
                        </div>
                      </div>
                      <div class="mb-3">
                        <div class="form-check form-check-inline">
                          <input type="checkbox" name="certificates[]" value="deploma" class="form-check-input" id="checkInlineChecked" >
                          <label class="form-check-label" for="checkInlineChecked">
                          deploma
                          </label>
                        </div>
                      </div>
                      <h3 style="font-weight:bold;padding:15px;"> Licences </h3>
                    @foreach($provider['licences'] as $licence)
                      <div class="mb-3">
                        <div class="form-check form-check-inline">
                          <input type="checkbox" name="works[]" value="{{$licence->id}}" class="form-check-input" id="checkInlineChecked" >
                          <label class="form-check-label" for="checkInlineChecked">
                          {{$licence['business']->name}}
                          </label>
                        </div>
                      </div>
                    @endforeach
                    <button type="submit" class="btn btn-primary me-2">{{__('accept')}}</button>
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