@extends('dashboard.layout.master')
@push('plugin-styles')
  <link href="{{ asset('assets/plugins/owl-carousel/assets/owl.carousel.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/owl-carousel/assets/owl.theme.default.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/animate-css/animate.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/@mdi/css/materialdesignicons.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/prismjs/prism.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
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
  <div class="col-md-12 grid-margin">
    <div class="card">
      <div class="card-body">
        <form class="forms-sample">
            <fieldset disabled="disabled">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">{{__('first name')}}</label>
                        <input class="form-control mb-4 mb-md-0" placeholder="{{$provider->first_name}}"/>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('last name')}}</label>
                        <input class="form-control mb-4 mb-md-0" placeholder="{{$provider->last_name}}"/>
                    </div>
                    <div class="col-md-12">
                        <br>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('email')}}</label>
                        <input class="form-control mb-4 mb-md-0"  placeholder="{{$provider->email}}" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('mobile')}}</label>
                        <input class="form-control mb-4 mb-md-0"  placeholder="{{$provider->mobile}}"/>
                    </div>
                    <div class="col-md-12">
                        <br>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('postal code')}}</label>
                        <input class="form-control mb-4 mb-md-0"  placeholder="{{$provider['postal']->Postal_Code}}"/>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('work_range')}} </label>
                        <input class="form-control mb-4 mb-md-0" placeholder="{{$provider->work_range}}" />
                    </div>
                    <div class="col-md-12">
                        <br>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('gender')}}</label>
                        @if($provider->gender == 1)
                        <input class="form-control mb-4 mb-md-0" placeholder="{{('male')}}" />
                        @elseif($provider->gender == 0)
                        <input class="form-control mb-4 mb-md-0" placeholder="{{('female')}}" />
                        @else
                        <input class="form-control mb-4 mb-md-0" placeholder="{{('other')}}" />
                        @endif
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('rate')}}</label>
                        <input class="form-control mb-4 mb-md-0" placeholder="{{$provider->rate}}" />
                    </div>
                    <div class="col-md-12">
                        <br>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('company name')}} </label>
                        <input class="form-control mb-4 mb-md-0" placeholder="{{$provider->company_name}}" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('Legal form')}} </label>
                        <input class="form-control mb-4 mb-md-0" placeholder="{{$provider->Legal_form}}" />
                    </div>
                    <div class="col-md-12">
                        <br>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('Street number')}} </label>
                        <input class="form-control mb-4 mb-md-0" placeholder="{{$provider->street_num}}" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('home number')}} </label>
                        <input class="form-control mb-4 mb-md-0" placeholder="{{$provider->home_num}}" />
                    </div>
                    <div class="col-md-12">
                        <br>
                    </div>
                    
                    <div class="col-md-12">
                    <label for="exampleInputNumber1" class="form-label">{{__('company description')}}</label>
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
            <p class="mt-1 mb-1"><b>{{__('tenders')}}:{{$tenders}}</b></p>
            <p class="mt-1 mb-1"><b>{{__('interested')}}:{{$interested}}</b></p>
            <p class="mt-1 mb-1"><b>{{__('connecteds')}}:{{$connecteds}}</b></p>
            <p class="mt-1 mb-1"><b>{{__('deals')}}:{{$deals}}</b></p>
            <p class="mt-1 mb-1"><b>{{__('payments')}}:{{$payments}}</b></p>
          </div>
          <div class="col-lg-4 ps-0">
            <a  class="noble-ui-logo d-block mt-3">{{__('certificates')}}</a>   
            @foreach($provider['certificates'] as $certificate)              
            <p class="mt-1 mb-1"><b>{{$certificate->name}}</b></p>
            @endforeach
          </div>
          <div class="col-lg-4 ps-0">
            <a  class="noble-ui-logo d-block mt-3">{{__('services')}}</a>      
            @foreach($licences as $licence)         
              <p class="mt-1 mb-1"><b @if($licence->status == 0 ) style="color:red;" @elseif($licence->active == 1 && $licence->status == 1) style="color:green;" @else style="color:blue;" @endif > {{$licence['business']->name}}</b></p>
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
        <h6 class="card-title">{{__('offers')}}</h6>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              
                <tr>
                  <th>{{__('tenders')}}</th>
                  <th>{{__('offers')}}</th>
                  <th>{{__('status')}}</th>
                  <th>{{__('created at')}}</th> 
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
      <h6 class="card-title">{{__('provider image')}}</h6>
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