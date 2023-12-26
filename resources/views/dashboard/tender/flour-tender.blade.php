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
            <h6 class="card-title">{{__('flour tenders')}}</h6>
            <div class="table-responsive">
                <table id="dataTableExample" class="table">
                    <thead>
                    <tr>
                        <th>{{__('user')}}</th>
                        <th>{{__('tender title')}}</th>
                        <th>{{__('note')}}</th>
                        <th>{{__('text')}}</th>
                        <th>{{__('total_number')}}</th>
                        <th>{{__('postal code')}}</th>
                        <th>{{__('city')}}</th>
                        <th>{{__('expected date')}}</th>
                        <th class="action">{{__('option')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($flours as $flour)
                            <tr>
                                <td>{{$flour['user']->first_name}}</td>
                                <td>{{$flour->title}}</td>
                                <td>{{$flour->note}}</td>
                                <td>{{$flour->text}}</td>
                                <td>{{count($flour['flour_tender'])}}</td>
                                <td>{{$flour['postal']->Postal_Code}}</td>
                                <td>{{$flour['postal']->Place_Name}}</td>
                                <td>{{$flour->expected_date}}</td>
                                <td class="action"> 
                                    <a  title="{{__('more details')}}" href="/admin/flourDetails/{{$flour->id}}"> <i data-feather="eye"></i></i></a>
                                    <a  href="/admin/deleteTender/{{$flour->id}}" onclick="showSwal('mixin')"><i data-feather="trash"></i></i></a>
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