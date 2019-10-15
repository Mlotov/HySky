<!-- HEADER -->

<?php
//Always include the file which contains the Caching class
// include 'cache/mainclass.php';

// //Initiating the Caching Class, must be at the top of the code with the ob_start()
// $cache = new Caching;
// ob_start();

function format_interval(DateInterval $interval) {
    $result = "";
    if ($interval->y) { $result .= $interval->format("%y years "); }
    if ($interval->m) { $result .= $interval->format("%m months "); }
    if ($interval->d) { $result .= $interval->format("%d days "); }
    if ($interval->h) { $result .= $interval->format("%h hours "); }
    if ($interval->i) { $result .= $interval->format("%i minutes "); }
    if ($interval->s) { $result .= $interval->format("%s seconds "); }

    return $result;
}

function pagination($pagenoo, $numofpagess){
    echo "<ul class='pagination justify-content-center'>";
        for($u = 1; $u <= $numofpagess; $u++){
            if($u == $pagenoo){
                echo "<li class='page-item active'><a class='page-link' href='/auctions?pageno=" . $u . "'>" . $u ."</a></li>"; 
            }
            else{
                echo "<li class='page-item'><a class='page-link' href='/auctions?pageno=" . $u . "'>" . $u ."</a></li>";
            }
        }
    echo "</ul>";
}

 $_SESSION["title"] = "HySky | Auction House";
 require_once("includes/header.php");
 ?>

<!-- CONTENT -->

<link rel="stylesheet" href="styles/auctions.css">

    <div class="bg-light">
        <div class="container">

        <h3 class="py-5">Auction House:</h3>
        <?php
            
            $key = "09828659-42c5-4360-9203-d93bcb5df79d";
            $link = "https://api.hypixel.net/skyblock/auctions?key=" . $key; 
            $json = file_get_contents($link);
            $auctions = json_decode($json, true);
            $total_auctions = $auctions["totalAuctions"];
            $auctions_real_pages = $auctions["totalPages"];

            // var_dump($auctions["auctions"][0]);
            $_SESSION["top_bids"] = array();
            $highest = 0;

            // GETTING ALL THE AUCTIONS TOP BIDS FOR THE HOMEPAGE
            if(sizeof($_SESSION["top_bids"]) == 0){

            for($i = 0; $i < $auctions_real_pages; $i++){
                // echo $auctions_real_pages . "<br>";
                $auclink = "https://api.hypixel.net/skyblock/auctions?key=" . $key . "&page=" . $i;
                $aucjson = file_get_contents($auclink);
                $pageaucs = json_decode($aucjson, true);
                
                // echo $i . "<br>";

                for($v = 0; $v < 1000; $v++){
                        if($pageaucs["auctions"][$v]["highest_bid_amount"] > 999999 || $pageaucs["auctions"][$v]["starting_bid"] > 999999){
                                if($pageaucs["auctions"][$v]["starting_bid"] >= $pageaucs["auctions"][$v]["highest_bid_amount"]){
                                    $highest = $pageaucs["auctions"][$v]["starting_bid"];
                                }
                                else{
                                    $highest = $pageaucs["auctions"][$v]["highest_bid_amount"];
                                }
                            
                            $bid_details = array(
                                "item_name" => $pageaucs["auctions"][$v]["item_name"],
                                "starting_bid" => $pageaucs["auctions"][$v]["starting_bid"],
                                "highest_bid_amount" => $pageaucs["auctions"][$v]["highest_bid_amount"],
                                "category" => $pageaucs["auctions"][$v]["category"],
                                "bids" => $pageaucs["auctions"][$v]["bids"],
                                "tier" => $pageaucs["auctions"][$v]["tier"],
                                "start" => $pageaucs["auctions"][$v]["start"],
                                "end" => $pageaucs["auctions"][$v]["end"],
                                "highest" => $highest
                            );
                            array_push($_SESSION["top_bids"], $bid_details);
                            
                    }
                }
            }
        }

            sleep(1);

            $n = sizeof($_SESSION["top_bids"]);
                while ($n >= 10) {
                    $n = $n /= 10; 
                }
                
                if (isset($_GET['pageno'])) {
                    $pageno = $_GET['pageno'];
                } else {
                    $pageno = 1;
                }

                $numofpages = $n + 6;
                $aucperpage = round(sizeof($_SESSION["top_bids"]) / $numofpages);
                $startid = ($pageno - 1) * $aucperpage;
                $endid = $startid + $aucperpage;

            if(array_multisort(array_column($_SESSION["top_bids"], 'highest'), SORT_DESC, $_SESSION["top_bids"])){

                // echo "<hr>" . $aucperpage . "<hr>";

                echo "<p>DONE. Total Auctions: " . $total_auctions . "</p><br>";
                echo "<p>Total  Shown Auctions This Page (Above 1 Mil): " . $aucperpage . "</p><br>";
                
                pagination($pageno, $numofpages);
                
                for($i = $startid; $i < $endid; $i++){
                    $item = $_SESSION["top_bids"][$i]["item_name"];
                    $s_bid = $_SESSION["top_bids"][$i]["starting_bid"];
                    $h_bid = $_SESSION["top_bids"][$i]["highest_bid_amount"];
                    $category = $_SESSION["top_bids"][$i]["category"];
                    $bids = $_SESSION["top_bids"][$i]["bids"];
                    $tier = $_SESSION["top_bids"][$i]["tier"];
                    $start = $_SESSION["top_bids"][$i]["start"];
                    $end = $_SESSION["top_bids"][$i]["end"];

                    $first_date = new DateTime(date('Y-m-d h:i:s',$start/1000));
                    $second_date = new DateTime(date('Y-m-d h:i:s',$end/1000));

                    $difference = $first_date->diff($second_date);
                    
                    echo "<div class='auc-div'>";
                        echo "<p class='auc-item-" . $tier . "'>" . "#" . $i . " " . $item . "</p>";
                        echo "<p class='auc-tier-" . $tier . "'>" . "Tier: " . $tier . "</p>";
                        echo "<p class='auc-hbid'>" . "Highest Bid: " . $h_bid . "</p>";
                        echo "<p class='auc-sbid'>" . "Start Bid: " . $s_bid . "</p>";
                        echo "<p class='auc-startd'>" . "Started at: " . date('Y-m-d h:i:s',$start/1000) . "</p>";
                        echo "<p class='auc-endd'>" . "Ends At: " . date('Y-m-d h:i:s',$end/1000) . "</p>";
                        echo "<p class='auc-endin'>Ends in: " . format_interval($difference) . "</p>";
                    echo "</div>" . "<br><hr><br>";
                }
            }
            else{
                echo "<p>SORTING FAILED PLESE TRY AGAIN LATER</p>";
            }
            
            pagination($pageno, $numofpages);
        ?>

        </div>
    </div>

<!-- FOOTER -->

<?php
require_once("includes/footer.php");

//This must be at the end of the page to enable it get the content of the page after load
// $cache->SaveCache();
?>