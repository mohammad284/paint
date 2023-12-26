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
        <h6 class="card-title">{{__('طلبات الانضمام لمزودي الخدمة')}}</h6>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>{{__('الاسم الاول')}}</th>
                <th>{{__('الاسم الاخير')}}</th>
                <th>{{__('الايميل')}}</th>
                <th>{{__('الموبايل')}}</th>
                <th>{{__('العنوان')}}</th>
                <th>{{__('التقييم')}}</th>
                <th>{{__('الجنس')}}</th>
                <th>{{__('الرمز البريدي')}}</th>
                <th>{{__('المدينة')}}</th>
                <th>{{__('رقم الشارع')}}</th>
                <th>{{__('رقم البيت')}}</th>
                <th>{{__('اسم البنك')}}</th>
                <th>{{__('اسم البطاقة البنكية')}}</th>
                <th>{{__('رقم البطاقة البنكية')}}</th>
                <th>{{__('تاريخ انتهاء البطاقة البنكية')}}</th>
                <th>{{__('نوع البطاقة البنكية')}}</th>
                <th>{{__('اسم الشركة')}}</th>
                <th>{{__('الصيغة القانونية')}}</th>
                <th>{{__('نوع العمل')}}</th>
                <th>{{__('تم اضافته بتاريخ')}}</th> 
                <th class="action">{{__('الخيارات')}}</th>
              </tr>
            </thead>
            <tbody>
                @foreach($providers as $provider)
                <tr>
                <td>{{$provider->first_name}}</td>
                    <td>{{$provider->last_name}}</td>
                    <td>{{$provider->email}}</td>
                    <td>{{$provider->mobile}}</td>
                    <td>{{$provider->address}}</td>
                    <td>{{$provider->rate}}</td>
                    @if($provider->gender == '0')<td>{{__('ذكر')}}</td> @endif 
                    @if($provider->gender == '1')<td>{{__('انثى')}}</td> @endif 
                    @if($provider->gender == '2')<td>{{__('غير ذلك')}}</td> @endif 
                    <td>{{$provider['postal']->Postal_Code}}</td>
                    <td>{{$provider['postal']->Admin_Name}}</td>
                    <td>{{$provider->street_num}}</td>
                    <td>{{$provider->home_num}}</td>
                    <td>{{$provider->bank_name}}</td>
                    <td>{{$provider->card_name}}</td>
                    <td>{{$provider->card_num}}</td>
                    <td>{{$provider->card_time}}</td>
                    <td>{{$provider->card_type}}</td>
                    <td>{{$provider->company_name}}</td>
                    <td>{{$provider->Legal_form}}</td>
                    @if($provider->work_type == '1')<td>{{__('خارجي')}}</td> @endif 
                    @if($provider->work_type == '2')<td>{{__('داخلي')}}</td> @endif 
                    <td>{{$provider->created_at}}</td>
                    <td class="action"> 
                      <a  type="button"  title="{{__('تعديل')}}" href="/admin/editProvider/{{$provider->id}}" ><i data-feather="edit"></i></i></a>
                      <a  type="button"  title="{{__('مزيد من التفاصيل')}}" href="/admin/detailsProvider/{{$provider->id}}"> <i data-feather="eye"></i></i></a>
                      <a  type="button"  title="{{__('قبول')}}" href="#" data-bs-toggle="modal" data-bs-target="#accept-{{$provider->id}}"> <i data-feather="check-square"></i></i></a>
                      <a  type="button"  title="{{__('حذف')}}" href="/admin/deleteProvider/{{$provider->id}}"><i data-feather="trash"></i></i></a>
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
@foreach($providers as $provider)
    <div class="modal fade" id="accept-{{$provider->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">{{__('الصلاحيات')}}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
                <form class="forms-sample"  method="POST" enctype="multipart/form-data" action="/admin/acceptProvider/{{$provider->id}}">
                    @csrf

                    <div class="mb-3">
                      <div class="form-check form-check-inline">
                        <input type="checkbox" name="glossy" class="form-check-input" id="checkInlineChecked" >
                        <label class="form-check-label" for="checkInlineChecked">
                        {{__('مع لكر')}}
                        </label>
                      </div>
                    </div>

                    <button type="submit" class="btn btn-primary me-2">{{__('قبول')}}</button>
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