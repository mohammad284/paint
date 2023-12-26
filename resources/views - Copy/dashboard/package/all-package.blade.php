@extends('dashboard.layout.master')
@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/@mdi/css/materialdesignicons.min.css') }}" rel="stylesheet" />
@endpush
@push('plugin-styles')

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
        <h6 class="card-title">{{__('كل الباقات')}}</h6>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
          <a type="button"  href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">{{__('add package')}}</a>
            <thead>
              <tr>
                <th>{{__('اسم الباقة')}}</th>
                <th>{{__('سعر الباقة')}}</th>
                <th>{{__('تم اضافته بتاريخ')}}</th>
                <th class="action">{{__('option')}}</th>
              </tr>
            </thead>
            <tbody>
                @foreach($packages as $package)
                <tr>
                  
                    <td>{{$package->name}}</td>
                    <td>{{$package->price}}</td>
                    <td>{{$package->created_at}}</td>
                    <td class="action"> 
                    <a  title="{{__('تعديل')}}" href="#" data-bs-toggle="modal" data-bs-target="#package-{{$package->id}}"><i data-feather="edit"></i></i></a>
                        <a  title="{{__('حذف')}}" href="/admin/deletePackage/{{$package->id}}"><i data-feather="trash"></i></i></a>
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
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">{{__('اضافة باقة جديدة')}}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
            <form class="forms-sample"  method="POST" enctype="multipart/form-data" action="/admin/addPackage">
            @csrf

            <div class="row mb-6">
                <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('اسم الباقة')}}</label>
                    <input class="form-control mb-4 mb-md-0" name="name"  required/>
                </div>
                <div class="col-md-6">
                <label for="exampleInputNumber1" class="form-label">{{__('سعر الباقة')}}</label>
                    <input class="form-control mb-4 mb-md-0" name="price" required/>
                </div>
                <div >
                <br>
              </div>

            </div>

            <button type="submit" class="btn btn-primary me-2">{{__('حفظ')}}</button>
        </form>
            </div>
              
          </div>
        </div>
      </div>
      @foreach($packages as $package)
      <div class="modal fade" id="package-{{$package->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">{{__('تعديل الباقة')}}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
            <form class="forms-sample"  method="POST" enctype="multipart/form-data" action="/admin/updatePackage/{{$package->id}}">
            @csrf

            <div class="row mb-6">
                <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('اسم الباقة')}}</label>
                    <input class="form-control mb-4 mb-md-0" name="name" value="{{$package->name}}" required/>
                </div>
                <div class="col-md-6">
                <label for="exampleInputNumber1" class="form-label">{{__('سعرالباقة')}}</label>
                    <input class="form-control mb-4 mb-md-0" name="price" value="{{$package->price}}"  required/>
                </div>
                <div >
                <br>
              </div>

            </div>

            <button type="submit" class="btn btn-primary me-2">{{__('تعديل')}}</button>
        </form>
            </div>
              
          </div>
        </div>
      </div>
      @endforeach
@endsection
@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush