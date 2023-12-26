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
        <h6 class="card-title">{{__('Service Provider')}}</h6>
        <a type="button"  href="/admin/addProvider" > {{__('add new provider')}}</a>
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
                <th>{{__('مجال العمل')}}</th>
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
                    <td>{{$provider->work_range}}</td>
                    <td>{{$provider->Legal_form}}</td>
                    @if($provider->work_type == '1')<td>{{__('خارجي')}}</td> @endif 
                    @if($provider->work_type == '2')<td>{{__('داخلي')}}</td> @endif 
                    <td>{{$provider->created_at}}</td>
                    <td class="action"> 
                      <a  title="{{__('مزيد من التفاصيل')}}" href="/admin/detailsProvider/{{$provider->id}}"> <i data-feather="eye"></i></i></a>
                      <a  title="{{__('تعديل')}}" href="/admin/editProvider/{{$provider->id}}"><i data-feather="edit"></i></i></a>
                      <a  title="{{__('تجميد')}}" href="/admin/blockProvider/{{$provider->id}}"><i data-feather="slash"></i></i></a>
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