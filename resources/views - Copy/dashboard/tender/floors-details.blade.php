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
            <h6 class="card-title">{{__('building details')}}</h6>
            <div class="table-responsive">
                <table id="dataTableExample" class="table">
                    <thead>
                    <tr>
                    @if($tender->inside == '2')
                            <th>{{__('type of tender')}}</th>
                            <th>{{__('num of rooms')}}</th>
                            <th>{{__('color')}}</th>
                            <th>{{__('num of walls')}}</th>
                            <th>{{__('area')}}</th>
                            <th>{{__('unit')}}</th>
                            <th>{{__('expected date')}}</th>
                        @elseif($tender->inside == '3')
                            <th>{{__('type of tender')}}</th>
                            <th>{{__('color')}}</th>
                            <th>{{__('out area')}}</th>
                            <th>{{__('unit')}}</th>
                            <th>{{__('expected date')}}</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($tender['building_floors'] as $floor)
                            <tr>
                                <td>@if($tender->inside == 2){{__('internal')}}@else{{__('external')}}@endif</td>
                                <td>{{$floor['colors']->name}}</td>
                                @if($tender->inside == 2)
                                <td>{{$floor->num_of_rooms}}</td>
                                <td>{{$floor->num_of_walls}}</td>
                                <td>{{$floor->area}}</td>@endif
                                @if($tender->inside == 3)
                                <td>{{$floor->out_area}}</td>@endif
                                <td>{{$floor->unit}}</td>
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