<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Malar</title>
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
                                        {{__('postal_code')}}: {{$user['postal']->Postal_Code}} <br>
                                        {{__('Place_Name')}}: {{$user['postal']->Place_Name}} <br>
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
                                        {{__('postal_code')}}: {{$provider['postal']->Postal_Code}} <br>
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
                                        @if($tender->space)
                                        {{__('space')}}: {{$tender->space}} <br>@endif
                                        @if($tender->height)
                                        {{__('height')}}: {{$tender->height}}<br>@endif
                                        {{__('expected date')}}: {{$tender->expected_date}}<br>
                                        {{__('offer')}}: {{$interisted->offer}}<br>
                                        {{__('discount')}}: {{$interisted->discount}}<br>
                                        {{__('date')}}: {{$interisted->date}}<br>
                                        {{__('hour')}}: {{$interisted->hour}}<br>
                                        <br><br>
                                    </address>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div>
                <p>{{$data_en}}</p>
                <p>{{$data_gr}}</p>
                <p>{{$date}} --- {{$hour}}</p>
            </div>
            <div>
                <small><small>{{__('NOTE: This report was sent by malar')}}</small></small>
            </div>
        </div>
    </div>    
</body>
</html>