@extends('dashboard.layout.master')
@push('plugin-styles')
  <link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
@endpush
@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/@mdi/css/materialdesignicons.min.css') }}" rel="stylesheet" />
@endpush
@push('plugin-styles')

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
        <h6 class="card-title">{{__('Reviews')}}</h6>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>{{__('sender')}}</th>
                <th>{{__('reciver')}}</th>
                <th>{{__('comment')}}</th>
                <th>{{__('rate')}}</th>
                <th class="action">{{__('option')}}</th>
              </tr>
            </thead>
            <tbody>
                @foreach($reviews as $review)
                <tr>
                  
                    <td>{{$review['user']->email}}</td>
                     <td>{{$review['provider']->email}}</td>
                    <td>{{$review->comment}}</td>
                    <td>{{$review->rate}}</td>
                    <td class="action"> 
                    <!-- <a  title="{{__('تعديل')}}" href="#" data-bs-toggle="modal" data-bs-target="#review-{{$review->id}}"><i data-feather="edit"></i></i></a> -->
                        <a  title="{{__('delete')}}" href="/admin/deleteReview/{{$review->id}}"onclick="showSwal('mixin')"><i data-feather="trash"></i></i></a>
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
<!-- 
      @foreach($reviews as $review)
      <div class="modal fade" id="package-{{$review->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">{{__('edit package')}}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
            <form class="forms-sample"  method="POST" enctype="multipart/form-data" action="/admin/updatePackage/{{$review->id}}">
            @csrf

            <div class="row mb-6">
                <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('package name/english')}}</label>
                    <input class="form-control mb-4 mb-md-0" name="name_en" value="{{$review->name}}" required/>
                </div>
                <div class="col-md-6">
                <label for="exampleInputNumber1" class="form-label">{{__('package price')}}</label>
                    <input class="form-control mb-4 mb-md-0" name="price" value="{{$review->price}}"  required/>
                </div>
                <div >
                <br>
              </div>
              <div class="col-md-6">
                <label for="exampleInputNumber1" class="form-label">{{__('package name/germany')}}</label>
                    <input class="form-control mb-4 mb-md-0" name="name_gr" value="{{$review->name}}"   required/>
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
      @endforeach -->
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