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
            <h6 class="card-title">{{__('payments')}}</h6>
            <div class="table-responsive">
            <table id="dataTableExample" class="table">
                <thead>
                <tr>
                <th>{{__('first name')}}</th>
                <th>{{__('last name')}}</th>
                <th>{{__('email')}}</th>
                <th>{{__('payment type')}}</th>
                <th>{{__('payment')}}</th>
                <th>{{__('created at')}}</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($payments as $payment)
                    <tr>
                        <td>{{$payment['user']->first_name}}</td>
                        <td>{{$payment['user']->last_name}}</td>
                        <td>{{$payment['user']->email}}</td>
                        @if($payment->package_id == null)
                        <td>{{__('tender')}}</td>
                        @else<td>{{__('package')}}</td>
                        @endif
                        <td>{{$payment->payment}}</td>
                        <td>{{$payment->created_at}}</td>
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
@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/sweet-alert.js') }}"></script>
@endpush