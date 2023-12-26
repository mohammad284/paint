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
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush
@push('plugin-styles')
  <link href="{{ asset('assets/plugins/@mdi/css/materialdesignicons.min.css') }}" rel="stylesheet" />
@endpush
@push('plugin-styles')
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
@section('content')



<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title"></h6>
        <p class="text-muted mb-3">{{__('اضافة مزود خدمة جديد')}}</p>
        <form class="forms-sample"  method="POST" enctype="multipart/form-data" action="/admin/storeProvider">
            @csrf

            <div class="row mb-6">
                <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('الاسم الاول')}}:</label>
                    <input class="form-control mb-4 mb-md-0" name="first_name"   required/>
                </div>
                <div class="col-md-6">
                    <label class="form-label">{{__('الاسم الاخير')}}:</label>
                    <input class="form-control mb-4 mb-md-0" name="last_name"  required/>
                </div>
                <div >
                <br>
              </div>
                <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('الايميل')}}:</label>
                    <input class="form-control mb-4 mb-md-0" name="email"   required/>
                </div>
                <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('الموبايل')}}:</label>
                    <input class="form-control mb-4 mb-md-0" name="mobile"   required/>
                </div>
                <div >
                <br>
              </div>
              <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('العنوان')}}</label>
                    <input class="form-control mb-4 mb-md-0" name="address"  required/>
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="exampleFormControlSelect1" class="form-label">{{__('الرمز البريدي')}}</label>
                    <select class="js-example-basic-single form-select" name="postal_code" id="postal_code"  data-width="100%" required>
                      <option selected disabled>{{__('الرمز البريدي')}}</option>
                        @foreach($postals as $postal)
                          <option value="{{$postal->id}}">{{$postal->Postal_Code}}-{{$postal->Place_Name}}/{{$postal->Admin_Name}}</option>
                        @endforeach 
                    </select>
                  </div>
                </div>
                <div >
                  <br>
                </div>
              <div class="col-md-6">
                  <div class="mb-3">
                    <label for="exampleFormControlSelect1" class="form-label">{{__('الجنس')}}</label>
                    <select class="js-example-basic-single form-select" name="gender" id="gender"  data-width="100%" required>
                      <option selected disabled>{{__('الجنس')}}</option>
                          <option value="0">{{__('ذكر')}}</option>
                          <option value="1">{{__('انثى')}}</option>
                          <option value="2">{{__('غير ذلك')}}</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="exampleFormControlSelect1" class="form-label">{{__('نوع العمل')}}</label>
                    <select class="js-example-basic-single form-select" name="work_type" id="work_type"  data-width="100%" required>
                      <option selected disabled>{{__('نوع العمل')}}</option>

                          <option value="1">{{__('خارجي')}}</option>
                          <option value="2">{{__('داخلي')}}</option>
                    </select>
                  </div>
                </div>
                <div >
                <br>
              </div>
              <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('اسم الشركة')}}:</label>
                    <input class="form-control mb-4 mb-md-0" name="company_name"   required/>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="exampleFormControlSelect1" class="form-label">{{__('الصيغة القانونية')}}</label>
                    <select class="js-example-basic-single form-select" name="Legal_form" id="Legal_form"  data-width="100%" required>
                      <option selected disabled>{{__('الصيغة القانونية')}}</option>

                          <option value="Natürliche Person / Einzelunternehmen">{{__('Natürliche Person / Einzelunternehmen')}}</option>
                          <option value="GmbH">{{__('GmbH')}}</option>
                          <option value="AG">{{__('AG')}}</option>
                          <option value="GbR">{{__('GbR')}}</option>
                          <option value="UG (haftungsbeschränkt)">{{__('UG (haftungsbeschränkt)')}}</option>
                          <option value="EK (Einzelkaufmann) / eU (Einzelunternehmer)">{{__('EK (Einzelkaufmann) / eU (Einzelunternehmer)')}}</option>
                          <option value="eingetragener Kaufmann (e.K)">{{__('eingetragener Kaufmann (e.K)')}}</option>
                          <option value="oHG, KG (einschl. GmbH & Co.KG)">{{__('oHG, KG (einschl. GmbH & Co.KG)')}}</option>
                          <option value="Ltd">{{__('Ltd')}}</option>
                          <option value="Sonstige Rechtsform">{{__('Sonstige Rechtsform')}}</option>
                    </select>
                  </div>
                </div>
                <div >
                <br>
              </div>
              <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('رقم الشارع')}}</label>
                    <input class="form-control mb-4 mb-md-0" name="street_num"  required/>
                </div>
                <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('رقم البيت')}}</label>
                    <input class="form-control mb-4 mb-md-0" name="home_num" required/>
                </div>
                <div >
                  <br>
                </div>
                <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('اسم البنك')}}</label>
                    <input class="form-control mb-4 mb-md-0" name="bank_name"  required/>
                </div>
                <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('اسم البطاقة البنكية')}}</label>
                    <input class="form-control mb-4 mb-md-0" name="card_name" required/>
                </div>
                <div >
                  <br>
                </div>
                <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('رقم البطاقة البنكية')}}</label>
                    <input class="form-control mb-4 mb-md-0" name="card_num"  required/>
                </div>
                <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('تاريخ انتهاء البطاقة البنكية')}}</label>
                    <input class="form-control mb-4 mb-md-0" name="card_time" required/>
                </div>
                <div >
                  <br>
                </div>
                <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('نوع البطاقة البنكية')}}</label>
                    <input class="form-control mb-4 mb-md-0" name="card_type"  required/>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="exampleFormControlSelect1" class="form-label">{{__('الصلاحيات')}}</label>
                    <select class="js-example-basic-single form-select" name="glossy" id="glossy"  data-width="100%" required>
                      <option selected disabled >{{__('الصلاحيات')}}</option>
                          <option value="0">{{__('بدون لكر')}}</option>
                          <option value="1">{{__('مع لكر')}}</option>
                    </select>
                  </div>
                </div>
                <div >
                  <br>
                </div>
                <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('كلمة المرور')}}:</label>
                    <input class="form-control mb-4 mb-md-0" name="password"   required/>
                </div>
                <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('تأكيد كلمة المرور')}}:</label>
                    <input class="form-control mb-4 mb-md-0" name="password_confirmation"   required/>
                </div>
                <div >
                <br>
              </div>
              <div class="row">
                  <div class="card">
                      <div class="card-body">
                          <h6 class="card-title">{{__('صورة البطاقة الحرفية من الامام')}}</h6>
                          <input type="file" id="myDropif" name="front_craft_card" required/>
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="card">
                      <div class="card-body">
                          <h6 class="card-title">{{__('صورة البطاقة الحرفية من الخلف')}}</h6>
                          <input type="file" id="myDropify2" name="back_craft_card" required/>
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="card">
                      <div class="card-body">
                          <h6 class="card-title">{{__('صورة شهادة العمل من الامام')}}</h6>
                          <input type="file" id="myDropif" name="front_work_certificate" required/>
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="card">
                      <div class="card-body">
                          <h6 class="card-title">{{__('صورة شهادة العمل من الخلف')}}</h6>
                          <input type="file" id="myDropif" name="back_work_certificate" required/>
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="card">
                      <div class="card-body">
                          <h6 class="card-title">{{__('صورة السجل التجاري من الامام')}}</h6>
                          <input type="file" id="myDropif" name="front_CR" required/>
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="card">
                      <div class="card-body">
                          <h6 class="card-title">{{__('صورة السجل التجاري من الخلف')}}</h6>
                          <input type="file" id="myDropif" name="back_CR" required/>
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="card">
                      <div class="card-body">
                          <h6 class="card-title">{{__('الصورة الشخصية')}}</h6>
                          <input type="file" id="myDropif" name="image" required/>
                      </div>
                  </div>
              </div>
            </div>

            <button type="submit" class="btn btn-primary me-2">{{__('حفظ')}}</button>
        </form>
      </div>
    </div>
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
