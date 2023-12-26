@extends('dashboard.layout.master')
@push('plugin-styles')
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/jquery-tags-input/jquery.tagsinput.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/bootstrap-colorpicker/bootstrap-colorpicker.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />
@endpush
@push('plugin-styles')
  <link href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
@endpush
@push('plugin-styles')
    <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush
@push('plugin-styles')
    <link href="{{ asset('assets/plugins/@mdi/css/materialdesignicons.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/prismjs/prism.css') }}" rel="stylesheet" />
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
<!-- Message -->
@if(session()->has('message'))
<p class="message-box" >
    {{ session()->get('message') }}
</p>
@endif
<!-- ./Message -->
@section('content')

<!-- <div class="row">
  <div class="col-12 col-xl-12 stretch-card">
    <div class="row flex-grow-1">

      <div class="col-md-4 grid-margin stretch-card">
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
                    <span></span>
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

      <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
              <a href="/admin/allUser"><h6 class="card-title mb-0">{{__('users')}} </h6></a>

            </div>
            <div class="row">
              <div class="col-6 col-md-12 col-xl-5">
                <div class="d-flex align-items-baseline">
                  <p class="text-danger" style="font-size: 25px ; padding-top: 1rem;">
                    <span></span>
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
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
              <a href="/admin/allUser"><h6 class="card-title mb-0">{{__('users')}} </h6></a>

            </div>
            <div class="row">
              <div class="col-6 col-md-12 col-xl-5">
                <div class="d-flex align-items-baseline">
                  <p class="text-danger" style="font-size: 25px ; padding-top: 1rem;">
                    <span></span>
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
</div> row -->
<div class="row">
  <div class="col-12 col-xl-12 stretch-card">
    <div class="row flex-grow-1">
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title mb-0">{{__('earnings')}}</h6>
              <div class="dropdown mb-2">
              </div>
            </div>
            <div class="row">
              <div class="col-6 col-md-12 col-xl-5">
                <h3 class="mb-2">{{$first_product}}</h3>
                <div class="d-flex align-items-baseline">
                    @if($res_sall < 0 )
                    <p class="text-danger">
                        <span>{{$res_sall}}%</span>
                        <i data-feather="arrow-down" class="icon-sm mb-1"></i>
                    </p>
                    @else
                    <p class="text-success">
                        <span>{{$res_sall}}%</span>
                        <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                    </p>
                    @endif
                </div>
              </div>
              <div class="col-6 col-md-12 col-xl-7">
                <div id="customersChart" class="mt-md-3 mt-xl-0"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title mb-0">{{__('favorite')}}</h6>
              <div class="dropdown mb-2">

              </div>
            </div>
            <div class="row">
              <div class="col-6 col-md-12 col-xl-5">
                <h3 class="mb-2">{{$product->favorite_count}}</h3>
                <div class="d-flex align-items-baseline">
                    @if($res_fav < 0 )
                        <p class="text-danger">
                            <span>{{$res_fav}}%</span>
                            <i data-feather="arrow-down" class="icon-sm mb-1"></i>
                        </p>
                    @elseif($res_fav >= 0)
                        <p class="text-success">
                            <span>{{$res_fav}}%</span>
                            <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                        </p>
                    @endif
                </div>
              </div>
              <div class="col-6 col-md-12 col-xl-7">
                <div id="ordersChart" class="mt-md-3 mt-xl-0"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title mb-0">{{__('the sales')}}</h6>
              <div class="dropdown mb-2">
              </div>
            </div>
            <div class="row">
              <div class="col-6 col-md-12 col-xl-5">
                <h3 class="mb-2">{{$first_product}}</h3>
                <div class="d-flex align-items-baseline">
                    @if($res_pro < 0)
                        <p class="text-danger">
                            <span>{{$res_pro}}%</span>
                            <i data-feather="arrow-down" class="icon-sm mb-1"></i>
                        </p>
                    @else
                        <p class="text-success">
                            <span>{{$res_pro}}%</span>
                            <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                        </p>
                    @endif
                </div>
              </div>
              <div class="col-6 col-md-12 col-xl-7">
                <div id="growthChart" class="mt-md-3 mt-xl-0"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> <!-- row -->
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
        <div class="card-body">
            <h6 class="card-title">{{__('product details')}}</h6>
            <div class="table-responsive">
            <table id="dataTableExample" class="table">
                <thead>
                <tr>
                    <th>{{__('product name')}}</th>
                    <th>{{__('company name')}}</th>
                    <th>{{__('category')}}</th>
                    <th>{{__('amount')}}</th>
                    <th>{{__('color')}}</th>
                    <th>{{__('Selling price')}}</th>
                    <th>{{__('buying price')}}</th>
                    <th>{{__('size')}}</th>
                    <th>{{__('rate')}}</th>
                    <th>{{__('created at')}}</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$product->product_name}}</td>
                        <td>{{$product->company_name}}</td>
                        <td>{{$product['product_category']->translate('en')->name}}</td>
                        <td>{{$product->amount}}</td>
                        <td>{{$product['product_color']->name}}</td>
                        <td>{{$product->Selling_price}}</td>
                        <td>{{$product->buying_price}}</td>
                        <td>{{$product['product_size']->size}}</td>
                        <td>{{$product->rate}}</td>
                        <td>{{$product->created_at}}</td>
                    </tr>
                </tbody>
            </table>
            </div>
        </div>
        </div>
    </div>
</div>
    <div class="example">
      <div class="row">
        @foreach($product['product_image'] as $img)
            <div class="col-12 col-md-6 col-xl-3">
              <div><br></div>
            <div class="card">
                <a  href="/admin/categoryCars/{{$img->id}}">
                  <img style="height: 160px;" src="{{asset($img->image)}}"  class="card-img-top" alt="..."></a>
                <div class="card-body">
                  <a  title="{{__('delete product')}}" href="/admin/deleteProductImage/{{$img->id}}"> <i data-feather="trash"></i></i></a>
                </div>
            </div>
            </div>
        @endforeach
      </div>
    </div>
@endsection
@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/inputmask/jquery.inputmask.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/typeahead-js/typeahead.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-tags-input/jquery.tagsinput.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/dropify/js/dropify.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-colorpicker/bootstrap-colorpicker.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/form-validation.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-maxlength.js') }}"></script>
    <script src="{{ asset('assets/js/inputmask.js') }}"></script>
    <script src="{{ asset('assets/js/select2.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead.js') }}"></script>
    <script src="{{ asset('assets/js/tags-input.js') }}"></script>
    <script src="{{ asset('assets/js/dropify.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-colorpicker.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker.js') }}"></script>
    <script src="{{ asset('assets/js/timepicker.js') }}"></script>
@endpush
@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush
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