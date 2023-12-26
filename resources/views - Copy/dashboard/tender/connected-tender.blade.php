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
        <h6 class="card-title">{{__('المناقصات المتصل بها')}}</h6>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>{{__('اسم مزود الخدمة')}}</th>
                <th>{{__('العرض')}}</th>
                <th>{{__('المناقصة')}}</th>
                <th>{{__('اسم صاحب المناقصة')}}</th>
                <th>{{__('موافقة صاحب المناقصة')}}</th>
                <th>{{__('موافقة مزود الخدمة')}}</th>
                <th class="action">{{__('الخيارات')}}</th>
              </tr>
            </thead>
            <tbody>
                @foreach($tenders as $tender)
                    <tr>
                        <td>{{$tender['provider']->first_name}} {{$tender['provider']->last_name}}</td>
                        <td>{{$tender->offer}}</td>
                        <td>{{$tender['tender']->text}}</td>
                        <td>{{$tender['user']->first_name}} {{$tender['user']->last_name}}</td>
                        <td>{{$tender->accept_user}}</td>
                        <td>{{$tender->accept_provider}}</td>
                        <td class="action"> 
                            <a  title="{{__('مزيد من التفاصيل')}}" href="/admin/roomDetails/{{$tender->id}}"> <i data-feather="eye"></i></i></a>
                            <!-- <a  title="{{__('edit')}}" href="/admin/editTender/{{$tender->id}}"><i data-feather="edit"></i></i></a> -->
                            <a  title="{{__('حذف')}}" href="/admin/deleteTender/{{$tender->id}}"><i data-feather="trash"></i></i></a>
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
