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
            <h6 class="card-title">{{__('مناقصات المنازل الداخلية')}}</h6>
            <div class="table-responsive">
                <table id="dataTableExample" class="table">
                    <thead>
                    <tr>
                        <th>{{__('اسم مقدم المناقصة')}}</th>
                        <th>{{__('عنوان المناقصة')}}</th>
                        <th>{{__('ملاحظات')}}</th>
                        <th>{{__('مفروش')}}</th>
                        <th>{{__('نوع البناء')}}</th>
                        <th>{{__('المساحة')}}</th>
                        <th>{{__('الارتفاع')}}</th>
                        <th>{{__('الرمز البريدي')}}</th>
                        <th>{{__('المدينة')}}</th>
                        <th>{{__('الوقت المتوقع')}}</th>
                        <th class="action">{{__('الخيارات')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($tenders as $tender)
                            <tr>
                                <td>{{$tender['user']->first_name}}</td>
                                <td>{{$tender->title}}</td>
                                <td>{{$tender->note}}</td>
                                @if($tender->furnished == 1)
                                <td>{{__('مفروش')}}</td>@elseif($tender->furnished == 0)
                                <td>{{__('غير مفروش')}}</td>@endif
                                @if($tender->house_type == 1)
                                <td>{{__('بيت')}}</td>@elseif($tender->house_type == 2)
                                <td>{{__('صالة')}}</td>@elseif($tender->house_type == 3)
                                <td>{{__('مستودع')}}</td>@elseif($tender->house_type == 4)
                                <td>{{__('قبو')}}</td>@endif 
                                <td>{{$tender->space}}</td>
                                <td>{{$tender->height}}</td>
                                <td>{{$tender['postal']->Postal_Code}}</td>
                                <td>{{$tender['postal']->Admin_Name}}</td>
                                <td>{{$tender->expected_date}}</td>
                                <td class="action"> 
                                    <a  title="{{__('مزيد من التفاصيل')}}" href="/admin/tenderRooms/{{$tender->id}}"> <i data-feather="eye"></i></i></a>
                                    <!-- <a  title="{{__('edit')}}" href="/admin/editTender/{{$tender->id}}"><i data-feather="edit"></i></i></a> -->
                                    <a title="{{__('حذف')}}" href="/admin/deleteTender/{{$tender->id}}" onclick="showSwal('mixin')"><i data-feather="trash"></i></i></a>
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