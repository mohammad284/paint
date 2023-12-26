<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <!-- Custom Style -->
    <link rel="stylesheet" href="style.css">

    <title>Invoice..!</title>
</head>
<style>
    :root {
        --body-bg: rgb(204, 204, 204);
        --white: #ffffff;
        --darkWhite: #ccc;
        --black: #000000;
        --dark: #615c60;
        --themeColor: #7a0099;
        --pageShadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);
    }

    /* Font Include */
    @import url('https://fonts.googleapis.com/css2?family=Rajdhani:wght@600&display=swap');

    body {
        background-color: var(--body-bg);
    }

    .page {
        background: var(--white);
        display: block;
        margin: 0 auto;
        position: relative;
        box-shadow: var(--pageShadow);
    }

    .page[size="A4"] {
        width: 21cm;
        height: 29.7cm;
        overflow: hidden;
    }

    .bb {
        border-bottom: 3px solid var(--darkWhite);
    }

    /* Top Section */
    .top-content {
        padding-bottom: 15px;
    }

    .logo img {
        height: 60px;
    }

    .top-left p {
        margin: 0;
    }

    .top-left .graphic-path {
        height: 40px;
        position: relative;
    }

    .top-left .graphic-path::before {
        content: "";
        height: 20px;
        background-color: var(--dark);
        position: absolute;
        left: 15px;
        right: 0;
        top: -15px;
        z-index: 2;
    }

    .top-left .graphic-path::after {
        content: "";
        height: 22px;
        width: 17px;
        background: var(--black);
        position: absolute;
        top: -13px;
        left: 6px;
        transform: rotate(45deg);
    }

    .top-left .graphic-path p {
        color: var(--white);
        height: 40px;
        left: 0;
        right: -100px;
        text-transform: uppercase;
        background-color: var(--themeColor);
        font: 26px;
        z-index: 3;
        position: absolute;
        padding-left: 10px;
    }

    /* User Store Section */
    .store-user {
        padding-bottom: 25px;
    }

    .store-user p {
        margin: 0;
        font-weight: 600;
    }

    .store-user .address {
        font-weight: 400;
    }

    .store-user h3 {
        color: var(--themeColor);
        font-family: 'Rajdhani', sans-serif;
    }

    .extra-info p span {
        font-weight: 400;
    }

    /* Product Section */
    thead {
        color: var(--white);
        background: var(--themeColor);
    }

    .table td,
    .table th {
        text-align: center;
        vertical-align: middle;
    }

    tr th:first-child,
    tr td:first-child {
        text-align: left;
    }

    .media img {
        height: 60px;
        width: 60px;
    }

    .media p {
        font-weight: 400;
        margin: 0;
    }

    .media p.title {
        font-weight: 600;
    }

    /* Balance Info Section */
    .balance-info .table td,
    .balance-info .table th {
        padding: 0;
        border: 0;
    }

    .balance-info tr td:first-child {
        font-weight: 600;
    }

    tfoot {
        border-top: 2px solid var(--darkWhite);
    }

    tfoot td {
        font-weight: 600;
    }

    /* Cart BG */
    .cart-bg {
        height: 250px;
        bottom: 32px;
        left: -40px;
        opacity: 0.3;
        position: absolute;
    }

    /* Footer Section */
    footer {
        text-align: center;
        position: absolute;
        bottom: 30px;
        left: 75px;
    }

    footer hr {
        margin-bottom: -22px;
        border-top: 3px solid var(--darkWhite);
    }

    footer a {
        color: var(--themeColor);
    }

    footer p {
        padding: 6px;
        border: 3px solid var(--darkWhite);
        background-color: var(--white);
        display: inline-block;
    }


</style>
<body>
    <div class="my-5 page" size="A4">
        <div class="p-5">
            <section class="top-content bb d-flex justify-content-between">
                <div class="logo">
                    <img src="logo.png" alt="" class="img-fluid">
                </div>
                <div class="top-left">
                    <div class="graphic-path">
                        <p>Malar</p>
                    </div>
                    <div class="position-relative">
                        <p>Invoice No. <span>XXXX</span></p>
                    </div>
                </div>
                
            </section>
            <section class="store-user mt-5">
                <div class="col-10">
                    <div class="row bb pb-3">
                        <div class="col-7">
                            <p>user :</p>
                            <h3>{{$user->first_name}} {{$user->last_name}},</h3>
                            <p class="address"> {{$user->email}}, <br> oman, 
                            <br>postal_code: {{$user['postal']->Postal_Code}}  ,<br>street_num: {{$user->street_num}} ,<br>home_num: {{$user->home_num}}</p>
                            <div class="txn mt-2">phone: {{$user->mobile}}</div>
                        </div>
                        <div class="col-5">
                            <p>provider :</p>
                            <h3>{{$provider->first_name}} {{$provider->last_name}}</h3>
                            <p class="address"> {{$provider->email}} , <br> oman, 
                            <br>postal_code: {{$provider['postal']->Postal_Code}}  ,<br>company_name: {{$provider->company_name}} ,<br>Legal_form: {{$provider->Legal_form}} </p>
                            <div class="txn mt-2">phone: {{$provider->mobile}}</div>
                        </div>
                    </div>
                    <div class="row bb pb-3">
                        <div class="col-12"><br></div>
                        <div class="col-11">
                            <h4>main tender details</h4>
                        </div>
                        <div class="col-8">
                            <h6>title: {{$tender->title}}</h6>
                        </div>
                         @if($tender->space)
                        <div class="col-6">
                            <p>Space: <span>{{$tender->space}}</span></p>
                        </div>@endif
                        @if($tender->height)
                        <div class="col-6">
                            <p>Height: <span>{{$tender->height}}</span></p>
                        </div>@endif
                        <div class="col-6">
                            <p>Expected Date: <span>{{$tender->expected_date}}</span></p>
                        </div>
                        @if($tender->note)
                        <div class="col-6">
                            <p>note: <span>{{$tender->note}}</span></p>
                        </div>@endif
                        @if($tender->furnished)
                        <div class="col-6">
                            <p>furnished: <span>{{$tender->furnished}}</span></p>
                        </div>@endif
                        @if($tender->house_type)
                        <div class="col-6">
                            <p>house_type: <span>{{$tender->house_type}}</span></p>
                        </div>@endif
                        @if($tender->num_floor)
                        <div class="col-6">
                            <p>num_floor: <span>{{$tender->num_floor}}</span></p>
                        </div>@endif
                        @if($tender->num_floor)
                        <div class="col-6">
                            <p>num_floor: <span>{{$tender->num_floor}}</span></p>
                        </div>@endif
                    </div>
                    <div class="row bb pb-3">
                    <div class="col-12"><br></div>
                        <div class="col-11">
                            <h4>offer details</h4>
                        </div>
                        <div class="col-8">
                            <h6>offer: {{$interisted->offer}} </h6>
                        </div>
                        <div class="col-6">
                            <p>date: <span>{{$interisted->date}}</span></p>
                        </div>
                        <div class="col-6">
                            <p>hour: <span>{{$interisted->hour}}</span></p>
                        </div>
                        <div class="col-12"><br></div>
                        <div class="col-6">
                            <p>discount: <span>{{$interisted->discount}}</span></p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="balance-info">
                <div class="row">
                    <div class="col-8">
                        <p class="m-0 font-weight-bold"> chat: </p>
                        <p style="font-weight: 600;">mohammad : <span style="font-weight: 200;">hi</span> </p>
                        <p style="font-weight: 600;">mohammad : <span style="font-weight: 200;">hi</span> </p>
                    </div>
                </div>
            </section>


            <footer>
                <hr>
                <p class="m-0 text-center">
                    View THis Invoice Online At - <a href="#!"> invoice/saburbd.com/#868 </a>
                </p>
                <div class="social pt-3">
                    <span class="pr-2">
                        <i class="fas fa-mobile-alt"></i>
                        <span>0123456789</span>
                    </span>
                    <span class="pr-2">
                        <i class="fas fa-envelope"></i>
                        <span>me@saburali.com</span>
                    </span>
                    <span class="pr-2">
                        <i class="fab fa-facebook-f"></i>
                        <span>/sabur.7264</span>
                    </span>
                    <span class="pr-2">
                        <i class="fab fa-youtube"></i>
                        <span>/abdussabur</span>
                    </span>
                    <span class="pr-2">
                        <i class="fab fa-github"></i>
                        <span>/example</span>
                    </span>
                </div>
            </footer>
        </div>
    </div>


</body></html>