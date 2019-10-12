<!-- HEADER -->

<?php
 $_SESSION["title"] = "HySky | Welcome!";
 require_once("includes/header.php");
 ?>

<!-- CONTENT -->

    <div class="bg-light">
        <div class="container">

        <h3 class="py-5">Latest Skyblock News:</h3>
        <?php
            $key = "09828659-42c5-4360-9203-d93bcb5df79d";
            $link = "https://api.hypixel.net/skyblock/news?key=" . $key; 
            $json = file_get_contents($link);
            $news = json_decode($json, true);
            $no = sizeof($news["items"]);

            // NEWS LIST
            for($i=0; $i <= $no; $i++){
                    echo("<a target='_blank' href=" . $news["items"][$i]["link"] . ">" . $news["items"][$i]["title"] . "</a>");
                    echo("<p>" . $news["items"][$i]["text"] . "</p>" . "<br>");
            }
        ?>

        </div>
    </div>

<!-- FOOTER -->

<?php
require_once("includes/footer.php");
?>
