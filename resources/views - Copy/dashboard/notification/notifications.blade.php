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
      $lang = "gr";
  }
?>
  @if($lang == 'en')
  <link href="{{ asset('assets/massageltr.css') }}" rel="stylesheet" />
  @else
  <link href="{{ asset('assets/massage.css') }}" rel="stylesheet" />
  @endif
@endpush
<!-- Message -->
@if(session()->has('message'))
<p class="message-box" >
    {{ session()->get('message') }}
</p>
@endif
<!-- ./Message -->
@section('content')


<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">{{__('الاشعارات')}}</h6>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>{{__('الاشعار')}}</th>
                <th>{{__('المرسل')}}</th>
                <th>{{__('ايميل المرسل')}}</th>
                <th>{{__('المستلم')}}</th>
                <th>{{__('ايميل المستلم')}}</th>
                <th>{{__('تم اضافته بتاريخ')}}</th>
                <th class="action">{{__('الخيارات')}}</th>
              </tr>
            </thead>
            <tbody>
                @foreach($notifications as $not)
                <tr>
                    <td>{{$not->translate($lang)->notification}}</td>
                    @if($not->sender  == 0)
                    <td>{{__('admin')}}</td>
                    <td>{{__('admin')}}</td>@else
                    <td>{{$not['send']->first_name}}</td>
                    <td>{{$not['send']->email}}</td>@endif
                    @if($not->reciver == 0)
                    <td>{{('admin')}}</td>
                    <td>{{('admin')}}</td>@else
                    <td>{{$not['recive']->first_name}}</td>
                    <td>{{$not['recive']->email}}</td>@endif
                    <td>{{$not->created_at}}</td>
                    <td class="action"> 
                          <a type="button" class="btn btn-primary" href="/admin/deleteNot/{{$not->id}}" onclick="showSwal('mixin')"><i data-feather="trash"></i></i></a>
                    </td>
                </tr>
              @endforeach
            </tbody>
          </table>
          {!! $notifications->links() !!}
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
@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/sweet-alert.js') }}"></script>
@endpush