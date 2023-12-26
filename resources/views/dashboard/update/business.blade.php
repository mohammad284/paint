@extends('dashboard.layout.master')
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
        <h6 class="card-title">{{__('Business')}}</h6>
        <a type="button"  href="#" data-bs-toggle="modal" data-bs-target="#business"> {{__('add bussiness')}}</a>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>{{__('name/en')}}</th>
                <th>{{__('name/de')}}</th>
                <th>{{__('icon')}}</th>
                <th class="action">{{__('option')}}</th>
              </tr>
            </thead>
            <tbody>
                @foreach($businesses as $business)
                <tr>
                    <td>{{$business->translate('en')->name}}</td>
                    <td>{{$business->translate('de')->name}}</td>
                    <td><img style="height:50px;width:50px;" src="{{ asset($business['icons']->icon) }}"  alt="Product Image"></td>
                    <td class="action"> 
                    <a  title="{{__('edit')}}" href="#" data-bs-toggle="modal" data-bs-target="#business-{{$business->id}}"><i data-feather="edit"></i></i></a>
                    <a  title="{{__('sub')}}" href="/admin/subBusiness/{{$business->id}}">sub-></a>
                    <a  title="{{__('delete')}}" type="button" href="/admin/deleteBusiness/{{$business->id}}"><i data-feather="trash"></i></i></a>
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
{{-- add business --}}
    <div class="modal fade" id="business" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{__('add business')}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
          </div>
          <div class="modal-body">
          <form class="forms-sample"  method="POST" enctype="multipart/form-data" action="/admin/addBusiness">
          @csrf

          <div class="row mb-12">
              <div class="col-md-12">
                  <label for="exampleInputNumber1" class="form-label">{{__('name/en')}}</label>
                  <input class="form-control mb-4 mb-md-0" name="name_en"  required/>
              </div>
              <div class="col-md-12">
                  <label for="exampleInputNumber1" class="form-label">{{__('name/de')}}</label>
                  <input class="form-control mb-4 mb-md-0" name="name_de"  required/>
              </div>
              <div >
              <br>
            </div>
              <div class="col-md-12">
                  <div class="card">
                      <div class="card-body">
                          <h6 class="card-title">{{__('icon')}}</h6>
                          <input type="file" id="myDropify" name="icon" required/>
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
      @foreach($businesses as $business)
    <div class="modal fade" id="business-{{$business->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">{{__('edit business')}}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
            <form class="forms-sample"  method="POST" enctype="multipart/form-data" action="/admin/updateBus/{{$business->id}}">
            @csrf

            <div class="row mb-12">
                <div class="col-md-12">
                    <label for="exampleInputNumber1" class="form-label">{{__('name/en')}}</label>
                    <input class="form-control mb-4 mb-md-0" name="name_en" value="{{$business->translate('en')->name}}" required/>
                </div>
                <div class="col-md-12">
                    <label for="exampleInputNumber1" class="form-label">{{__('name/de')}}</label>
                    <input class="form-control mb-4 mb-md-0" name="name_de" value="{{$business->translate('de')->name}}" required/>
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