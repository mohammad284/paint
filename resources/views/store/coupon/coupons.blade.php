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
        <h6 class="card-title">{{__('coupons')}}</h6>
        <a type="button"  href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"> {{__('add new coupon')}}</a>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>{{__('name')}}</th>
                <th>{{__('active')}}</th>
                <th>{{__('discount value(number)')}}</th>
                <th>{{__('discount value(percent)')}} %</th>
                <th>{{__('minimum bill value')}}</th>
                <th>{{__('from time')}}</th>
                <th>{{__('to time')}}</th>
                <th>{{__('times of use')}}</th>
                <th>{{__('created at')}}</th>
                <th class="action">{{__('option')}}</th>
              </tr>
            </thead>
            <tbody>
              @foreach($coupons as $coupon)
                <tr>
                    <td>{{$coupon->name}}</td>@if($coupon->status == 0||$coupon->status==null)
                    <td>{{__('no active')}}</td>@else
                    <td>{{__('active')}}</td>@endif
                    <td>{{$coupon->quantity_num}}</td>
                    <td>{{$coupon->quantity_percent}}</td>
                    <td>{{$coupon->min_bill}}</td>
                    <td>{{$coupon->from_time}}</td>
                    <td>{{$coupon->to_time}}</td>
                    <td>{{$coupon->use_times}}</td>
                    <td>{{$coupon->created_at}}</td>
                    <td class="action"> 
                        <a  title="{{__('edit')}}" href="#" data-bs-toggle="modal" data-bs-target="#coupon-{{$coupon->id}}"><i data-feather="edit"></i></i></a>
                        <a  title="{{__('active')}}" href="/admin/activeCoupon/{{$coupon->id}}"> <i data-feather="check-square"></i></i></a>
                        <a  title="{{__('delete')}}" href="/admin/deleteCoupon/{{$coupon->id}}"><i data-feather="trash"></i></i></a>
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
              <h5 class="modal-title" id="exampleModalLabel">{{__('add new coupon')}}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
            <form class="forms-sample"  method="POST" enctype="multipart/form-data" action="/admin/addNewCoupon">
                @csrf
                  <div class="row mb-12">
                    <div class="col-md-12">
                        <label for="exampleInputNumber1" class="form-label">{{__('name')}}</label>
                        <input class="form-control mb-4 mb-md-0" name="name"  required/>
                    </div>
                    <div >
                        <br>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">{{__('discount value(number)')}}:</label>
                        <input class="form-control mb-4 mb-md-0" name="quantity_num" type="number" placeholder="{{__('Choose me or go to the percentage')}}"  />
                    </div>
                    <div >
                        <br>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">{{__('discount value(percent)')}} %:</label>
                        <input class="form-control mb-4 mb-md-0" name="quantity_percent" type="number" placeholder="{{__('Choose me or go to the express number')}}"  />
                    </div>
                    <div >
                        <br>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">{{__('minimum bill value')}}:</label>
                        <input class="form-control mb-4 mb-md-0" name="min_bill" placeholder="{{__('Minimum bill value to use the coupon')}}"  required/>
                    </div>
                    <div >
                        <br>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('from time')}}:</label>
                        <input class="form-control mb-4 mb-md-0" type="date" name="from_time" placeholder="{{__('Choose the coupon start time')}}"  required/>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('to time')}}:</label>
                        <input class="form-control mb-4 mb-md-0" type="date" name="to_time" placeholder="{{__('Choose the coupon end time')}}"   required/>
                    </div>
                    <div >
                        <br>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">{{__('times of use')}}:</label>
                        <input class="form-control mb-4 mb-md-0" type="number" name="use_times" placeholder="{{__('If left null, the number is unlimited')}}"/>
                    </div>
                    <div >
                        <br>
                    </div>
                  </div>
                <button type="submit" class="btn btn-primary me-2">{{__('save')}}</button>
            </form>
            </div>
              
          </div>
        </div>
      </div>

      @foreach($coupons as $coupon)
      <div class="modal fade" id="coupon-{{$coupon->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">{{__('edit coupon')}}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
            <form class="forms-sample"  method="POST" enctype="multipart/form-data" action="/admin/updateCoupon/{{$coupon->id}}">
                @csrf
                  <div class="row mb-12">
                    <div class="col-md-12">
                        <label for="exampleInputNumber1" class="form-label">{{__('name')}}</label>
                        <input class="form-control mb-4 mb-md-0" name="name" value="{{$coupon->name}}"  required/>
                    </div>
                    <div >
                        <br>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">{{__('discount value(number)')}}:</label>
                        <input class="form-control mb-4 mb-md-0" name="quantity_num" value="{{$coupon->quantity_num}}" type="number" placeholder="{{__('Choose me or go to the percentage')}}"  />
                    </div>
                    <div >
                        <br>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">{{__('discount value(percent)')}} %:</label>
                        <input class="form-control mb-4 mb-md-0" name="quantity_percent" value="{{$coupon->quantity_percent}}" type="number" placeholder="{{__('Choose me or go to the express number')}}"  />
                    </div>
                    <div >
                        <br>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">{{__('minimum bill value')}}:</label>
                        <input class="form-control mb-4 mb-md-0" name="min_bill" value="{{$coupon->min_bill}}" placeholder="{{__('Minimum bill value to use the coupon')}}"  required/>
                    </div>
                    <div >
                        <br>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('from time')}}:</label>
                        <input class="form-control mb-4 mb-md-0" type="date" value="{{$coupon->from_time}}" name="from_time" placeholder="{{__('Choose the coupon start time')}}"  required/>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('to time')}}:</label>
                        <input class="form-control mb-4 mb-md-0" type="date" value="{{$coupon->to_time}}" name="to_time" placeholder="{{__('Choose the coupon end time')}}"  required/>
                    </div>
                    <div >
                        <br>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">{{__('times of use')}}:</label>
                        <input class="form-control mb-4 mb-md-0" type="number" value="{{$coupon->use_times}}" name="use_times" placeholder="{{__('If left null, the number is unlimited')}}"/>
                    </div>
                    <div >
                        <br>
                    </div>
                  </div>
                <button type="submit" class="btn btn-primary me-2">{{__('edit')}}</button>
            </form>
            </div>
              
          </div>
        </div>
      </div>
      @endforeach
      <!-- @foreach($coupons as $coupon)
      <div class="modal fade" id="active-{{$coupon->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">{{__('active the coupon')}}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
            <form class="forms-sample"  method="POST" enctype="multipart/form-data" action="/admin/activeDisCoupon/{{$coupon->id}}">
                @csrf
                  <div class="row mb-12">
                  <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                      <div class="card">
                        <div class="card-body">
                          <div class="mb-3">
                            <label for="exampleFormControlSelect2" class="form-label">Example multiple select</label>
                            <select multiple class="form-select" name="users[]" id="exampleFormControlSelect2">
                            <option value="0">{{__('all user')}}</option>
                            <option value="@">{{__('most bought')}}</option>
                              @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->email}}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                    <div >
                        <br>
                    </div>
                  </div>
                <button type="submit" class="btn btn-primary me-2">{{__('send coupon')}}</button>
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