<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Some Random Title</title>
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
                                From : {{$from}}
                                    <address>
                                        <strong>{{$provider->first_name}}</strong><br>
                                        Email: {{$provider->email}}<br>
                                        interested: {{$interests}} 
                                    </address>
                                </div>
                            </td>
                            <td>
                                <div class="">
                                    To: {{$to}}
                                    <address>
                                        <strong>company name:</strong>{{$provider->company_name}}<br>
                                        Phone: {{$provider->mobile}} <br>
                                        connected: {{$connectes}} 
                                    </address>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <br><br>
            <div class="row">
                <div class="col-md-12 table-responsive">
                    <table class="table table-condensed table-hover">
                        <thead>
                            <tr>
                                <th>date</th>
                                <th>title</th>
                                <th>space</th>
                                <th>height</th>
                                <th>price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($deals as $deal)
                                <tr>
                                    <td>{{$deal['tender']->created_at}}</td>
                                    <td>{{$deal['tender']->title}}</td>
                                    <td>{{$deal['tender']->space}}</td>
                                    <td>{{$deal['tender']->height}}</td>
                                    <td class="text-right">&#8377; {{$deal['tender']->price}}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="3" class="text-right">Sub Total</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-right">TAX </td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-right">Total Payable</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <br><br><br>
            <div>
                <small><small>NOTE: This is system generate invoice no need of signature</small></small>
            </div>
        </div>
    </div>    
</body>
</html>