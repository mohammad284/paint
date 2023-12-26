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
            <h6 class="card-title">{{__('مناقصة الارضيات')}}</h6>
            <div class="table-responsive">
                <table id="dataTableExample" class="table">
                    <thead>
                    <tr>
                        <th>{{__('نوع المناقصة')}}</th>
                        <th>{{__('اسم مقدم المناقصة')}}</th>
                        <th>{{__('عنوان المناقصة')}}</th>
                        <th>{{__('ملاحظات')}}</th>
                        <th>{{__('النص')}}</th>
                        <th>{{__('العدد الكلي')}}</th>
                        <th>{{__('الرمز البريدي')}}</th>
                        <th>{{__('المدينة')}}</th>
                        <th>{{__('الوقت المتوقع')}}</th>
                        <th class="action">{{__('الخيارات')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($flours as $flour)
                            <tr>
                                @if($flour->inside == 5)
                                <td>{{__('ارضيات داخلية')}}</td>@elseif($flour->inside == 6)<td>{{__('ارضيات خارجية')}}</td>@endif
                                <td>{{$flour['user']->first_name}}</td>
                                <td>{{$flour->title}}</td>
                                <td>{{$flour->note}}</td>
                                <td>{{$flour->text}}</td>
                                <td>{{count($flour['flour_tender'])}}</td>
                                <td>{{$flour['postal']->Postal_Code}}</td>
                                <td>{{$flour['postal']->Admin_Name}}</td>
                                <td>{{$flour->expected_date}}</td>
                                <td class="action"> 
                                    <a  title="{{__('مزيد من التفاصيل')}}" href="/admin/flourDetails/{{$flour->id}}"> <i data-feather="eye"></i></i></a>
                                    <a title="{{__('حذف')}}" href="/admin/deleteTender/{{$flour->id}}" onclick="showSwal('mixin')"><i data-feather="trash"></i></i></a>
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