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
  <div class="col-md-12 grid-margin">
    <div class="card">
      <div class="card-body">
        <form class="forms-sample">
            <fieldset disabled="disabled">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">{{__('user name')}}</label>
                        <input class="form-control mb-4 mb-md-0" placeholder="{{$tender['user']->first_name}} {{$tender['user']->last_name}}"/>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('title')}}</label>
                        <input class="form-control mb-4 mb-md-0" placeholder="{{$tender->title}}"/>
                    </div>
                    <div class="col-md-12">
                        <br>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('category')}}</label>
                        <input class="form-control mb-4 mb-md-0" placeholder="{{$tender['categories']->translate($lang)->name}}"/>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('house type')}}</label>
                        <input class="form-control mb-4 mb-md-0"@if($tender->house_type == 1) placeholder="{{__('home')}}" @elseif($tender->house_type == 2) placeholder="{{__('Hall')}}" @elseif($tender->house_type == 3) placeholder="{{__('warehouse')}}" @else placeholder="{{__('Cellar')}}"@endif/>
                    </div>
                    <div class="col-md-12">
                        <br>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('note')}}</label>
                        <input class="form-control mb-4 mb-md-0"  placeholder="{{$tender->note}}" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('text')}}</label>
                        <input class="form-control mb-4 mb-md-0"  placeholder="{{$tender->text}}"/>
                    </div>
                    <div class="col-md-12">
                        <br>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('space')}}</label>
                        <input class="form-control mb-4 mb-md-0"  placeholder="{{$tender->space}}{{$tender->space_unit}}"/>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('height')}}</label>
                        <input class="form-control mb-4 mb-md-0" placeholder="{{$tender->height}}{{$tender->hight_unit}}" />
                    </div>
                    <div class="col-md-12">
                        <br>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('postal code')}}</label>
                        <input class="form-control mb-4 mb-md-0" placeholder="{{$tender['postal']->Postal_Code}}" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('city')}}</label>
                        <input class="form-control mb-4 mb-md-0" placeholder="{{$tender['postal']->Place_Name}}" />
                    </div>
                    <div class="col-md-12">
                        <br>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('expected date')}} </label>
                        <input class="form-control mb-4 mb-md-0" placeholder="{{$tender->expected_date}}" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('plaster')}} </label>
                        @if($tender->plaster == 1)
                        <input class="form-control mb-4 mb-md-0" placeholder="{{__('Grooved plaster')}}" />
                        @elseif($tender->plaster == 2)
                        <input class="form-control mb-4 mb-md-0" placeholder="{{__('Felt plaster')}}" />
                        @elseif($tender->plaster == 3)
                        <input class="form-control mb-4 mb-md-0" placeholder="{{__('Scratch plaster')}}" />
                        @elseif($tender->plaster == 4)
                        <input class="form-control mb-4 mb-md-0" placeholder="{{__('Decorative plaster')}}" />
                        @elseif($tender->plaster == 5)
                        <input class="form-control mb-4 mb-md-0" placeholder="{{__('Window cleaning')}}" />
                        @elseif($tender->plaster == 6)
                        <input class="form-control mb-4 mb-md-0" placeholder="{{__('Roughcast')}}" />
                        @else
                        <input class="form-control mb-4 mb-md-0" placeholder="{{__('No information')}}" />
                        @endif
                    </div>
                    <div class="col-md-12">
                        <br>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('service')}} </label>
                        <input class="form-control mb-4 mb-md-0" @if($tender['service'] != null) placeholder="{{$tender['service']->translate($lang)->name}}"@endif />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('building type')}} </label>
                        <input class="form-control mb-4 mb-md-0" placeholder="{{$tender['building']->translate($lang)->name}}" />
                    </div>
                    <div class="col-md-12">
                        <br>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('floar type')}} </label>
                        <input class="form-control mb-4 mb-md-0" placeholder="{{$tender['floar']->translate($lang)->name}}" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('old color')}} </label>
                        <input class="form-control mb-4 mb-md-0"@if($tender['oldcolor'] != null) placeholder="{{$tender['oldcolor']->name}}"@endif />
                    </div>
                    <div class="col-md-12">
                        <br>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('new color')}} </label>
                        <input class="form-control mb-4 mb-md-0"@if($tender['newcolor'] != null) placeholder="{{$tender['newcolor']->name}}" @endif/>
                    </div>
                    <div class="col-md-6">
                    </div>
                    <div class="col-md-12">
                        <br>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('house access')}} </label>
                        @if($tender->house_access == 1)
                        <input class="form-control mb-4 mb-md-0" placeholder="{{__('Access possible')}}" />
                        @elseif($tender->house_access == 2)
                        <input class="form-control mb-4 mb-md-0" placeholder="{{__('Access difficult')}}" />
                        @else
                        <input class="form-control mb-4 mb-md-0" placeholder="{{__('No information')}}" />
                        @endif
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('status building')}} </label>
                        @if($tender->status_building == 1)
                        <input class="form-control mb-4 mb-md-0" placeholder="{{__('Detached')}}" />
                        @elseif($tender->status_building == 2)
                        <input class="form-control mb-4 mb-md-0" placeholder="{{__('Adjoining house')}}" />
                        @elseif($tender->status_building == 3)
                        <input class="form-control mb-4 mb-md-0" placeholder="{{__('adjacent hedge/bush')}}" />
                        @else
                        <input class="form-control mb-4 mb-md-0" placeholder="{{__('Non of all')}}" />
                        @endif
                    </div>
                    <div class="col-md-12">
                        <br>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('scaffolding')}} </label>
                        @if($tender->scaffolding == 0)
                        <input class="form-control mb-4 mb-md-0" placeholder="{{__('No')}}" />
                        @else
                        <input class="form-control mb-4 mb-md-0" placeholder="{{__('Yes')}}" />
                        @endif
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('add surface')}} </label>
                        @if($tender->add_surface == 1)
                        <input class="form-control mb-4 mb-md-0" placeholder="{{__('window')}}" />
                        @elseif($tender->add_surface == 2)
                        <input class="form-control mb-4 mb-md-0" placeholder="{{__('doors')}}" />
                        @elseif($tender->add_surface == 3)
                        <input class="form-control mb-4 mb-md-0" placeholder="{{__('gable')}}" />
                        @elseif($tender->add_surface == 4)
                        <input class="form-control mb-4 mb-md-0" placeholder="{{__('roof boxes')}}" />
                        @else
                        <input class="form-control mb-4 mb-md-0" placeholder="{{__('none')}}" />
                        @endif
                    </div>
                    <div class="col-md-12">
                        <br>
                    </div>

                </div>
            </fieldset>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">{{__('walls damage')}}</h6>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>{{__('wall')}}</th>
                <th>{{__('damage')}}</th>
              </tr>
            </thead>
            <tbody>
                <?php $i = 1 ?>
                @foreach($tender['out_wall'] as $wall)
                <tr>
                    <td>{{$i}}</td>
                    @if($wall->damage == 1)
                    <td>{{__('No visiable damage')}}</td>
                    @elseif($wall->damage == 2)
                    <td>{{__('Minor damage(e.g.cracks)')}}</td>
                    @elseif($wall->damage == 3)
                    <td>{{__('major damage(e.g.spalling)')}}</td>
                    @else
                    <td>{{__('Visiable dirt')}}</td>
                    @endif
                </tr>
                <?php $i =$i+1 ?>
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
        <h6 class="card-title">{{__('tender images')}}</h6>
        <div class="owl-carousel owl-theme owl-animate-css">
        @foreach($images as $image)
          <div class="item">
            <img style="height: 400px;" src="{{asset($image->image)}}" alt="item-image">
          </div>

          @endforeach
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