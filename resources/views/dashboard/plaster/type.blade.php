@extends('dashboard.layout.master')
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
@if ($errors->any())
    <div class="message-box">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ __($error) }}</li>
            @endforeach
        </ul>
    </div>
@endif
@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
        <div class="card-body">
            <h6 class="card-title">{{__('plaster type')}}</h6>
            <div class="table-responsive">
            <table id="dataTableExample" class="table">
            <!-- <a type="button"  class="btn btn-primary me-2" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"> {{__('add new plaster type')}}</a> -->
            <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"> {{__('add new plaster type')}}</a>
                <thead>
                <tr>
                    <th>{{__('type')}}</th>
                    <th>{{__('thickness/cm')}}</th>
                    <th class="action">{{__('option')}}</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($types as $type)
                    <tr>
                        <td>{{$type->type}}</td>
                        <td>{{$type->thickness}}</td>
                        <td class="action"> 
                            <a type="button"  href="#" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$type->id}}"> <i data-feather="edit"></i></a>
                            <a  title="{{__('delete')}}" href="/admin/deletplasterType/{{$type->id}}"  onclick="showSwal('mixin')"><i data-feather="trash"></i></i></a>
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
                <h5 class="modal-title" id="exampleModalLabel">{{__('add palster type')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data" action="/admin/storePlasterType">
                    @csrf
                    <div class="mb-3">
                        <label for="recipient-name" class="form-label">{{__('type')}} :</label>
                        <input type="text" class="form-control" name="type" id="exampleInputNumber1"  required>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="form-label">{{__('thickness/cm')}} :</label>
                        <input type="text" class="form-control" name="thickness" id="exampleInputNumber1"  required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('Close')}}</button>
                        <button type="submit" class="btn btn-primary me-2">{{__('save')}}</button>
                    </div>
                </form>
            </div>
                
            </div>
        </div>
    </div>
    @foreach($types as $type)
        <div class="modal fade" id="exampleModal-{{$type->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{__('edit plaster type')}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" enctype="multipart/form-data" action="/admin/updatePlasterType">
                            @csrf
                            <div class="mb-3">
                                <label for="recipient-name" class="form-label">{{__('type')}} :</label>
                                <input type="text" class="form-control" name="type" value="{{$type->type}}" id="exampleInputNumber1"  required>
                                <input type="hidden" class="form-control" name="type_id" value="{{$type->id}}">
                            </div>
                            <div class="mb-3">
                                <label for="recipient-name" class="form-label">{{__('thickness')}}/cm :</label>
                                <input type="text" class="form-control" name="thickness" value="{{$type->thickness}}" id="exampleInputNumber1"  required>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('Close')}}</button>
                                <button type="submit" class="btn btn-primary me-2">{{__('save')}}</button>
                            </div>
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
@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/sweet-alert.js') }}"></script>
@endpush