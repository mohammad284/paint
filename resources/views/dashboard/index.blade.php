@extends('dashboard.layout.master')
@push('plugin-styles')
  <link href="{{ asset('assets/plugins/@mdi/css/materialdesignicons.min.css') }}" rel="stylesheet" />
@endpush
@section('content')


@push('plugin-styles')
  <link href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
@endpush

<div class="row">
  <div class="col-12 col-xl-12 stretch-card">
    <div class="row flex-grow-1">

      <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
            <a href="/admin/sliders"><h6 class="card-title mb-0">{{__('sliders')}}</h6></a>
              <div class="dropdown mb-2">
              </div>
            </div>
            <div class="row">
              <div class="col-6 col-md-12 col-xl-5">
                <div class="d-flex align-items-baseline">
                  <p class="text-danger" style="font-size: 25px ; padding-top: 1rem;">
                    <span>{{$sliders}}</span>
                  </p>
                </div>
              </div>
              <div class="col-6 col-md-12 col-xl-7">
              <a href="/admin/sliders"><i class="mdi mdi-radio" style="font-size: 50px ;padding-right: 35%;"></i></a> 
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
              <a href="/admin/allUser"><h6 class="card-title mb-0">{{__('users')}} </h6></a>

            </div>
            <div class="row">
              <div class="col-6 col-md-12 col-xl-5">
                <div class="d-flex align-items-baseline">
                  <p class="text-danger" style="font-size: 25px ; padding-top: 1rem;">
                    <span>{{$users}}</span>
                  </p>
                </div>
              </div>
              <div class="col-6 col-md-12 col-xl-7">
              <a href="/admin/allUser"><i class="mdi mdi-account-multiple" style="font-size: 50px ;padding-right: 35%;"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div> <!-- row -->
<div class="row">
  <div class="col-12 col-xl-12 stretch-card">
    <div class="row flex-grow-1">

      <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
            <a href="/admin/allprovider"><h6 class="card-title mb-0">{{__('providers')}}</h6></a>
              <div class="dropdown mb-2">
              </div>
            </div>
            <div class="row">
              <div class="col-6 col-md-12 col-xl-5">
                <div class="d-flex align-items-baseline">
                  <p class="text-danger" style="font-size: 25px ; padding-top: 1rem;">
                    <span>{{$providers}}</span>
                  </p>
                </div>
              </div>
              <div class="col-6 col-md-12 col-xl-7">
              <a href="/admin/allprovider"><i class="mdi mdi-account-multiple" style="font-size: 50px ;padding-right: 35%;"></i></a> 
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
              <a href="/admin/material"><h6 class="card-title mb-0">{{__('materials')}} </h6></a>

            </div>
            <div class="row">
              <div class="col-6 col-md-12 col-xl-5">
                <div class="d-flex align-items-baseline">
                  <p class="text-danger" style="font-size: 25px ; padding-top: 1rem;">
                    <span>{{$materials}}</span>
                  </p>
                </div>
              </div>
              <div class="col-6 col-md-12 col-xl-7">
              <a href="/admin/material"><i class="mdi mdi-flask-empty-outline" style="font-size: 50px ;padding-right: 35%;"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div> <!-- row -->
<div class="row">
  <div class="col-12 col-xl-12 stretch-card">
    <div class="row flex-grow-1">

      <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
            <a href="/admin/allPackage"><h6 class="card-title mb-0">{{__('all Package')}}</h6></a>
              <div class="dropdown mb-2">
              </div>
            </div>
            <div class="row">
              <div class="col-6 col-md-12 col-xl-5">
                <div class="d-flex align-items-baseline">
                  <p class="text-danger" style="font-size: 25px ; padding-top: 1rem;">
                    <span>{{$allPackage}}</span>
                  </p>
                </div>
              </div>
              <div class="col-6 col-md-12 col-xl-7">
              <a href="/admin/allPackage"><i class="mdi mdi-package" style="font-size: 50px ;padding-right: 35%;"></i></a> 
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
              <a href="/admin/insideTender"><h6 class="card-title mb-0">{{__('inside Tender')}} </h6></a>

            </div>
            <div class="row">
              <div class="col-6 col-md-12 col-xl-5">
                <div class="d-flex align-items-baseline">
                  <p class="text-danger" style="font-size: 25px ; padding-top: 1rem;">
                    <span>{{$insideTender}}</span>
                  </p>
                </div>
              </div>
              <div class="col-6 col-md-12 col-xl-7">
              <a href="/admin/insideTender"><i class="mdi mdi-home-map-marker" style="font-size: 50px ;padding-right: 35%;"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div> <!-- row -->
<div class="row">
  <div class="col-12 col-xl-12 stretch-card">
    <div class="row flex-grow-1">

      <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
            <a href="/admin/outsideTender"><h6 class="card-title mb-0">{{__('outside Tender')}}</h6></a>
              <div class="dropdown mb-2">
              </div>
            </div>
            <div class="row">
              <div class="col-6 col-md-12 col-xl-5">
                <div class="d-flex align-items-baseline">
                  <p class="text-danger" style="font-size: 25px ; padding-top: 1rem;">
                    <span>{{$outsideTender}}</span>
                  </p>
                </div>
              </div>
              <div class="col-6 col-md-12 col-xl-7">
              <a href="/admin/outsideTender"><i class="mdi mdi-home-variant" style="font-size: 50px ;padding-right: 35%;"></i></a> 
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
              <a href="/admin/reviews"><h6 class="card-title mb-0">{{__('reviews')}} </h6></a>

            </div>
            <div class="row">
              <div class="col-6 col-md-12 col-xl-5">
                <div class="d-flex align-items-baseline">
                  <p class="text-danger" style="font-size: 25px ; padding-top: 1rem;">
                    <span>{{$reviews}}</span>
                  </p>
                </div>
              </div>
              <div class="col-6 col-md-12 col-xl-7">
              <a href="/admin/reviews"><i class="mdi mdi-thumbs-up-down" style="font-size: 50px ;padding-right: 35%;"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div> <!-- row -->
@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/chartjs/chart.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/jquery.flot/jquery.flot.js') }}"></script>
  <script src="{{ asset('assets/plugins/jquery.flot/jquery.flot.resize.js') }}"></script>
  <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/progressbar-js/progressbar.min.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/dashboard.js') }}"></script>
  <script src="{{ asset('assets/js/datepicker.js') }}"></script>
@endpush


@push('custom-scripts')
  <script src="{{ asset('assets/js/chartjs.js') }}"></script>
@endpush
