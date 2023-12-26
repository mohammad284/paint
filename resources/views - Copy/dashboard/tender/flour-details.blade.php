@extends('dashboard.layout.master')
@push('plugin-styles')
  <link href="{{ asset('assets/plugins/@mdi/css/materialdesignicons.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/prismjs/prism.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
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
@section('content')


<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">{{__('تفاصيل مناقصة الارضيات')}}</h6>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>{{__('الارتفاع')}}</th>
                <th>{{__('العرض')}}</th>
                <th>{{__('الحالة القديمة')}}</th>
                <th>{{__('الحالة الجديدة')}}</th>
                <th>{{__('اللون القديم')}}</th>
                <th>{{__('اللون الجديد')}}</th>
                <th>{{__('الضرر')}}</th>
                <th>{{__('النوع')}}</th>
                <th>{{__('النوع الخارجي')}}</th>
              </tr>
            </thead>
            <tbody>
                @foreach($flours as $flour)
                    <tr>
                        <td>{{$flour->height}}</td>
                        <td>{{$flour->width}}</td>
                        <td>{{$flour->old_status}}</td>
                        <td>{{$flour->new_status}}</td>
                        @if($flour['oldcolor'] == null)
                        <td><span class="badge bg-success" style="background-color:; margin-right:60%;">####</td>
                        @endif
                        @if($flour['oldcolor'] != null)
                        <td><span class="badge bg-success" style="background-color:#{{$flour['oldcolor']->hex}}; margin-right:60%;">{{$flour['oldcolor']->name}}</td>
                        @endif
                        @if($flour['newcolor'] == null)
                        <td><span class="badge bg-success" style="background-color:; margin-right:60%;">####</td>
                        @endif
                        @if($flour['newcolor'] != null)
                        <td><span class="badge bg-success" style="background-color:#{{$flour['newcolor']->hex}}; margin-right:60%;">{{$flour['newcolor']->name}}</td>
                        @endif
                        <td>{{$flour->damage}}%</td>
                        @if($flour->type == 0)
                            <td>{{__('none')}}</td>@elseif($flour->type == 1)<td>{{__('ممر')}}</td>
                            @elseif($flour->type == 2)<td>{{__('درج')}}</td>
                        @endif
                        @if($flour->out_type == 0)
                            <td>{{__('none')}}</td>@elseif($flour->out_type == 1)<td>{{__('كراج')}}</td>
                            @elseif($flour->out_type == 2)<td>{{__('ملعب')}}</td>
                            @elseif($flour->out_type == 3)<td>{{__('درج')}}</td>
                            @elseif($flour->out_type == 4)<td>{{__('شارع')}}</td>
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