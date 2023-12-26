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
        <h6 class="card-title">{{__('تفاصيل مناقصات اللكر')}}</h6>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>{{__('النوع')}}</th>
                <th>{{__('الحالة القديمة')}}</th>
                <th>{{__('الحالة الجديدة')}}</th>
                <th>{{__('اللون القديم')}}</th>
                <th>{{__('اللون الجديد')}}</th>
                <th>{{__('الضرر')}}</th>
                <th>{{__('منطقة العمل')}}</th>
                <th>{{__('العدد')}}</th>
              </tr>
            </thead>
            <tbody>
                @foreach($glossies as $glossy)
                    <tr>
                        @if($glossy->type == 1)
                            <td>{{__('نوافذ')}}</td>@elseif($glossy->type == 2)<td>{{__('ابواب')}}</td>
                            @elseif($glossy->type == 3)<td>{{__('الات')}}</td>
                            @elseif($glossy->type == 4)<td>{{__('معدات ثقيلة')}}</td>
                            @elseif($glossy->type == 5)<td>{{__('اخر')}}</td>
                        @endif
                        <td>{{$glossy->old_status}}</td>
                        <td>{{$glossy->new_status}}</td>
                        @if($glossy['oldcolor'] == null)
                        <td><span class="badge bg-success" style="background-color:; margin-right:60%;">####</td>
                        @endif
                        @if($glossy['oldcolor'] != null)
                        <td><span class="badge bg-success" style="background-color:#{{$glossy['oldcolor']->hex}}; margin-right:60%;">{{$glossy['oldcolor']->name}}</td>
                        @endif
                        @if($glossy['newcolor'] == null)
                        <td><span class="badge bg-success" style="background-color:; margin-right:60%;">####</td>
                        @endif
                        @if($glossy['newcolor'] != null)
                        <td><span class="badge bg-success" style="background-color:#{{$glossy['newcolor']->hex}}; margin-right:60%;">{{$glossy['newcolor']->name}}</td>
                        @endif
                        <td>{{$glossy->damage}}%</td>
                        @if($glossy->paint_place == 1)
                            <td>{{__('الاطار')}}</td>@elseif($glossy->paint_place == 2)<td>{{__('داخل الاطار')}}</td>
                            @elseif($glossy->paint_place == 3)<td>{{__('الاثنين معا')}}</td>
                        @endif
                        <td>{{$glossy->count}}</td>
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