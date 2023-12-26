
<!DOCTYPE html>
<html lang="en">

    <head>
        {{-- <meta charset="UTF-8"> --}}
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Datei</title>

        <!-- bootstarp -->
        <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->

        <!-- google fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lora:wght@500&display=swap" rel="stylesheet">

        <style>
            body { font-family: DejaVuSans, sans-serif; }
        </style>
        <script type="text/php">
            if ( isset($pdf) ) {
                $font = Font_Metrics::get_font("helvetica", "bold");
                $pdf->page_text(72, 18, "Header: {PAGE_NUM} of {PAGE_COUNT}", $font, 6, array(0,0,0));
            }
        </script> 
        <!-- <link rel="stylesheet" href="./public/css/style.css"> -->
    </head>

    <body>
        <!-- <div class="edge topEdge"></div> -->
        <!-- <div class="edge rightEdge"></div> -->
        <header style="border-width: 1rem 1rem 0 0; border-style: solid; border-color: #AC79BC; border-radius: 0 20px 0 0;"  class="header">
        <table>
                <tr>
                    <td>
                        <div style="width: 300px; height: 270px; margin-left: 3rem;">
                            <img style="width: 100px; height: 100px;" src="{{ asset('pdf_style/icons/logo.png') }}" alt="logo" class="logo">
                            <img style="width: 300px; height: 50px;" src="{{ asset('pdf_style/icons/name.svg') }}" alt="name" class="name">
                        </div>
                    </td>
                    <td>
                        <div style="padding-left: 1rem; width: 230px; height: 100px; background-color: #fbf9f9;  margin-left: 3rem; border-radius: 20px;">
                            <div><span  style="color: #602b70; display: inline-block; margin-top: 1.2rem; font-size: 12px;">Title:</span>        <span style="margin-left: 1rem;">Maler dienstleistung</span></div>
                            <div><span  style="color: #602b70; display: inline-block; margin-top: 1.2rem; font-size: 12px;">Date:</span>        <span style="margin-left: 1rem;">{{$now->format('d-m-Y')}}</span></div>

                        </div>
                    </td>
                </tr>
            </table>
        </header>
        <div style="display: inline-block;margin-top:10px; background-color: #dfc9e6; margin-left: 3rem;  padding: 1rem; border-radius: 30px;">
            <table style="width:100%">
                <tr>
                    <td style= "text-align: left;">
                        <div style="width: 49%; display: inline-block; margin-top : 5px;" class="inof-data main-font">
                            <h4 style="font-size: 16px; font-weight: bold;">{{$user->first_name}} {{$user->last_name}}</h4><br>
                            @if($interisted->status == 'deal')
                                <span style="font-size: 12px;">{{$user->email}}</span><br>
                                <span style="font-size: 12px;">{{$user->mobile}}</span>
                            @endif
                            
                        </div>
                    </td>
                    <td style= "text-align: right;" >
                        <div style="width: 49%; display: inline-block;margin-bottom : 5px;" class="inof-data main-font">
                            <h4 style="font-size: 16px; font-weight: bold;">{{$provider->first_name}} {{$provider->last_name}}</h4><br>
                            @if($interisted->status == 'deal')
                                <span style="margin-left: 4rem;  font-size: 12px;">{{$provider->email}}</span><br>
                                <span style="margin-left: 4rem;  font-size: 12px;">{{$provider->mobile}}</span><br>
                            @else
                            <span style="margin-left: 4rem;  font-size: 12px;">{{$provider->company_name}}</span><br>
                            <span style="margin-left: 4rem;  font-size: 12px;">{{$provider->Legal_form}}</span>
                            @endif                        
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div style="margin-left: 3rem; margin-top: 1rem;" class="details font-family">
            <!-- <div class="backgroundImg">
                <img src="./public/icons/bruch.svg" alt="">
            </div> -->
            <div class="font-family" style="margin-top: 1rem;">
                <div> <span  style="color: #602b70;font-weight: bold;">Title:</span>        <span style="margin-left: 1rem;">{{$tender->title}}</span></div>
                <div> <span  style="color: #602b70;font-weight: bold;margin-top: 8px;">Erwartetes Datum:</span><span style="margin-left: 1rem;">{{$tender->expected_date}}</span></div>
            </div>
            <div style="margin-top: 1rem;">
                <div style="color: #602b70;font-weight: bold;">Angebotsdetails:</div>
                <div style="display: inline;">
                    <span style="margin-left: 1.5rem;font-weight: bold;">Offer: {{$interisted->offer}}</span>
                    <span style="margin-left: 1.5rem;font-weight: bold;">Rabatt: {{$interisted->discount}}</span>
                    <span style="margin-left: 1.5rem;font-weight: bold;">Datum: {{$interisted->date}}</span>
                    <span style="margin-left: 1.5rem;font-weight: bold;">Stunde: {{$interisted->hour}}</span>
                </div>
            </div>
            <div style="margin-top: 1rem;">
                <div style="margin-top: 0.5rem;"><span style="color: #602b70;font-weight: bold;">Adresse:</span>            <span style="margin-left: 1rem;">  {{$tender['postal']->Postal_Code}} {{$tender['postal']->Admin_Name}}</span></div>
                <div style="margin-top: 0.5rem;"><span style="color: #602b70;font-weight: bold;">Type of Work:</span>       <span style="margin-left: 1rem;">  {{$tender['tender_type']->name}}</span></div>
                <div style="margin-top: 0.5rem;"><span style="color: #602b70;font-weight: bold;">Renovierungsdienste:       </span><span style="margin-left: 1rem;">  {{$tender['business_type']->name}}</span></div>
                <div style="margin-top: 0.5rem;"><span style="color: #602b70;font-weight: bold;">Stockwerk Nummer:</span>  <span style="margin-left: 1rem;">  {{$tender->num_floor}}</span></div>            
            </div><br>
            <div class="information messages font-family" style="margin-top: 1rem;margin-bottom: 4rem;">
                <div><span style="color: #602b70;font-weight: bold;">Mitteilungen:</span></div><br>
                <div>
                @if($conversation != null)
                    @foreach($conversation['chats'] as $chat)
                        @if($chat->sender_id == $user->id)
                        <p style="background-color: #d8bce1; border-radius: 30px;margin-bottom: 5px; padding: 0.3rem; padding-left: 1rem;page-break-inside: avoid;">{{$chat->created_at}} ({{$user->first_name}}) :{{$chat->message}}</p>
                        @else
                        <p style="background-color: #AC79BC; border-radius: 30px;margin-bottom: 5px; padding: 0.3rem; padding-left: 1rem;">{{$chat->created_at}} ({{$provider->first_name}}) :{{$chat->message}}</p>
                        @endif
                    @endforeach
                @endif
                </div>
            </div>
        </div>
    </body>
</html>