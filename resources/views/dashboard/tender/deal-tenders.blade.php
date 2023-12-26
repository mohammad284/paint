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
        <h6 class="card-title">{{__('tender')}}</h6>
        <div class="table-responsive">
        <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>#</th>
                <th>{{__('provider name')}}</th>
                <th>{{__('offer')}}</th>
                <th>{{__('user name')}}</th>
                <th>{{__('accept user')}}</th>
                <th>{{__('accept provider')}}</th>
                <th class="action">{{__('option')}}</th>
              </tr>
            </thead>
            <tbody>
                @foreach($tenders as $tender)
                    <tr>
                      <th scope="row">{{$loop->iteration}}</th>
                        <td>{{$tender['provider']->first_name}}</td>
                        <td>{{$tender->offer}}</td>
                        <td>{{$tender['user']->name}}</td>
                        <td>{{$tender->accept_user}}</td>
                        <td>{{$tender->accept_provider}}</td>
                        <td class="action"> 
                            <a  title="{{__('all details')}}" href="/admin/dealDetails/{{$tender['tender']->id}}"> <i data-feather="eye"></i></i></a>
                            <!-- <a  title="{{__('تعديل')}}" href="/admin/editTender/{{$tender->id}}"><i data-feather="edit"></i></i></a>
                            <a  title="{{__('حذف')}}" href="/admin/deleteTender/{{$tender->id}}"><i data-feather="trash"></i></i></a> -->
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