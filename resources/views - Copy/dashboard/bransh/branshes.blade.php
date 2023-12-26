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
        <h6 class="card-title">{{__('branshes')}}</h6>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
          <a type="button"  class="btn btn-primary me-2" href="/admin/addBransh" > {{__('add bransh')}}</a>
            <thead>
              <tr>
                <td>#</td>
                <th>{{__('bransh work')}}</th>
                <th>{{__('work')}}</th>

                <th class="action">{{__('خيارات')}}</th>
              </tr>
            </thead>
            <tbody>
                <?php $i = 1 ?>
                @foreach($branshes as $bransh)
                <tr>
                    <td>{{$i}}</td>
                    <td>{{$bransh->translate($lang)->name}}</td>
                    <td>
                    @foreach($bransh['type'] as $type)
                    {{$type->type_of_work}}<br>
                    @endforeach</td>
                    <td class="action"> 
                        <a  title="{{__('حذف')}}" href="/admin/deleteBransh/{{$bransh->id}}"><i data-feather="slash"></i></i></a>
                        <a type="button"  href="/admin/editBransh/{{$bransh->id}}"> <i data-feather="edit"></i></a>
                    </td>
                </tr>
                <?php $i+1 ?>
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