@extends('dashboard.layout.master')
@push('plugin-styles')
  <link href="{{ asset('assets/plugins/owl-carousel/assets/owl.carousel.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/owl-carousel/assets/owl.theme.default.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/animate-css/animate.min.css') }}" rel="stylesheet" />
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
@section('content')


<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">{{__('rooms')}}</h6>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>{{__('room type')}}</th>
                <th>{{__('number of walls')}}</th>
                <th>{{__('number of windows')}}</th>
                <th>{{__('number of roofs')}}</th>
                <th>{{__('number of doors')}}</th>
                <th>{{__('number of edge')}}</th>
                <th>{{__('corridor')}}</th>
                <th>{{__('stairs')}}</th>
                <th>{{__('furnished')}}</th>
                <th class="action">{{__('option')}}</th>
              </tr>
            </thead>
            <tbody>
                @foreach($rooms as $room)
                    <tr>
                        @if($room->type == 1) <td>{{__('Salon')}}</td>@elseif($room->type == 2)<td>{{__('room')}}</td>
                        @elseif($room->type == 3)<td>{{__('bathroom')}}</td> @elseif($room->type == 4)<td>{{__('kitchen')}}</td>
                        @elseif($room->type == 5)<td>{{__('corridor')}}</td>@elseif($room->type == 6)<td>{{__('stairs')}}</td>@endif
                        <td>{{count($room['walls'])}}</td>
                        <td>{{count($room['windows'])}}</td>
                        <td>{{count($room['roofs'])}}</td>
                        <td>{{count($room['doors'])}}</td>
                        <td>{{count($room['edges'])}}</td>
                        <td>{{count($room['corridors'])}}</td>
                        <td>{{count($room['stairs'])}}</td>
                        <td>{{$room->furnished}}</td>
                        <td class="action"> 
                            <a  title="{{__('more details')}}" href="/admin/roomDetails/{{$room->id}}"> <i data-feather="eye"></i></i></a>
                            <a  title="{{__('edit')}}" href="/admin/editTender/{{$room->id}}"><i data-feather="edit"></i></i></a>
                            <a  title="{{__('delete')}}" href="/admin/deleteTender/{{$room->id}}"><i data-feather="trash"></i></i></a>
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

    <div class="col-md-10 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">{{__('tender images')}}</h6>
        <div class="owl-carousel owl-theme owl-animate-css">
        @foreach($images as $image)
          <div class="item">
            <img style="height: 400px;" src="{{asset($image->image)}}" alt="item-image">
          </div>

          @endforeach
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
  <script src="{{ asset('assets/plugins/owl-carousel/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/carousel-rtl.js') }}"></script>
@endpush