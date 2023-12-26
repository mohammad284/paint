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
@section('content')


<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">{{__('flour')}}</h6>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>{{__('height')}}</th>
                <th>{{__('width')}}</th>
                <th>{{__('old status')}}</th>
                <th>{{__('new status')}}</th>
                <th>{{__('damage')}}</th>
                <th>{{__('type')}}</th>
                <th>{{__('External types')}}</th>
              </tr>
            </thead>
            <tbody>
                @foreach($flours as $flour)
                    <tr>
                        <td>{{$flour->height}}</td>
                        <td>{{$flour->width}}</td>
                        @if($flour->old_status == 1)<td>{{__('tar')}}</td>@elseif($flour->old_status == 2)
                        <td>{{__('Wood')}}</td>@else<td>{{__('Cement')}}</td>@endif
                        <td>{{__('paint')}}</td>
                        <td>{{$flour->damage}}%</td>
                        @if($flour->type == 0)
                            <td>{{__('none')}}</td>@elseif($flour->type == 1)<td>{{__('corridor')}}</td>
                            @elseif($flour->type == 2)<td>{{__('stairs')}}</td>
                        @endif
                        @if($flour->out_type == 0)
                            <td>{{__('none')}}</td>@elseif($flour->out_type == 1)<td>{{__('garag')}}</td>
                            @elseif($flour->out_type == 2)<td>{{__('stadium')}}</td>
                            @elseif($flour->out_type == 3)<td>{{__('stairs')}}</td>
                            @elseif($flour->out_type == 4)<td>{{__('street')}}</td>
                        @endif
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