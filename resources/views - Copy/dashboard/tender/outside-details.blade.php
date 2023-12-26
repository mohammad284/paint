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
                        <label class="form-label">{{__('اسم مقدم المناقصة')}}</label>
                        <input class="form-control mb-4 mb-md-0" placeholder="{{$tender['user']->first_name}}"/>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('عنوان المناقصة')}}</label>
                        <input class="form-control mb-4 mb-md-0" placeholder="{{$tender->title}}"/>
                    </div>
                    <div class="col-md-12">
                        <br>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('التصنيف')}}</label>
                        <input class="form-control mb-4 mb-md-0" placeholder="{{$tender->category}}"/>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('نوع البناء')}}</label>
                        <input class="form-control mb-4 mb-md-0" placeholder="{{$tender->house_type}}"/>
                    </div>
                    <div class="col-md-12">
                        <br>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('ملاحظات')}}</label>
                        <input class="form-control mb-4 mb-md-0"  placeholder="{{$tender->note}}" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('النص')}}</label>
                        <input class="form-control mb-4 mb-md-0"  placeholder="{{$tender->text}}"/>
                    </div>
                    <div class="col-md-12">
                        <br>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('المساحة')}}</label>
                        <input class="form-control mb-4 mb-md-0"  placeholder="{{$tender->space}}{{$tender->space_unit}}"/>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('الارتفاع')}}</label>
                        <input class="form-control mb-4 mb-md-0" placeholder="{{$tender->height}}{{$tender->hight_unit}}" />
                    </div>
                    <div class="col-md-12">
                        <br>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('الرمز البريدي')}}</label>
                        <input class="form-control mb-4 mb-md-0" placeholder="{{$tender['postal']->Postal_Code}}" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('المدينة')}}</label>
                        <input class="form-control mb-4 mb-md-0" placeholder="{{$tender['postal']->Admin_Name}}" />
                    </div>
                    <div class="col-md-12">
                        <br>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('الوقت المتوقع')}} </label>
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
                        <label class="form-label">{{__('الخدمة')}} </label>
                        <input class="form-control mb-4 mb-md-0" placeholder="{{$tender['service']->translate($lang)->name}}" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('نوع البناء')}} </label>
                        <input class="form-control mb-4 mb-md-0" placeholder="{{$tender['building']->translate($lang)->name}}" />
                    </div>
                    <div class="col-md-12">
                        <br>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('نوع الارضيات')}} </label>
                        <input class="form-control mb-4 mb-md-0" placeholder="{{$tender['floar']->translate($lang)->name}}" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('اللون القديم')}} </label>
                        <input class="form-control mb-4 mb-md-0" placeholder="{{$tender->old_color}}" />
                    </div>
                    <div class="col-md-12">
                        <br>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('اللون الجديد')}} </label>
                        <input class="form-control mb-4 mb-md-0" placeholder="{{$tender['newcolor']->name}}" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('المواد المطلوبة')}} </label>
                        <input class="form-control mb-4 mb-md-0" placeholder="{{$tender->material_required}}" />
                    </div>
                    <div class="col-md-12">
                        <br>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('الوصول للبيت')}} </label>
                        @if($tender->house_access == 1)
                        <input class="form-control mb-4 mb-md-0" placeholder="{{__('سهل الوصول')}}" />
                        @elseif($tender->house_access == 2)
                        <input class="form-control mb-4 mb-md-0" placeholder="{{__('صعب الوصول')}}" />
                        @else
                        <input class="form-control mb-4 mb-md-0" placeholder="{{__('لا معلومات')}}" />
                        @endif
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('حالة البناء')}} </label>
                        @if($tender->status_building == 1)
                        <input class="form-control mb-4 mb-md-0" placeholder="{{__('منفصل')}}" />
                        @elseif($tender->status_building == 2)
                        <input class="form-control mb-4 mb-md-0" placeholder="{{__('مع جيران')}}" />
                        @elseif($tender->status_building == 3)
                        <input class="form-control mb-4 mb-md-0" placeholder="{{__('مع حديقة')}}" />
                        @else
                        <input class="form-control mb-4 mb-md-0" placeholder="{{__('ولا واحدة منهم')}}" />
                        @endif
                    </div>
                    <div class="col-md-12">
                        <br>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('سقالات')}} </label>
                        @if($tender->scaffolding == 0)
                        <input class="form-control mb-4 mb-md-0" placeholder="{{__('لا')}}" />
                        @else
                        <input class="form-control mb-4 mb-md-0" placeholder="{{__('نعم')}}" />
                        @endif
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{__('اضافة اسطح اخرى')}} </label>
                        @if($tender->add_surface == 1)
                        <input class="form-control mb-4 mb-md-0" placeholder="{{__('نوافذ')}}" />
                        @elseif($tender->add_surface == 2)
                        <input class="form-control mb-4 mb-md-0" placeholder="{{__('ابواب')}}" />
                        @elseif($tender->add_surface == 3)
                        <input class="form-control mb-4 mb-md-0" placeholder="{{__('الجملون')}}" />
                        @elseif($tender->add_surface == 4)
                        <input class="form-control mb-4 mb-md-0" placeholder="{{__('اترنيت')}}" />
                        @else
                        <input class="form-control mb-4 mb-md-0" placeholder="{{__('ولا واحدة منهم')}}" />
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
        <h6 class="card-title">{{__('ضرر الجدران')}}</h6>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>{{__('الجدار')}}</th>
                <th>{{__('الضرر')}}</th>
              </tr>
            </thead>
            <tbody>
                <?php $i = 1 ?>
                @foreach($tender['out_wall'] as $wall)
                <tr>
                    <td>{{$i}}</td>
                    @if($wall->damage == 1)
                    <td>{{__('لا ضرر واضح')}}</td>
                    @elseif($wall->damage == 2)
                    <td>{{__('ضرر طفيف (مثل الشقوق)')}}</td>
                    @elseif($wall->damage == 3)
                    <td>{{__('أضرار جسيمة (مثل الهدم)')}}</td>
                    @else
                    <td>{{__('الأوساخ المرئية')}}</td>
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
        <h6 class="card-title">{{__('صور المناقصة')}}</h6>
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