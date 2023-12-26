@extends('dashboard.layout.master')
@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
  
  <?php
  $lang = Session('locale');
  if ($lang != "en") {
      $lang = "ar";
  }
?>
  @if($lang == 'en')
  <link href="{{ asset('assets/massageltr.css') }}" rel="stylesheet" />
  @else
  <link href="{{ asset('assets/massage.css') }}" rel="stylesheet" />
  @endif
@endpush
@section('content')
@if(session()->has('message'))
<p class="message-box" >
    {{ session()->get('message') }}
</p>
@endif

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">{{__('انواع الارضيات')}}</h6>
        <a type="button"  href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"> {{__('اضافة نوع جديد')}}</a>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>{{__('الاسم/انكليزي')}}</th>
                <th>{{__('الاسم/ألماني')}}</th>
                <th>{{__('تم اضافته بتاريخ')}}</th>
                <th class="action">{{__('الخيارات')}}</th>
              </tr>
            </thead>
            <tbody>
                @foreach($floars as $floar)
                <tr>
                    <td>{{$floar->translate('en')->name}}</td>
                    <td>{{$floar->translate('gr')->name}}</td>
                    <td>{{$floar->created_at}}</td>
                    <td class="action"> 
                    <a  title="{{__('تعديل')}}" href="#" data-bs-toggle="modal" data-bs-target="#floar-{{$floar->id}}"><i data-feather="edit"></i></i></a>
                        <a  title="{{__('حذف')}}" href="/admin/deleteFlo/{{$floar->id}}"><i data-feather="trash"></i></i></a>
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
              <h5 class="modal-title" id="exampleModalLabel">{{__('اضافة نوع جديد')}}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
            <form class="forms-sample"  method="POST" enctype="multipart/form-data" action="/admin/addFlo">
            @csrf

            <div class="row mb-6">
                <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('الاسم/انكليزي')}}</label>
                    <input class="form-control mb-4 mb-md-0" name="name_en"  required/>
                </div>
                <div class="col-md-6">
                    <label class="form-label">{{__('الاسم/ألماني')}}:</label>
                    <input class="form-control mb-4 mb-md-0" name="name_gr"  required/>
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

      @foreach($floars as $floar)
    <div class="modal fade" id="floar-{{$floar->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">{{__('تعديل الارضيات')}}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
            <form class="forms-sample"  method="POST" enctype="multipart/form-data" action="/admin/updateFlo/{{$floar->id}}">
            @csrf

            <div class="row mb-6">
                <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('الاسم/انكليزي')}}</label>
                    <input class="form-control mb-4 mb-md-0" name="name_en" value="{{$floar->translate('en')->name}}" required/>
                </div>
                <div class="col-md-6">
                    <label class="form-label">{{__('الاسم/ألماني')}}:</label>
                    <input class="form-control mb-4 mb-md-0" name="name_gr" value="{{$floar->translate('gr')->name}}" required/>
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