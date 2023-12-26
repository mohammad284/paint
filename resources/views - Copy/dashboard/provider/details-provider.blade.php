@extends('dashboard.layout.master')
@push('plugin-styles')
  <link href="{{ asset('assets/plugins/owl-carousel/assets/owl.carousel.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/owl-carousel/assets/owl.theme.default.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/animate-css/animate.min.css') }}" rel="stylesheet" />
@endpush
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
  <div class="col-md-12 grid-margin">
    <div class="card">
      <div class="card-body">
        <form class="forms-sample">
            <fieldset disabled="disabled">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">{{__('الاسم الاول')}}</label>
                        <input class="form-control mb-4 mb-md-0" placeholder="{{$provider->first_name}}"/>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('الاسم الاخير')}}</label>
                        <input class="form-control mb-4 mb-md-0" placeholder="{{$provider->last_name}}"/>
                    </div>
                    <div class="col-md-12">
                        <br>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('الايميل')}}</label>
                        <input class="form-control mb-4 mb-md-0"  placeholder="{{$provider->email}}" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('الموبايل')}}</label>
                        <input class="form-control mb-4 mb-md-0"  placeholder="{{$provider->mobile}}"/>
                    </div>
                    <div class="col-md-12">
                        <br>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('الرمز البريدي')}}</label>
                        <input class="form-control mb-4 mb-md-0"  placeholder="{{$provider['postal']->Postal_Code}}"/>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('العنوان')}}</label>
                        <input class="form-control mb-4 mb-md-0" placeholder="{{$provider->address}}" />
                    </div>
                    <div class="col-md-12">
                        <br>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('الجنس')}}</label>
                        @if($provider->gender == 0)
                        <input class="form-control mb-4 mb-md-0" placeholder="{{('ذكر')}}" />
                        @elseif($provider->gender == 1)
                        <input class="form-control mb-4 mb-md-0" placeholder="{{('انثى')}}" />
                        @else
                        <input class="form-control mb-4 mb-md-0" placeholder="{{('غير ذلك')}}" />
                        @endif
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('التقييم')}}</label>
                        <input class="form-control mb-4 mb-md-0" placeholder="{{$provider->rate}}" />
                    </div>
                    <div class="col-md-12">
                        <br>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('اسم الشركة')}} </label>
                        <input class="form-control mb-4 mb-md-0" placeholder="{{$provider->company_name}}" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('الصيغة القانونية')}} </label>
                        <input class="form-control mb-4 mb-md-0" placeholder="{{$provider->Legal_form}}" />
                    </div>
                    <div class="col-md-12">
                        <br>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('رقم الشارع')}} </label>
                        <input class="form-control mb-4 mb-md-0" placeholder="{{$provider->street_num}}" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('رقم البيت')}} </label>
                        <input class="form-control mb-4 mb-md-0" placeholder="{{$provider->home_num}}" />
                    </div>
                    <div class="col-md-12">
                        <br>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('اسم البنك')}} </label>
                        <input class="form-control mb-4 mb-md-0" placeholder="{{$provider->bank_name}}" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('اسم البطاقة البنكية')}} </label>
                        <input class="form-control mb-4 mb-md-0" placeholder="{{$provider->card_name}}" />
                    </div>
                    <div class="col-md-12">
                        <br>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('رقم البطاقة البنكية')}} </label>
                        <input class="form-control mb-4 mb-md-0" placeholder="{{$provider->card_num}}" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('تاريخ انتهاء البطاقة البنكية')}} </label>
                        <input class="form-control mb-4 mb-md-0" placeholder="{{$provider->card_time}}" />
                    </div>
                    <div class="col-md-12">
                        <br>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('نوع البطاقة البنكية')}} </label>
                        <input class="form-control mb-4 mb-md-0" placeholder="{{$provider->card_type}}" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('مجال العمل')}} </label>
                        <input class="form-control mb-4 mb-md-0" placeholder="{{$provider->work_range}}" />
                    </div>
                    <div class="col-md-12">
                    <label for="exampleInputNumber1" class="form-label">{{__('نبذة عن الشركة')}}</label>
                    <textarea id="maxlength-textarea" class="form-control"   rows="6" >{{$provider->com_description}}</textarea>
                </div>
                </div>
            </fieldset>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <div class="container-fluid d-flex justify-content-between">
          <div class="col-lg-4 ps-0">
            <a  class="noble-ui-logo d-block mt-3">{{__('provider')}}</a>                 
            <p class="mt-1 mb-1"><b>{{__('المناقصات')}}:{{$tenders}}</b></p>
            <p class="mt-1 mb-1"><b>{{__('الاهتمامات')}}:{{$interested}}</b></p>
            <p class="mt-1 mb-1"><b>{{__('الاتصالات')}}:{{$connecteds}}</b></p>
            <p class="mt-1 mb-1"><b>{{__('العقود')}}:{{$deals}}</b></p>
            <p class="mt-1 mb-1"><b>{{__('المدفوعات')}}:{{$payments}}</b></p>

          </div>
          <div class="col-lg-4 ps-0">
            <a  class="noble-ui-logo d-block mt-3">{{__('الخدمات')}}</a>      
            @foreach($provider['service'] as $serv)           
              <p class="mt-1 mb-1"><b>{{$serv['service']->translate($lang)->service}}</b></p>
            @endforeach
          </div>
        </div>


      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">{{__('العروض')}}</h6>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              
                <tr>
                  <th>{{__('المناقصات')}}</th>
                  <th>{{__('العروض')}}</th>
                  <th>{{__('الحالة')}}</th>
                  <th>{{__('تم اضافته بتاريخ')}}</th> 
                </tr>
            </thead>
            <tbody>
              @foreach($send_offers as $send_offer)
                <tr>
                    <td>{{$send_offer['tender']->title}}</td>
                    <td>{{$send_offer->offer}}</td>
                    <td>{{$send_offer->status}}</td>
                    <td>{{$send_offer->created_at}}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="col-md-10 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h6 class="card-title">{{__('صور مزود الخدمة')}}</h6>
      <div class="owl-carousel owl-theme owl-animate-css">
        <div class="item">
          <img style="height: 400px;" src="{{asset($provider->images->front_craft_card)}}" alt="item-image">
        </div>
        <div class="item">
          <img style="height: 400px;" src="{{asset($provider->images->back_craft_card)}}" alt="item-image">
        </div>
        <div class="item">
          <img style="height: 400px;" src="{{asset($provider->images->back_work_certificate)}}" alt="item-image">
        </div>
        <div class="item">
          <img style="height: 400px;" src="{{asset($provider->images->front_work_certificate)}}" alt="item-image">
        </div>
        <div class="item">
          <img style="height: 400px;" src="{{asset($provider->images->front_CR)}}" alt="item-image">
        </div>
        <div class="item">
          <img style="height: 400px;" src="{{asset($provider->images->back_CR)}}" alt="item-image">
        </div>
        <div class="item">
          <img style="height: 400px;" src="{{asset($provider->images->image)}}" alt="item-image">
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
@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/owl-carousel/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/carousel-rtl.js') }}"></script>
@endpush