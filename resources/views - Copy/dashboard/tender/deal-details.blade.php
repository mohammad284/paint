@extends('dashboard.layout.master')
<?php
  $lang = Session('locale');
  if ($lang != "en") {
      $lang = "gr";
  }
?>
@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <div class="container-fluid d-flex justify-content-between">
          <div class="col-lg-5 ps-0">
            <a  class="noble-ui-logo d-block mt-3">{{__('مزود الخدمة')}}</a>  
            <img style="height: 200px;" src="" alt="item-image">     
            <br>
            <br>
            <p class="mt-1 mb-1"><b>{{__('اسم مزود الخدمة')}}:</b>{{$deal['provider']->first_name}} {{$deal['provider']->last_name}}</p>
            <p class="mt-1 mb-1"><b>{{__('الايميل')}}:</b><a href="/admin/detailsProvider/{{$deal['provider']->id}}">{{$deal['provider']->email}}</a></p>
            <p class="mt-1 mb-1"><b>{{__('الموبايل')}}:</b>{{$deal['provider']->mobile}}</p>
            <p class="mt-1 mb-1"><b>{{__('العنوان')}}:</b>{{$deal['provider']->address}}</p>
            <p class="mt-1 mb-1"><b>{{__('التقييم')}}:</b>{{$deal['provider']->rate}}</p>
            <p class="mt-1 mb-1"><b>{{__('الجنس')}}:</b>@if($deal['provider']->gender == '0'){{__('ذكر')}}@elseif($deal['provider']->gender == '1'){{__('انثى')}}@elseif($deal['provider']->gender == '2'){{__('غير ذلك')}}@endif</p>
            <p class="mt-1 mb-1"><b>{{__('الرمز البريدي')}}:</b>{{$deal->provider->postal->Postal_Code}}</p>
            <p class="mt-1 mb-1"><b>{{__('المدينة')}}:</b>{{$deal->provider->postal->Admin_Name}}</p>
            <p class="mt-1 mb-1"><b>{{__('اسم الشركة')}}:</b>{{$deal['provider']->company_name}}</p>
            <p class="mt-1 mb-1"><b>{{__('الصيغة القانونية')}}:</b>{{$deal['provider']->Legal_form}}</p>
            <p class="mt-1 mb-1"><b>{{__('نوع العمل')}}:</b>@if($deal['provider']->work_type == '1'){{__('external')}}@else{{__('internal')}}@endif</p>
            <h5 class="mt-5 mb-2 text-muted">{{__('العرض')}} :</h5> 
            <p><b>{{__('العرض المقدم')}}:</b>{{$deal->offer}}.</p>
            <p><b>{{__('تاريخ تقديم العرض')}}:</b>{{$deal->updated_at}}.</p>

          </div>
          <div class="col-lg-5 pe-0">
          <a  class="noble-ui-logo d-block mt-3">{{__('مقدم المناقصة')}}</a> 
          <p class="mt-1 mb-1"><b>{{__('اسم مقدم المناقصة')}}:</b>{{$all_details['user']->first_name}} {{$all_details['user']->last_name}}</p>
            <p class="mt-1 mb-1"><b>{{__('الايميل')}}:</b>{{$all_details['user']->email}}</p>
            <p class="mt-1 mb-1"><b>{{__('الموبايل')}}:</b>{{$all_details['user']->mobile}}</p>
            <p class="mt-1 mb-1"><b>{{__('العنوان')}}:</b>{{$all_details['user']->address}}</p>
            <p class="mt-1 mb-1"><b>{{__('التقييم')}}:</b>{{$deal['provider']->rate}}</p>
            <p class="mt-1 mb-1"><b>{{__('الرمز البريدي')}}:</b>{{$deal->user->postal->Postal_Code}}</p>
            <p class="mt-1 mb-1"><b>{{__('المدينة')}}:</b>{{$deal->user->postal->Admin_Name}}</p>
            <h5 class="mt-5 mb-2 text-muted">{{__('المناقصة')}} :</h5>
            <p><b>{{__('العنوان')}}:</b>{{$all_details->title}},<br>
            <b>{{__('المساحة')}}:</b> {{$all_details->space}} {{$all_details->space_unit}},<br>
            <b>{{__('الارتفاع')}}:</b> {{$all_details->height}}{{$all_details->hight_unit}}</p>
            <b>{{__('الرمز البريدي')}}:</b> {{$all_details->postal->Postal_Code}},<br>
            <b>{{__('المدينة')}}:</b> {{$all_details->postal->Admin_Name}},<br>
            <b>{{__('ملاحظات')}}:</b> {{$all_details->note}},<br>
            <b>{{__('الوقت المتوقع')}}:</b> {{$all_details->expected_date}},<br>
            @if($all_details->inside == '0') 
            <b>{{__('التصنيف')}}:</b> {{$all_details['categories']->translate($lang)->name}},<br>
            <b>{{__('الخدمات')}}:</b> {{$all_details['service']->translate($lang)->name}},<br>
            <b>{{__('نوع البناء')}}:</b> {{$all_details['building']->translate($lang)->name}},<br>
            <b>{{__('نوع الارضيات')}}:</b> {{$all_details['floar']->translate($lang)->name}},<br>
            <b>{{__('اللون القديم')}}:</b> {{$all_details->old_color}},<br>
            <b>{{__('اللون الجديد')}}:</b> {{$all_details['newcolor']->name}},<br>
            <b>{{__('الوصول للبيت')}}:</b>  @if($all_details->house_access == 1) {{__('Access possible')}}@elseif($all_details->house_access == 2){{__('Access difficult')}}@else{{__('No information')}}@endif,<br>
            <b>{{__('حالة البناء')}}:</b> @if($all_details->status_building == 1){{__('منفصل')}}@elseif($all_details->status_building == 2){{__('مع جيران')}}@elseif($all_details->status_building == 3){{__('مع حديقة')}}@else{{__('ولا واحدة منهم')}} @endif,<br>
            <b>{{__('اضافة اسطح اخرى')}}:</b> @if($all_details->add_surface == 1){{__('نوافذ')}}@elseif($all_details->add_surface == 2){{__('ابواب')}}@elseif($all_details->add_surface == 3){{__('الجملون')}}@elseif($all_details->add_surface == 4){{__('اترنيت')}}@else{{__('ولا واحدة منهم')}}@endif,<br>
            <b>{{__('السقالات')}}:</b> @if($all_details->scaffolding == 0){{__('لا')}}@else{{__('نعم')}}@endif,<br>
            <b>{{__('plaster')}}:</b> @if($all_details->plaster == 1) {{__('Grooved plaster')}} @elseif($all_details->plaster == 2){{__('Felt plaster')}}@elseif($all_details->plaster == 3){{__('Scratch plaster')}}@elseif($all_details->plaster == 4){{__('Decorative plaster')}} @elseif($all_details->plaster == 5){{__('Window cleaning')}}@elseif($all_details->plaster == 6){{__('Roughcast')}}@else{{__('No information')}}@endif,<br>
            <b>{{__('material required')}}:</b>{{$all_details->material_required	}},<br>
            @endif 
            </p>
          </div>
        </div>
        @if($all_details->inside == '1')
          <div class="container-fluid mt-5 d-flex justify-content-center w-100">
            <div class="table-responsive w-100">
                <table class="table table-bordered">
                  <thead>
                      <tr>
                        <th>{{__('الاسم')}}</th>
                        <th>{{__('الحالة القديمة')}}</th>
                        <th>{{__('الحالة الجديدة')}}</th>
                        <th>{{__('الضرر')}}</th>
                        <th>{{__('المساحة/الارتفاع')}}</th>
                        <th>{{__('اللون القديم')}}</th>
                        <th>{{__('اللون الجديد')}}</th>
                        <th>{{__('اللكر')}}</th>
                        <th>{{__('الحالة القديمة دهان؟')}}</th>
                        <th>{{__('الحالة القديمة ورق جدران؟')}}</th>
                        <th>{{__('الحالة القديمة معجونة؟')}}</th>
                        <th>{{__('الحالة القديمة جص؟')}}</th>
                        <th>{{__('الحالة الجديدة دهان؟')}}</th>
                        <th>{{__('الحالة الجديدة ورق جدران؟')}}</th>
                        <th>{{__('الحالة الجديدة معجونة؟')}}</th>
                        <th>{{__('الحالة الجديدة جص؟')}}</th>
                        <th>{{__('عدد طبقات المعجونة')}}</th>
                        <th>{{__('تقشير الحالة القديمة')}}</th>
                        <th>{{__('عدد الثقوب')}}</th>
                        <th>{{__('عدد الشقوق')}}</th>
                        <th>{{__('نوع ورق الجدران')}}</th>
                        <th>{{__('شكل الزوايا')}}</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach($all_rooms as $room)
                          @foreach($room['walls'] as $wall)
                              <tr class="text-end">
                              <td>{{__('جدران')}}</td>
                              <td>#####</td>
                              <td>#####</td>
                              <td>{{$wall->damage}}%</td>
                              <td>#####</td>
                              @if($wall['oldcolor'] == null)
                              <td><span class="badge bg-success" style="background-color:; margin-right:60%;">####</td>
                              @endif
                              @if($wall['oldcolor'] != null)
                              <td><span class="badge bg-success" style="background-color:#{{$wall['oldcolor']->hex}}; margin-right:60%;">{{$wall['oldcolor']->name}}</td>
                              @endif
                              @if($wall['newcolor'] == null)
                              <td><span class="badge bg-success" style="background-color:; margin-right:60%;">####</td>
                              @endif
                              @if($wall['newcolor'] != null)
                              <td><span class="badge bg-success" style="background-color:#{{$wall['newcolor']->hex}}; margin-right:60%;">{{$wall['newcolor']->name}}</td>
                              @endif
                              <td>#####</td>
                              @if($wall->old_status_paint == 1)
                              <td>{{__('نعم')}}</td>@else<td>{{__('لا')}}</td>
                              @endif
                              @if($wall->old_status_paper)
                              <td>{{__('نعم')}}</td>@else<td>{{__('لا')}}</td>
                              @endif
                              @if($wall->old_status_paste)
                              <td>{{__('نعم')}}</td>@else<td>{{__('لا')}}</td>
                              @endif
                              @if($wall->old_status_plaster)
                              <td>{{__('نعم')}}</td>@else<td>{{__('لا')}}</td>
                              @endif
                              @if($wall->new_status_paint)
                              <td>{{__('نعم')}}</td>@else<td>{{__('لا')}}</td>
                              @endif
                              @if($wall->new_status_paper)
                              <td>{{__('نعم')}}</td>@else<td>{{__('لا')}}</td>
                              @endif
                              @if($wall->new_status_paste)
                              <td>{{__('نعم')}}</td>@else<td>{{__('لا')}}</td>
                              @endif
                              @if($wall->new_status_plaster)
                              <td>{{__('نعم')}}</td>@else<td>{{__('لا')}}</td>
                              @endif
                              <td>{{$wall->num_paste}}</td>
                              @if($wall->peeling_wallpaper)
                              <td>{{__('نعم')}}</td>@else<td>{{__('لا')}}</td>
                              @endif
                              <td>{{$wall->number_holes}}</td>
                              <td>{{$wall->number_incisions}}</td>

                              <td>{{$wall->paper_type}}</td>
                              @if($wall->corner_style)
                              <td>{{__('نعم')}}</td>@else<td>{{__('لا')}}</td>
                              @endif
                              </tr>
                          @endforeach
                          @foreach($room['windows'] as $window)
                              <tr class="text-end">
                              <td>{{__('النوافذ')}}</td>
                              <td>{{$window->old_status}}</td>
                              <td>{{$window->new_status}}</td>
                              <td>{{$window->damage}}%</td>
                              <td>#####</td>
                              @if($window['old_color'] == null)
                              <td><span class="badge bg-success" style="background-color:##; margin-right:60%;">##</td>@endif
                              @if($window['old_color'] != null)
                              <td><span class="badge bg-success" style="background-color:; margin-right:60%;">{{$window->old_color}}</td>@endif
                              @if($window['newcolor'] == null)
                              <td><span class="badge bg-success" style="background-color:##; margin-right:60%;">{{$window['newcolor']->color}}</td>@endif
                              @if($window['newcolor'] != null)
                              <td><span class="badge bg-success" style="background-color:#{{$window['newcolor']->hex}}; margin-right:60%;">{{$window['newcolor']->name}}</td>@endif
                              @if($window->glossy == 0) <td>{{__('بدون لكر')}} </td> @endif
                              @if($window->glossy == 1) <td> {{__('النافذة')}}</td> @endif
                              @if($window->glossy == 2) <td>{{__('اطار النافذة')}} </td> @endif
                              @if($window->glossy == 3) <td> {{__('الاثنين معا')}} </td> @endif
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              </tr>
                          @endforeach
                          @foreach($room['roofs'] as $roof)
                              <tr class="text-end">
                              <td>{{__('الاسقف')}}</td>
                              <td>#####</td>
                              <td>#####</td>
                              <td>{{$roof->damage}}%</td>
                              <td>#####</td>
                              @if($roof['oldcolor'] == null)
                              <td><span class="badge bg-success" style="background-color:; margin-right:60%;">####</td>
                              @endif
                              @if($roof['oldcolor'] != null)
                              <td><span class="badge bg-success" style="background-color:#{{$roof['oldcolor']->hex}}; margin-right:60%;">{{$roof['oldcolor']->name}}</td>
                              @endif
                              @if($roof['newcolor'] == null)
                              <td><span class="badge bg-success" style="background-color:; margin-right:60%;">####</td>
                              @endif
                              @if($roof['newcolor'] != null)
                              <td><span class="badge bg-success" style="background-color:#{{$roof['newcolor']->hex}}; margin-right:60%;">{{$roof['newcolor']->name}}</td>
                              @endif
                              <td>#####</td>
                              @if($roof->old_status_paint == 1)
                              <td>{{__('نعم')}}</td>@else<td>{{__('لا')}}</td>
                              @endif
                              @if($roof->old_status_paper)
                              <td>{{__('نعم')}}</td>@else<td>{{__('لا')}}</td>
                              @endif
                              @if($roof->old_status_paste)
                              <td>{{__('نعم')}}</td>@else<td>{{__('لا')}}</td>
                              @endif
                              @if($roof->old_status_plaster)
                              <td>{{__('نعم')}}</td>@else<td>{{__('لا')}}</td>
                              @endif
                              @if($roof->new_status_paint)
                              <td>{{__('نعم')}}</td>@else<td>{{__('لا')}}</td>
                              @endif
                              @if($roof->new_status_paper)
                              <td>{{__('نعم')}}</td>@else<td>{{__('لا')}}</td>
                              @endif
                              @if($roof->peeling_wallpaper)
                              <td>{{__('نعم')}}</td>@else<td>{{__('لا')}}</td>
                              @endif
                              @if($roof->new_status_paste)
                              <td>{{__('نعم')}}</td>@else<td>{{__('لا')}}</td>
                              @endif
                              <td>{{$roof->num_paste}}</td>
                              @if($roof->new_status_plaster)
                              <td>{{__('نعم')}}</td>@else<td>{{__('لا')}}</td>
                              @endif
                              <td>{{$roof->number_holes}}</td>
                              <td>{{$roof->number_incisions}}</td>

                              <td>{{$roof->paper_type}}</td>
                              @if($roof->corner_style)
                              <td>{{__('نعم')}}</td>@else<td>{{__('لا')}}</td>
                              @endif
                              </tr>
                          @endforeach
                          @foreach($room['doors'] as $door)
                              <tr class="text-end">
                                <td>{{__('الابواب')}}</td>
                                <td>{{$door->old_status}}</td>
                                <td>{{$door->new_status}}</td>
                                <td>{{$door->damage}}%</td>
                                <td>#####</td>
                                @if($door['old_color'] == null)
                                <td><span class="badge bg-success" style="background-color:##; margin-right:60%;">##</td>@endif
                                @if($door['old_color'] != null)
                                <td><span class="badge bg-success" style="background-color:; margin-right:60%;">{{$door->old_color}}</td>@endif
                                @if($door['newcolor'] == null)
                                <td><span class="badge bg-success" style="background-color:##; margin-right:60%;">{{$door['newcolor']->color}}</td>@endif
                                @if($door['newcolor'] != null)
                                <td><span class="badge bg-success" style="background-color:#{{$door['newcolor']->hex}}; margin-right:60%;">{{$door['newcolor']->name}}</td>@endif
                                @if($door->glossy == 0) <td>{{__('بدون لكر')}} </td> @endif
                                @if($door->glossy == 1) <td> {{__('الباب')}}</td> @endif
                                @if($door->glossy == 2) <td>{{__('اطار الباب')}} </td> @endif
                                @if($door->glossy == 3) <td> {{__('الاثنين معا')}} </td> @endif
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                              </tr>
                          @endforeach
                          @foreach($room['edges'] as $edge)
                              <tr class="text-end">
                                <td>{{__('الحواف')}}</td>
                                <td>{{$edge->old_status}}</td>
                                <td>{{$edge->new_status}}</td>
                                <td>{{$edge->damage}}%</td>
                                <td>{{$edge->area}}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                              </tr>
                          @endforeach
                          @foreach($room['corridors'] as $corridor)
                              <tr class="text-end">
                                <td>{{__('الممرات')}}</td>
                                <td>#####</td>
                                <td>#####</td>
                                <td>{{$corridor->damage}}%</td>
                                <td>#####</td>
                                @if($corridor['oldcolor'] == null)
                                <td><span class="badge bg-success" style="background-color:; margin-right:60%;">####</td>
                                @endif
                                @if($corridor['oldcolor'] != null)
                                <td><span class="badge bg-success" style="background-color:#{{$corridor['oldcolor']->hex}}; margin-right:60%;">{{$corridor['oldcolor']->name}}</td>
                                @endif
                                @if($corridor['newcolor'] == null)
                                <td><span class="badge bg-success" style="background-color:; margin-right:60%;">####</td>
                                @endif
                                @if($corridor['newcolor'] != null)
                                <td><span class="badge bg-success" style="background-color:#{{$corridor['newcolor']->hex}}; margin-right:60%;">{{$corridor['newcolor']->name}}</td>
                                @endif
                                <td>#####</td>
                                @if($corridor->old_status_paint == 1)
                                <td>{{__('نعم')}}</td>@else<td>{{__('لا')}}</td>
                                @endif
                                @if($corridor->old_status_paper)
                                <td>{{__('نعم')}}</td>@else<td>{{__('لا')}}</td>
                                @endif
                                @if($corridor->old_status_paste)
                                <td>{{__('نعم')}}</td>@else<td>{{__('لا')}}</td>
                                @endif
                                @if($corridor->old_status_plaster)
                                <td>{{__('نعم')}}</td>@else<td>{{__('لا')}}</td>
                                @endif
                                @if($corridor->new_status_paint)
                                <td>{{__('نعم')}}</td>@else<td>{{__('لا')}}</td>
                                @endif
                                @if($corridor->new_status_paper)
                                <td>{{__('نعم')}}</td>@else<td>{{__('لا')}}</td>
                                @endif
                                @if($corridor->peeling_wallpaper)
                                <td>{{__('نعم')}}</td>@else<td>{{__('لا')}}</td>
                                @endif
                                @if($corridor->new_status_paste)
                                <td>{{__('نعم')}}</td>@else<td>{{__('لا')}}</td>
                                @endif
                                <td>{{$corridor->num_paste}}</td>
                                @if($corridor->new_status_plaster)
                                <td>{{__('نعم')}}</td>@else<td>{{__('لا')}}</td>
                                @endif
                                <td>{{$corridor->number_holes}}</td>
                                <td>{{$corridor->number_incisions}}</td>

                                <td>{{$corridor->paper_type}}</td>
                                @if($corridor->corner_style)
                                <td>{{__('نعم')}}</td>@else<td>{{__('لا')}}</td>
                                @endif
                              </tr>
                          @endforeach
                          @foreach($room['stairs'] as $stair)
                              <tr>
                                  <td>{{__('الدرج')}}</td>
                                  <td>#####</td>
                                  <td>#####</td>
                                  <td>{{$stair->damage}}%</td>
                                  <td>{{$stair->height}}</td>
                                  <td><span class="badge bg-success" style="background-color:#{{$stair['newcolor']->hex}}; margin-right:60%;">{{$stair['oldcolor']->name}}</td>
                                  <td><span class="badge bg-success" style="background-color:#{{$stair['newcolor']->hex}}; margin-right:60%;">{{$stair['newcolor']->name}}</td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                              </tr>
                          @endforeach
                          <tr class="text-end">
                                  <td></td>
                                  <td class="text-start"></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                              </tr>
                      @endforeach
                  </tbody>
                </table>
              </div>
          </div>
        @endif 
            <!-- <div class="chat-body">
              <ul class="messages">
                <li class="message-item friend">
                  <img src="{{ url('https://via.placeholder.com/37x37') }}" class="img-xs rounded-circle" alt="avatar">
                  <div class="content">
                    <div class="message">
                      <div class="bubble">
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                      </div>
                      <span>8:12 PM</span>
                    </div>
                  </div>
                </li>
                <li class="message-item me">
                  <img src="{{ url('https://via.placeholder.com/37x37') }}" class="img-xs rounded-circle" alt="avatar">
                  <div class="content">
                    <div class="message">
                      <div class="bubble">
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry printing and typesetting industry.</p>
                      </div>
                    </div>
                    <div class="message">
                      <div class="bubble">
                        <p>Lorem Ipsum.</p>
                      </div>
                      <span>8:13 PM</span>
                    </div>
                  </div>
                </li>
                <li class="message-item friend">
                  <img src="{{ url('https://via.placeholder.com/37x37') }}" class="img-xs rounded-circle" alt="avatar">
                  <div class="content">
                    <div class="message">
                      <div class="bubble">
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                      </div>
                      <span>8:15 PM</span>
                    </div>
                  </div>
                </li>
                <li class="message-item me">
                  <img src="{{ url('https://via.placeholder.com/37x37') }}" class="img-xs rounded-circle" alt="avatar">
                  <div class="content">
                    <div class="message">
                      <div class="bubble">
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry printing and typesetting industry.</p>
                      </div>
                      <span>8:15 PM</span>
                    </div>
                  </div>
                </li>
                <li class="message-item friend">
                  <img src="{{ url('https://via.placeholder.com/37x37') }}" class="img-xs rounded-circle" alt="avatar">
                  <div class="content">
                    <div class="message">
                      <div class="bubble">
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                      </div>
                      <span>8:17 PM</span>
                    </div>
                  </div>
                </li>
                <li class="message-item me">
                  <img src="{{ url('https://via.placeholder.com/37x37') }}" class="img-xs rounded-circle" alt="avatar">
                  <div class="content">
                    <div class="message">
                      <div class="bubble">
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry printing and typesetting industry.</p>
                      </div>
                    </div>
                    <div class="message">
                      <div class="bubble">
                        <p>Lorem Ipsum.</p>
                      </div>
                      <span>8:18 PM</span>
                    </div>
                  </div>
                </li>
                <li class="message-item friend">
                  <img src="{{ url('https://via.placeholder.com/37x37') }}" class="img-xs rounded-circle" alt="avatar">
                  <div class="content">
                    <div class="message">
                      <div class="bubble">
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                      </div>
                      <span>8:22 PM</span>
                    </div>
                  </div>
                </li>
                <li class="message-item me">
                  <img src="{{ url('https://via.placeholder.com/37x37') }}" class="img-xs rounded-circle" alt="avatar">
                  <div class="content">
                    <div class="message">
                      <div class="bubble">
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry printing and typesetting industry.</p>
                      </div>
                      <span>8:30 PM</span>
                    </div>
                  </div>
                </li>
              </ul>
            </div> -->
        <!-- <div class="container-fluid mt-5 w-100">
          <div class="row">
            <div class="col-md-6 ms-auto">
                <div class="table-responsive">
                  <table class="table">
                      <tbody>
                        <tr>
                          <td>{{__('Total area')}}</td>
                          <td class="text-end">{{$all_details->space}}</td>
                        </tr>
                        <tr>
                          <td>{{__('Application ratio')}}</td>
                          <td class="text-end">@if($all_details->space > 0 && $all_details->space < 30 )30 $ 
                        @elseif($all_details->space >= 30 && $all_details->space < 60) 60 $
                        @elseif($all_details->space >= 60 && $all_details->space < 100) 80 $
                        @elseif($all_details->space >= 100 ) 100 $@endif
                        </td>
                        </tr>
                        <tr>
                          <td class="text-bold-800">Payment status</td>
                          <td class="text-bold-800 text-end"> $ 16,688.00</td>
                        </tr>
                        <tr>
                          <td>Payment Made</td>
                          <td class="text-danger text-end">(-) $ 4,688.00</td>
                        </tr>
                        <tr class="bg-light">
                          <td class="text-bold-800">Balance Due</td>
                          <td class="text-bold-800 text-end">$ 12,000.00</td>
                        </tr>
                      </tbody>
                  </table>
                </div>
            </div>
          </div>
        </div> -->
        <!-- <div class="container-fluid w-100">
          <a href="javascript:;" class="btn btn-primary float-end mt-4 ms-2"><i data-feather="send" class="me-3 icon-md"></i>Send Invoice</a>
          <a href="javascript:;" class="btn btn-outline-primary float-end mt-4"><i data-feather="printer" class="me-2 icon-md"></i>Print</a>
        </div> -->
      </div>
    </div>
  </div>
</div>
<div class="row chat-wrapper">
  <div class="col-md-12">
    <div class="card">
          <div class="col-lg-12 chat-content">
            <div  class="chat-body">
              <ul class="messages">
                @foreach($all_details['conversation']->chats as $chat)
                    @if($deal['provider']->id == $chat->sender_id)
                      <li class="message-item friend">
                        <img src="{{ url('https://via.placeholder.com/37x37') }}" class="img-xs rounded-circle" alt="avatar">
                        <div class="content">
                          <div class="message">
                            <div class="bubble">
                              <p>{{$chat->message}}</p>
                            </div>
                            <span>{{$chat->created_at}}</span>
                          </div>
                        </div>
                      </li>
                    @else
                    <li class="message-item me">
                      <img src="{{ url('https://via.placeholder.com/37x37') }}" class="img-xs rounded-circle" alt="avatar">
                      <div class="content">
                        <div class="message">
                          <div class="bubble">
                            <p>{{$chat->message}}.</p>
                          </div>
                        </div>
                        <div class="message">
                          <span>{{$chat->created_at}}</span>
                        </div>
                      </div>
                    </li>
                    @endif
                @endforeach
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@push('custom-scripts')
  <script src="{{ asset('assets/js/chat.js') }}"></script>
@endpush        
