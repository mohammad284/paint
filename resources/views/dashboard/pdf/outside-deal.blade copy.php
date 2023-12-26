<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>malar</title>
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
                                <strong>Date: {{$date}}</strong>
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
                                    </address>
                                </div>
                            </td>
                            <td>
                                <div class="">
                                <strong>{{__('TENDER DETAILS')}}:</strong><br>
                                    <address>
                                        @if($tender->inside == 3)
                                        <strong>{{__('out buildings')}}</strong><br>@endif
                                        @if($tender->category != null && $tender->category != 0)
                                        <strong>{{$tender->category}}</strong><br>@endif
                                        {{__('service')}}: {{$tender['service']->translate('en')->name}}<br>
                                        @if($tender->building_type != null)
                                        {{__('building type')}}: {{$tender['building']->translate('en')->name}}<br>@endif
                                        @if($tender->floar_type != null)
                                        {{__('floar type')}}: {{$tender['floar']->translate('en')->name}}<br>@endif
                                        {{__('old color')}}: {{$tender->old_color}}<br>
                                        {{__('new color')}}: {{$tender['newcolor']->name}}<br>
                                        {{__('house access')}}: @if($tender->house_access == 1) {{__('Access possible')}}@elseif($tender->house_access == 2){{__('Access difficult')}}@else{{__('No information')}}@endif<br>
                                        {{__('status building')}}: @if($tender->status_building == 1){{__('Detached')}}@elseif($tender->status_building == 2){{__('Adjoining house')}}@elseif($tender->status_building == 3){{__('adjacent hedge/bush')}}@else{{__('Non of all')}} @endif<br>
                                        {{__('add surface')}}: @if($tender->add_surface == 1){{__('window')}}@elseif($tender->add_surface == 2){{__('doors')}}@elseif($tender->add_surface == 3){{__('gable')}}@elseif($tender->add_surface == 4){{__('roof boxes')}}@else{{__('none')}}@endif<br>
                                        {{__('scaffolding')}}: @if($tender->scaffolding == 0){{__('No')}}@else{{__('Yes')}}@endif <br>
                                        {{__('plaster')}}: @if($tender->plaster == 1) {{__('Grooved plaster')}} @elseif($tender->plaster == 2){{__('Felt plaster')}}@elseif($tender->plaster == 3){{__('Scratch plaster')}}@elseif($tender->plaster == 4){{__('Decorative plaster')}} @elseif($tender->plaster == 5){{__('Window cleaning')}}@elseif($tender->plaster == 6){{__('Roughcast')}}@else{{__('No information')}}@endif<br>@endif
                                        @if($tender->num_floor != 0 && $tender->num_floor != null)
                                        {{__('house floor number')}} : {{$tender->num_floor}}@endif
                                        @if($tender->inside == 3)
                                        @foreach($tender['building_floors'] as $floor)
                                        {{__('out area')}} : {{$floor->out_area}} {{$floor->unit}}
                                        @endforeach
                                        @endif
                                    </address>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <br>@if($tender->inside == 3)
            <div class="row">
                <div class="col-md-12 table-responsive">
                    <table class="table table-condensed table-hover">
                        <thead>
                            <tr>
                            <th>{{__('num_of_rooms')}}</th>
                            <th>{{__('color')}}</th>
                            <th>{{__('num_of_walls')}}</th>
                            <th>{{__('num_of_roofs')}}</th>
                            <th>{{__('num_of_baths')}}</th>
                            <th>{{__('num_of_corridor')}}</th>
                            <th>{{__('num_of_stairs')}}</th>
                            <th>{{__('num_of_kitchen')}}</th>
                            <th>{{__('num_of_doors')}}</th>
                            <th>{{__('num_of_windows')}}</th>
                            <th>{{__('new_status_paint')}}</th>
                            <th>{{__('new_status_paste')}}</th>
                            <th>{{__('new_status_base')}}</th>
                            <th>{{__('shave')}}</th>
                            <th>{{__('area')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tender['building_floors'] as $floor)
                                <tr>
                                <td>{{$floor->num_of_rooms}}</td>
                                <td>{{$floor->color}}</td>
                                <td>{{$floor->num_of_walls}}</td>
                                <td>{{$floor->num_of_roofs}}</td>
                                <td>{{$floor->num_of_baths}}</td>
                                <td>{{$floor->num_of_corridor}}</td>
                                <td>{{$floor->num_of_stairs}}</td>
                                <td>{{$floor->num_of_kitchen}}</td>
                                <td>{{$floor->num_of_doors}}</td>
                                <td>{{$floor->num_of_windows}}</td>
                                <td>{{$floor->new_status_paint}}</td>
                                <td>{{$floor->new_status_paste}}</td>
                                <td>{{$floor->new_status_base}}</td>
                                <td>{{$floor->shave}}</td>
                                <td>{{$floor->area}}</td>

                                </tr>
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
            </div>@endif
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
            <br><br><br>
            <div>
                <small><small>{{__('NOTE: This report was sent by malar')}}</small></small>
            </div>
        </div>
    </div>    
</body>
</html>