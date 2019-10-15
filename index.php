<!-- PARTICLES.js -->

<link rel="stylesheet" media="screen" href="particles/style.css">

<!-- particles.js container -->
<div id="particles-js"></div>

<!-- scripts -->
<script src="particles/particles.js"></script>
<script src="particles/app.js"></script>

<!-- HEADER -->



<?php

 $_SESSION["title"] = "HySky | Welcome!";

 require_once("includes/header.php");

 ?>



<!-- CONTENT -->


    <div class="bg-photo">
        <div class="container py-5">
            <div class='row'>
                <div class="col-12 text-center mb-5 text-light">
                    <h1 class="textshadow">Your #1 and Only Skyblock Website!</h1>
                </div>
            </div>
            <div style="margin-bottom: 30px;" class="row">
                <div class="col-12 col-lg-4 mb-4 mb-lg-0">  
                    <div>
                        <a href="/auctions" class="landing-link d-flex textshadow"><div class="d-flex justify-content-center align-items-center " style="background: rgba(0,0,0,0.4);width: 100%;height: 100%; border-radius: 20px; font-size: 20px;">Web Auction House</div></a>
                    </div>
                </div>
                <div class="col-12 col-lg-4 mb-4 mb-lg-0">  
                    <div>
                        <a href="#" class="landing-link d-flex textshadow"><div class="d-flex justify-content-center align-items-center " style="background: rgba(0,0,0,0.4);width: 100%;height: 100%; border-radius: 20px; font-size: 20px;">Calculators!</div></a>
                    </div>
                </div>
                <div class="col-12 col-lg-4 mb-4 mb-lg-0">  
                    <div>
                        <a href="/info" class="landing-link d-flex textshadow"><div class="d-flex justify-content-center align-items-center " style="background: rgba(0,0,0,0.4);width: 100%;height: 100%; border-radius: 20px; font-size: 20px;">News & Info</div></a>
                    </div>
                </div>

            </div>

            <div class="row">

                <div class="col-12 col-lg-4 mb-4 mb-lg-0">  
                    <div>
                        <a href="#" class="landing-link d-flex textshadow"><div class="d-flex justify-content-center align-items-center " style="background: rgba(0,0,0,0.4);width: 100%;height: 100%; border-radius: 20px; font-size: 20px;">Find a Coop</div></a>
                    </div>
                </div>
                <div class="col-12 col-lg-4 mb-4 mb-lg-0">  
                    <div>
                        <a href="#" class="landing-link d-flex textshadow"><div class="d-flex justify-content-center align-items-center " style="background: rgba(0,0,0,0.4);width: 100%;height: 100%; border-radius: 20px; font-size: 20px;">Find a Dragon Party</div></a>
                    </div>
                </div>
                <div class="col-12 col-lg-4 mb-4 mb-lg-0">  
                    <div>
                        <a href="https://www.paypal.me/hysky" class="landing-link d-flex textshadow"><div class="d-flex justify-content-center align-items-center " style="background: rgba(0,0,0,0.4);width: 100%;height: 100%; border-radius: 20px; font-size: 20px;">Support Us <3 </div></a>
                    </div>
                </div>
            </div>
        </div>
    </div>



<!-- FOOTER -->



<?php

require_once("includes/footer.php");

?>

