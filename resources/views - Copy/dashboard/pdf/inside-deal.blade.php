<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- <title>Some Random Title</title> -->
    <style>
        body{
            font-family: "Courier New", Courier, "Lucida Sans Typewriter", "Lucida Typewriter", monospace !important;
            letter-spacing: -0.3px;
        }
        .invoice-wrapper{ width: 700px; margin: auto; }
        .nav-sidebar .nav-header:not(:first-of-type){ padding: 1.7rem 0rem .5rem; }
        .logo{ font-size: 50px; }
        .sidebar-collapse .brand-link .brand-image{ margin-top: -33px; }
        .content-wrapper{ margin: auto !important; }
        .billing-company-image { width: 50px; }
        .billing_name { text-transform: uppercase; }
        .billing_address { text-transform: capitalize; }
        .table{ width: 100%; border-collapse: collapse; }
        th{ text-align: left; padding: 10px; }
        td{ padding: 10px; vertical-align: top; }
        .row{ display: block; clear: both; }
        .text-right{ text-align: right; }
        .table-hover thead tr{ background: #eee; }
        .table-hover tbody tr:nth-child(even){ background: #fbf9f9; }
        address{ font-style: normal; }
    </style>
</head>
<body>
    <div class="row invoice-wrapper">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <table class="table">
                        <tr>
                            <td>
                                <h4>
                                    <span class="">Malar</span>
                                </h4>
                            </td>
                            <td class="text-right">
                                <strong>{{__('Date')}}: {{$date}}</strong>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <br><br>
            <div class="row invoice-info">
                <div class="col-md-12">
                    <table class="table">
                        <tr>
                            <td>
                                <div class="">
                                <strong>{{__('user name')}}:</strong>{{$user->first_name}} {{$user->last_name}}<br>
                                    <address>
                                        {{__('Email')}}: {{$user->email}}<br>
                                        {{__('mobile')}}: {{$user->mobile}} <br>
                                        {{__('address')}}: {{$user->address}} <br>
                                        {{__('street_num')}}: {{$user->street_num}} <br>
                                        {{__('home_num')}}: {{$user->home_num}} <br>

                                    </address>
                                </div>
                            </td>
                            <td>
                                <div class="">
                                <strong>{{__('provider name')}}:</strong>{{$provider->first_name}} {{$provider->last_name}}<br>
                                    <address>
                                        {{__('Email')}}: {{$provider->email}}<br>
                                        {{__('mobile')}}: {{$provider->mobile}} <br>
                                        {{__('address')}}: {{$provider->address}} <br>
                                        {{__('address')}}: {{$provider->address}} <br>
                                        {{__('company_name')}}: {{$provider->company_name}} <br>
                                        {{__('Legal_form')}}: {{$provider->Legal_form}} <br>
                                    </address>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <br><br>
            <div class="row invoice-info">
                <div class="col-md-12">
                    <table class="table">
                        <tr>
                            <td>
                                <div class="">
                                <strong>{{__('MAIN TENDER DETAILS')}}:</strong><br>
                                    <address>
                                        {{__('title')}}: {{$tender->title}}<br>
                                        {{__('note')}}: {{$tender->note}}<br>
                                        {{__('space')}}: {{$tender->space}} {{$tender->space_unit}}<br>
                                        {{__('height')}}: {{$tender->height}} {{$tender->hight_unit}}<br>
                                        {{__('expected date')}}: {{$tender->expected_date}}<br>
                                        {{__('furnished')}}:@if($tender->furnished == 0) {{__('unfurnished')}}@else{{__('furnished')}}@endif<br>
                                        {{__('house_type')}}:@if($tender->house_type == 1) {{__('home')}}@elseif($tender->house_type == 2){{__('Hall')}}
                                        @elseif($tender->house_type == 3){{__('warehouse')}}@elseif($tender->house_type == 4){{__('Cellar')}}
                                        @endif<br><br>
                                        <br>
                                    </address>
                                </div>
                            </td>
                            <td>
                                <div class="">
                                <strong>{{__('MAIN TENDER DETAILS')}}:</strong><br>
                                    <address>

                                        <strong>{{__('Inside Details')}}</strong><br> 
                                        {{__('number of room')}}: {{$num_rooms}}<br>
                                        {{__('number of walls')}}: {{$num_walls}}<br>
                                        {{__('number of windows')}}: {{$num_windows}}<br>
                                        {{__('number of roofs')}}: {{$num_roofs}}<br>
                                        {{__('number of doors')}}: {{$num_doors}}<br>
                                        {{__('number of corridors')}}: {{$num_corridors}}<br>
                                        {{__('number of stairs')}}: {{$num_stairs}}<br>
                                    </address>
                                </div>
                            </td>

                        </tr>
                    </table>
                </div>
            </div>

            <br>
            <div class="row">
                <div class="col-md-12 table-responsive">
                    <table class="table table-condensed table-hover">
                        <thead>
                            <tr>
                            <th>{{__('name')}}</th>
                            <th>{{__('old_status')}}</th>
                            <th>{{__('new_status')}}</th>
                            <th>{{__('damage')}}</th>
                            <th>{{__('area/height')}}</th>
                            <th>{{__('old color')}}</th>
                            <th>{{__('new color')}}</th>
                            <th>{{__('glossy')}}</th>
                            <th>{{__('old_status_paint')}}</th>
                            <th>{{__('old_status_paper')}}</th>
                            <th>{{__('old_status_paste')}}</th>
                            <th>{{__('old_status_plaster')}}</th>
                            <th>{{__('new_status_paint')}}</th>
                            <th>{{__('new_status_paper')}}</th>
                            <th>{{__('peeling_wallpaper')}}</th>
                            <th>{{__('new_status_paste')}}</th>
                            <th>{{__('num_paste')}}</th>
                            <th>{{__('new_status_plaster')}}</th>
                            <th>{{__('number_holes')}}</th>
                            <th>{{__('number_incisions')}}</th>
                            <th>{{__('paper type')}}</th>
                            <th>{{__('corner_style')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($rooms_det as $room)
                            @foreach($room['walls'] as $wall)
                                <tr>
                                <td>{{__('wall')}}</td>
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
                                <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td>
                                @endif
                                @if($wall->old_status_paper)
                                <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td>
                                @endif
                                @if($wall->old_status_paste)
                                <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td>
                                @endif
                                @if($wall->old_status_plaster)
                                <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td>
                                @endif
                                @if($wall->new_status_paint)
                                <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td>
                                @endif
                                @if($wall->new_status_paper)
                                <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td>
                                @endif
                                @if($wall->peeling_wallpaper)
                                <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td>
                                @endif
                                @if($wall->new_status_paste)
                                <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td>
                                @endif
                                <td>{{$wall->num_paste}}</td>
                                @if($wall->new_status_plaster)
                                <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td>
                                @endif
                                <td>{{$wall->number_holes}}</td>
                                <td>{{$wall->number_incisions}}</td>

                                <td>{{$wall->paper_type}}</td>
                                @if($wall->corner_style)
                                <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td>
                                @endif

                                </tr>
                            @endforeach
                            @foreach($room['windows'] as $window)
                                <tr>
                                    < <td>{{__('window')}}</td>
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
                                    @if($window->glossy == 0) <td>{{__('no glossy')}} </td> @endif
                                    @if($window->glossy == 1) <td> {{__('window')}}</td> @endif
                                    @if($window->glossy == 2) <td>{{__('frame')}} </td> @endif
                                    @if($window->glossy == 3) <td> {{__('both')}} </td> @endif
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
                                <tr>
                                <td>{{__('roof')}}</td>
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
                                <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td>
                                @endif
                                @if($roof->old_status_paper)
                                <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td>
                                @endif
                                @if($roof->old_status_paste)
                                <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td>
                                @endif
                                @if($roof->old_status_plaster)
                                <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td>
                                @endif
                                @if($roof->new_status_paint)
                                <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td>
                                @endif
                                @if($roof->new_status_paper)
                                <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td>
                                @endif
                                @if($roof->peeling_wallpaper)
                                <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td>
                                @endif
                                @if($roof->new_status_paste)
                                <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td>
                                @endif
                                <td>{{$roof->num_paste}}</td>
                                @if($roof->new_status_plaster)
                                <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td>
                                @endif
                                <td>{{$roof->number_holes}}</td>
                                <td>{{$roof->number_incisions}}</td>

                                <td>{{$roof->paper_type}}</td>
                                @if($roof->corner_style)
                                <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td>
                                @endif

                                </tr>
                            @endforeach
                            @foreach($room['doors'] as $door)
                                <tr>
                                <td>{{__('door')}}</td>
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
                                @if($door->glossy == 0) <td>{{__('no glossy')}} </td> @endif
                                @if($door->glossy == 1) <td> {{__('door')}}</td> @endif
                                @if($door->glossy == 2) <td>{{__('frame')}} </td> @endif
                                @if($door->glossy == 3) <td> {{__('both')}} </td> @endif
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
                                <tr>
                                <td>{{__('edge')}}</td>
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
                                <tr>
                                <td>{{__('corridor')}}</td>
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
                                <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td>
                                @endif
                                @if($corridor->old_status_paper)
                                <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td>
                                @endif
                                @if($corridor->old_status_paste)
                                <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td>
                                @endif
                                @if($corridor->old_status_plaster)
                                <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td>
                                @endif
                                @if($corridor->new_status_paint)
                                <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td>
                                @endif
                                @if($corridor->new_status_paper)
                                <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td>
                                @endif
                                @if($corridor->peeling_wallpaper)
                                <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td>
                                @endif
                                @if($corridor->new_status_paste)
                                <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td>
                                @endif
                                <td>{{$corridor->num_paste}}</td>
                                @if($corridor->new_status_plaster)
                                <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td>
                                @endif
                                <td>{{$corridor->number_holes}}</td>
                                <td>{{$corridor->number_incisions}}</td>

                                <td>{{$corridor->paper_type}}</td>
                                @if($corridor->corner_style)
                                <td>{{__('yes')}}</td>@else<td>{{__('no')}}</td>
                                @endif
                                </tr>
                            @endforeach
                            @foreach($room['stairs'] as $stair)
                                <tr>
                                    <td>{{__('stair')}}</td>
                                    <td>{{$stair->old_status}}</td>
                                    <td>{{$stair->new_status}}</td>
                                    <td>{{$stair->damage}}%</td>
                                    <td>{{$stair->height}}</td>
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
                        @endforeach
                            <!-- <tr>
                                <td colspan="3" class="text-right">{{__('Sub Total')}}</td>
                                <td class="text-right"><strong>&#8377; {{$sub_total}}</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-right">{{__('TAX')}} </td>
                                <td class="text-right"><strong>&#8377; {{$tax}}</strong></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-right">{{__('Total Payable')}}</td>
                                <td class="text-right"><strong>&#8377; {{$total}}</strong></td>
                            </tr> -->
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <br><br><br>
            <h3>chats</h3>
            <div>
                @foreach($conversation['chats'] as $chat)
                @if($user->id == $chat->sender_id)
                {{$user->first_name}}    :{{$chat->message}}<br>
                @else
                {{$provider->first_name}}    :{{$chat->message}}<br>
                @endif
                @endforeach
            </div>
            <div>
                <small><small>{{__('NOTE: This report was sent by malar')}}</small></small>
            </div>
        </div>
    </div>    
</body>
</html>