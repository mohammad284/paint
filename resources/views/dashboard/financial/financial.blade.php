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
        <a type="button"  href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"> {{__('filter')}}</a>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <td>#</td>
                <th>{{__('Total amount')}}</th>
                <th>{{__('date')}}</th>
                <th class="action">{{__('option')}}</th>
              </tr>
            </thead>
            <tbody>
            <?php $i = 1 ?>
                @foreach($payments as $payment)
                <tr>
                  <td>{{$i}}</td>
                  <td>{{$payment['sums']}}</td>
                  <td>{{$payment['months']}}</td>
                  <td class="action"> 
                  <form class="forms-sample"  method="POST" enctype="multipart/form-data" action="/admin/paymentDetails">
                      @csrf
                        <input class="form-control mb-4 mb-md-0" type="hidden" value="{{$payment['months']}}" name="date"  required/>
                        <button type="submit" class="btn btn-primary me-2">{{__('more details')}}</button>
                  </form>
                  </td>
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
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{__('filter')}}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
      </div>
      <div class="modal-body">
        <form class="forms-sample"  method="POST" enctype="multipart/form-data" action="/admin/paymentFilter">
          @csrf

          <div class="row mb-6">
            <div class="col-md-6">
                <label for="exampleInputNumber1" class="form-label">{{__('from time')}}</label>
                <input type="date" class="form-control mb-4 mb-md-0" name="from"  required/>
            </div>
            <div class="col-md-6">
                <label class="form-label">{{__('to time')}}:</label>
                <input type="date" class="form-control mb-4 mb-md-0" name="to"  required/>
            </div>
          </div>
          <button type="submit" class="btn btn-primary me-2">{{__('go')}}</button>
        </form>
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