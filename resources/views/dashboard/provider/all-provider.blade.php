@extends('dashboard.layout.master')
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
        <h6 class="card-title">{{__('Service Provider')}}</h6>
        <a type="button"  href="/admin/addProvider" > {{__('add new provider')}}</a>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>{{__('first name')}}</th>
                <th>{{__('last name')}}</th>
                <th>{{__('email')}}</th>
                <th>{{__('mobile')}}</th>
                <th>{{__('rate')}}</th>
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
                    <td>{{$provider->rate}}</td>
                    @if($provider->gender == '1')<td>{{__('male')}}</td> @endif 
                    @if($provider->gender == '0')<td>{{__('female')}}</td> @endif 
                    @if($provider->gender == '2')<td>{{__('other')}}</td> @endif 
                    <td>{{$provider['postal']->Postal_Code}}</td>
                    <td>{{$provider['postal']->Place_Name}}</td>
                    <td>{{$provider->created_at}}</td> 
                    <td class="action"> 
                      <a  title="{{__('more details')}}" style="font-size:25px;" href="/admin/spicialProvider/{{$provider->id}}">@if($provider->spicial == 1) <i class="mdi mdi-star"></i> @else <i class="mdi mdi-star-outline"></i>@endif </a>
                      <a  title="{{__('more details')}}" href="/admin/detailsProvider/{{$provider->id}}"> <i data-feather="eye"></i></i></a>
                      <a  title="{{__('block')}}" href="/admin/blockProvider/{{$provider->id}}"><i data-feather="slash"></i></i></a>
                      <a  title="{{__('delete')}}" href="/admin/deleteProvider/{{$provider->id}}"><i data-feather="trash"></i></i></a>
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

@endsection
@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush