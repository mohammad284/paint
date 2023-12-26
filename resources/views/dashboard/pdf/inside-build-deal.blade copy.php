<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File</title>
    
    
    <link href="styles.css" rel="stylesheet" type="text/css">
</head>
   
<body >
        <div style="border-radius: 30px;background-color: #AC79BC;height: 20px;width: 90%;margin-left: 5%;" class="edge topEdge"></div>
        <div style="border-radius: 30px;background-color: #AC79BC;height: 20rem;width: 20px;position: absolute;display: flex;right: 5%;top: 3rem;"  class="edge rightEdge"></div>
        <header style="width: 90%;margin-left: 10%;display: flex;justify-content: left;flex-direction: column;" class="header">
            <div style="width: fit-content;display: flex;align-items: center;flex-direction: column;">
                <img style="width: 200px;height: 200px;min-width: 150px;"  src="{{ asset('pdf_style/icons/logo.png') }}" alt="logo" class="logo">
                <img style="width: 300px;min-width: 200px;"  src="{{ asset('pdf_style/icons/name.svg') }}" alt="name" class="name">
            </div>
        </header>
        <div style="width: 80%;margin-left: 10%;margin-top: 1rem;padding: 1rem 2rem;background-color: var(--secound-color);border-radius: 1rem;" class="container info">
            <div style="gap: 1rem;flex-wrap: unset;" class="row">
                <div style="display: flex;flex-direction: column;" class="col inof-data main-font">
                    <h4 style="color: var(--text-color);">Omar Jamal</h4>
                    <span style="overflow-wrap: break-word;font-size: 18px;font-weight: 400;">omar.hatem.main@gmail.com</span>
                    <span style="overflow-wrap: break-word;font-size: 18px;font-weight: 400;">97513737</span>
                    <span style="overflow-wrap: break-word;font-size: 18px;font-weight: 400;">ytt</span>
                    <span style="overflow-wrap: break-word;font-size: 18px;font-weight: 400;">AG</span>
                </div>
                <div class="col inof-data main-font">
                    <h4>Ali Kaddour</h4>
                    <span>alikhaddour66@gmail.com</span>
                    <span>71727853</span>
                    <span>N/A</span>
                    <span>N/A</span>
                </div>
            </div>
        </div>  
        <div style="width: 85%;margin-left: 10%;padding: 2rem;font-size: 18px;font-weight: 400;" class="details main-font">
            <div  class="backgroundImg">
                <img height="100px" width="100px"  src="{{ asset('pdf_style/icons/bruch.svg') }}" alt="">
            </div>
            <div class="information">
                <div> <span>Title:</span><span>Lorem ipsum</span></div>
                <div> <span>Expected Date:</span><span>01-04-2023</span></div>
            </div><br>
            <div class="container offer">
                <div class="row offer-information">Offer details:</div>
                <div class="row">
                    <div class="col">Offer: 288.00</div>
                    <div class="col">Discount: 288.00</div>
                    <div class="col">Hour: 13:11:00</div>
                </div>
            </div><br>
            <div class="information information-3">
                <div><span>Address:</span><span>3058 Klein</span></div>
                <div><span>Type of Work:</span><span>Paint facade</span></div>
                <div><span>Renovation Services:</span><span>Prepare the ground</span></div>
                <div><span>Type of Building:</span><span>house old buildings</span></div>
                <div><span>Ground:</span><span>half-timbered</span></div>
                <div><span>Access:</span><span>Access difficult</span></div>
                <div><span>Building Location:</span><span>Adjoining house</span></div>
            </div><br>
            <div class="information messages main-font">
                <div><span>Messages:</span></div><br>
                <div class="message">
                    <div class="sender">2022-10-02 (alikhaddour) :hello</div>
                    <div class="receiver">2022-10-02 (Omarjamal) :hello</div>
                    <div class="sender">2022-10-02 (alikhaddour) :hello</div>
                    <div class="receiver">2022-10-02 (Omarjamal) :hello</div>
                    <div class="sender">2022-10-02 (alikhaddour) :hello</div>
                </div>
            </div>
        </div> 
</body>
</html>