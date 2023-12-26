@extends('dashboard.layout.master')
@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/@mdi/css/materialdesignicons.min.css') }}" rel="stylesheet" />
@endpush
@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
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
@if(session()->has('message'))
<p class="message-box" >
    {{ session()->get('message') }}
</p>
@endif

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">{{__('address')}}</h6>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>{{__('objectId')}}</th>
                <th>{{__('Postal Code')}}</th>
                <th>{{__('Country Code')}}</th>
                <th>{{__('Place Name')}}</th>
                <th>{{__('Admin Name')}}</th>
                <th>{{__('Latitude')}}</th>
                <th>{{__('Longitude')}}</th>
                <th>{{__('Admin Code3')}}</th>
                <th>{{__('Admin Name3')}}</th>
                <th>{{__('Accuracy')}}</th>
                <th>{{__('Admin Code')}}</th>
                <th class="action">{{__('option')}}</th>
              </tr>
            </thead>
            <tbody>
                @foreach($address as $addres)
                <tr>
                    <td>{{$addres->objectId}}</td>
                    <td>{{$addres->Postal_Code}}</td>
                    <td>{{$addres->CountryCode}}</td>
                    <td>{{$addres->Place_Name}}</td>
                    <td>{{$addres-> Admin_Name}}</td>
                    <td>{{$addres->Latitude}}</td>
                    <td>{{$addres->Longitude}}</td>
                    <td>{{$addres->Admin_Code3}}</td>
                    <td>{{$addres->Admin_Name3}}</td>
                    <td>{{$addres-> Accuracy}}</td>
                    <td>{{$addres->Admin_Code }}</td>
                    <td class="action"> 
                    <!-- <a  title="{{__('edit')}}" href="#" data-bs-toggle="modal" data-bs-target="#addres-{{$addres->id}}"><i data-feather="edit"></i></i></a> -->
                        <a  title="{{__('delete')}}" href="/admin/deleteAddress/{{$addres->id}}" onclick="showSwal('mixin')"><i data-feather="trash"></i></i></a>
                    </td>
                </tr>
              @endforeach
            </tbody>
          </table>
          {!! $address->links() !!}
        </div>
      </div>
    </div>
  </div>
</div>
@foreach($address as $addres)
<div class="modal fade" id="addres-{{$addres->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">{{__('edit address')}}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
            <form class="forms-sample"  method="POST" enctype="multipart/form-data" action="/admin/updateAdress/{{$addres->id}}">
            @csrf

            <div class="row mb-6">
                <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('objectId')}}</label>
                    <input class="form-control mb-4 mb-md-0" name="objectId" value="{{$addres->objectId}}" required/>
                </div>
                <div class="col-md-6">
                    <label class="form-label">{{__('Postal_Code')}}:</label>
                    <input class="form-control mb-4 mb-md-0" name="Postal_Code" value="{{$addres->Postal_Code}}" required/>
                </div>
                <div >
                <br>
              </div>
              <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('CountryCode')}}</label>
                    <input class="form-control mb-4 mb-md-0"  name="CountryCode" value="{{$addres->CountryCode}}"  required/>
                </div>
                <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('Place_Name')}}</label>
                    <input class="form-control mb-4 mb-md-0"  name="Place_Name" value="{{$addres->Place_Name}}" required/>
                </div>
                <div >
                <br>
              </div>
              <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('Latitude')}}</label>
                    <input class="form-control mb-4 mb-md-0"  name="Latitude" value="{{$addres->Latitude}}"  required/>
                </div>
                <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('Longitude')}}</label>
                    <input class="form-control mb-4 mb-md-0"  name="Longitude" value="{{$addres->Longitude}}" required/>
                </div>
                <div >
                <br>
              </div>
              <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('Admin_Name')}}</label>
                    <input class="form-control mb-4 mb-md-0"  name="Admin_Name" value="{{$addres->Admin_Name}}"  required/>
                </div>
                <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('Admin_Code3')}}</label>
                    <input class="form-control mb-4 mb-md-0"  name="Admin_Code3" value="{{$addres->Admin_Code3}}" required/>
                </div>
                <div >
                <br>
              </div>
              <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('Admin_Name3')}}</label>
                    <input class="form-control mb-4 mb-md-0"  name="Admin_Name3" value="{{$addres->Admin_Name3}}"  required/>
                </div>
                <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('Accuracy')}}</label>
                    <input class="form-control mb-4 mb-md-0"  name="Accuracy" value="{{$addres->Accuracy}}" required/>
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