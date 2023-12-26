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
        <h6 class="card-title">{{__('plasters')}}</h6>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>{{__('plaster_type')}}</th>
                <th>{{__('type')}}</th>
                <th>{{__('wall_width')}}</th>
                <th>{{__('wall_hight')}}</th>
                <th>{{__('cornish_type')}}</th>
                <th>{{__('cornish_width')}}</th>
                <th>{{__('cornish_hight')}}</th>
                <th>{{__('text')}}</th>
                <th>{{__('thickness')}}</th>
                <th>{{__('side')}}</th>
                <th>{{__('insulator')}}</th>
                <th>{{__('with_door')}}</th>
                <th>{{__('with_windows')}}</th>
                <th>{{__('door_width')}}</th>
                <th>{{__('door_hight')}}</th>
                <th>{{__('window_width')}}</th>
                <th>{{__('window_hight')}}</th>
                <th>{{__('roof_or_wall')}}</th>
                <th>{{__('distance_of_gypsum')}}</th>
                <th>{{__('with_decor')}}</th>
                <th>{{__('roof_hight')}}</th>
              </tr>
            </thead>
            <tbody>
                @foreach($plasters as $plaster)
                    <tr>
                        <td>{{$plaster['type_plaster']->type}}</td>
                        <td>@if($plaster->type == 1)
                        {{__('cornish')}}@elseif($plaster->type == 2){{__('decor')}}@elseif($plaster->type == 2){{__('wall build')}}@else{{__('roof & wall')}}@endif</td>
                        <td>{{$plaster->wall_width}}</td>
                        <td>{{$plaster->wall_hight}}</td>
                        <td>@if($plaster->cornish_type == 1)
                        {{__('cork')}}@elseif($plaster->cornish_type == 2){{__('wood')}}@else{{__('plaster')}}@endif</td>
                        <td>{{$plaster->cornish_width}}</td>
                        <td>{{$plaster->cornish_hight}}</td>
                        <td>{{$plaster->text}}</td>
                        <td>{{$plaster->thickness}}</td>
                        <td>@if($plaster->side == 1)
                        {{__('one side')}}@else{{__('two side')}}@endif</td>
                        <td>@if($plaster->insulator == 1)
                        {{__('yes')}}@else{{__('no')}}@endif</td>
                        <td>@if($plaster->with_door == 1)
                        {{__('yes')}}@else{{__('no')}}@endif</td>
                        <td>@if($plaster->with_windows == 1)
                        {{__('yes')}}@else{{__('no')}}@endif</td>
                        <td>{{$plaster->door_width}}</td>
                        <td>{{$plaster->door_hight}}</td>
                        <td>{{$plaster->window_width}}</td>
                        <td>{{$plaster->window_hight}}</td>
                        <td>@if($plaster->roof_or_wall == 1)
                        {{__('roof')}}@else{{__('wall')}}@endif</td>
                        <td>{{$plaster->distance_of_gypsum}}</td>
                        <td>@if($plaster->with_decor == 1)
                        {{__('yes')}}@else{{__('no')}}@endif</td>
                        <td>{{$plaster->roof_hight}}</td>
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