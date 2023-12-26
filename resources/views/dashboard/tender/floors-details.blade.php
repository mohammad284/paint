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
            <h6 class="card-title">{{__('building details')}}</h6>
            <div class="table-responsive">
                <table id="dataTableExample" class="table">
                    <thead>
                    <tr>
                            <th>{{__('number of rooms')}}</th>
                            <th>{{__('color')}}</th>
                            <th>{{__('number of walls')}}</th>
                            <th>{{__('number of roofs')}}</th>
                            <th>{{__('number of baths')}}</th>
                            <th>{{__('number of corridors')}}</th>
                            <th>{{__('number of stairs')}}</th>
                            <th>{{__('number of kitchens')}}</th>
                            <th>{{__('number of doors')}}</th>
                            <th>{{__('number of windows')}}</th>
                            <th>{{__('area')}}</th>
                            <th>{{__('unit')}}</th>
                            <th>{{__('with paint')}}</th>
                            <th>{{__('with paste')}}</th>
                            <th>{{__('with base')}}</th>
                            <th>{{__('shave')}}</th>
                            <th>{{__('expected date')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($tender['building_floors'] as $floor)
                            <tr>
                                <td>{{$floor->num_of_rooms}}</td>
                                <td>{{$floor['colors']->name}}</td>
                                <td>{{$floor->num_of_walls}}</td>
                                <td>{{$floor->num_of_roofs}}</td>
                                <td>{{$floor->num_of_baths}}</td>
                                <td>{{$floor->num_of_corridor}}</td>
                                <td>{{$floor->num_of_stairs}}</td>
                                <td>{{$floor->num_of_kitchen}}</td>
                                <td>{{$floor->num_of_doors}}</td>
                                <td>{{$floor->num_of_windows}}</td>
                                <td>{{$floor->area}}</td>
                                <td>{{$floor->unit}}</td>
                                @if($floor->new_status_paint == 1)
                                <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td> @endif
                                @if($floor->new_status_paste == 1)
                                <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td> @endif
                                @if($floor->new_status_base == 1)
                                <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td> @endif
                                @if($floor->shave == 1)
                                <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td> @endif
                                <td>{{$tender->expected_date}}</td>
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