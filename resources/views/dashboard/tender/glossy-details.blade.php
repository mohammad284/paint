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
        <h6 class="card-title">{{__('glossies')}}</h6>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>{{__('type')}}</th>
                <th>{{__('was paint')}}</th>
                <th>{{__('was paste')}}</th>
                <th>{{__('with paint')}}</th>
                <th>{{__('with paste')}}</th>
                <th>{{__('Peeling the old case')}}</th>
                <th>{{__('old color')}}</th>
                <th>{{__('new color')}}</th>
                <th>{{__('damage')}}</th>
                <th>{{__('paint_place')}}</th>
                <th>{{__('count')}}</th>
              </tr>
            </thead>
            <tbody>
                @foreach($glossies as $glossy)
                    <tr>
                        @if($glossy->type == 1)
                            <td>{{__('windows')}}</td>@elseif($glossy->type == 2)<td>{{__('door')}}</td>
                            @elseif($glossy->type == 3)<td>{{__('machinery')}}</td>
                            @elseif($glossy->type == 4)<td>{{__('heavy_equipment')}}</td>
                            @elseif($glossy->type == 5)<td>{{$glossy->type}}</td>
                        @endif
                        @if($glossy->old_status_paint == 1)
                        <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td>@endif
                        @if($glossy->old_status_paste == 1)
                        <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td>@endif

                        @if($glossy->new_status_paint == 1)
                        <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td>@endif
                        @if($glossy->new_status_paste == 1)
                        <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td>@endif

                        @if($glossy->peeling_wallpaper == 1)
                        <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td>@endif
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
                            <td>{{__('out')}}</td>@elseif($glossy->paint_place == 2)<td>{{__('in')}}</td>
                            @elseif($glossy->paint_place == 3)<td>{{__('both')}}</td>
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