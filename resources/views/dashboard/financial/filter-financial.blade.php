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
        <h6 class="card-title">{{__('financial report')}}</h6>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <td>#</td>
                <th>{{__('user name')}}</th>
                <th>{{__('payment')}}</th>
                <th>{{__('created_at')}}</th>
              </tr>
            </thead>
            <tbody>
            <?php $i = 1 ?>
                @foreach($payments as $payment)
                <tr>
                  <td>{{$i}}</td>
                  <td>{{$payment['user']->first_name}} {{$payment['user']->last_name}}</td>
                  <td>{{$payment->payment}}</td>
                  <td>{{$payment->created_at}}</td>
                </tr>
                <?php $i=$i+1 ?>
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