<?php
    $filename = "creatures-of-the-mythos-json.txt";
    $handle = fopen($filename, "r");//读取二进制文件时，需要将第二个参数设置成'rb'

    //通过filesize获得文件大小，将整个文件一下子读到一个字符串中
    $str = fread($handle, filesize ($filename));
    fclose($handle);
    
    $creatureArray = json_decode($str,true);

    
    //MAIN ENTRY
    if(isset($_GET["cid"])==true){
        $cID = (int)$_GET["cid"];
        
        if(!is_int($cID)){
            echo("_(:з」∠)_");
            return;
        }
        if($cID >36){
            echo("_(:з」∠)_怪物索引错误");
            return;
        }        
    }else{
        $cID = 2;
    }
    
    $creature = $creatureArray[$cID];
    $imageName = $creatureArray[$cID]["eName"];
    $imageName = str_replace(" ","-",$imageName);
    $imageURL = "images/creature/".$imageName.".jpg";

?>

 <!-- TRPG Call of Cthulhu Gallery of Mythos Creature-->
 <!-- Arthur:       Fengyu-->
 

<!DOCTYPE html>
<html lang="zh-CN">
<head>
<link rel="stylesheet" href="coc.css">

<!-- jQuery CDN-->
<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.1.min.js"></script>
<script src="jquery.scrollTo.js"></script>
<!-- bootstrap CDN-->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>



</head>
<body>
    <div class = "div_creature_gallery" class="container-fluid">

        <div class="div_card_creature div_card_investigator">

            <div class="div_creature_info">
            <div class="div_card_show_name"><?php echo($creature["Name"]);?></div>
            <?php 
            $html = "<p>".$creature["eName"]."</p><p>".$creature["Class"]."</p>";
                echo($html);
            ?>
            </div>
            <div class="div_creature_image">
            </div>
            
            <div class="div_creature_point">
            <?php 
           /*     $html = "";
                $pointName = array("力量","体质","体型","智力","意志","敏捷");
                $pointKey  =  array("STR","CON","SIZ","INT","POW","DEX");
                for($i=0;$i<6;$i++){
                    $html = $html. '<div class="row">';
                    $html = $html . '<div class="col-xs-4 col-md-4">'.$pointName[$i].'</div>';
                    $html = $html . '<div class="col-xs-4 col-md-4">'.$creature[$pointKey[$i]].'</div>';
                    $html = $html . '<div class="col-xs-4 col-md-4" id ="div_creature_'.$pointKey[$i].'"></div>';
                    $html = $html . '</div>';
                }
                echo($html);*/
            ?>
            </div>
            <div class="div_creature_sample">
            <?php 
                $html = str_replace('\n',"<br>",$creature['Card']);
                echo($html);
            ?>
            </div>

            <div class="div_creature_about">
            <?php 
                $html = str_replace('\n',"<br>",$creature['About']);
                echo($html);
            ?>
            </div>
            <div class="div_creature_quote">
            <?php 
                $html = str_replace('\n',"<br>",$creature['Quote']);
                echo($html);
            ?>

            </div>
            <p class="image_statemeng">The images HERE are cited from Call of Cthulhu Rulebook, Six Edition and are for Education only</p>
        </div>
    </div>
    <?php include("footer.php")?>
</body>

<script type="text/javascript">
    $(document).ready(function () {

        $(".div_creature_image").css("background-image", "url(<?php echo($imageURL);?> )");
    });
</script>
</html>