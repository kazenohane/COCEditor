<?php
    $filename = "creatures-of-the-mythos-json.txt";
    $handle = fopen($filename, "r");//读取二进制文件时，需要将第二个参数设置成'rb'

    //通过filesize获得文件大小，将整个文件一下子读到一个字符串中
    $str = fread($handle, filesize ($filename));
    fclose($handle);
    
    $creatureArray = json_decode($str,true);

    
    //MAIN ENTRY

    $imageName = $creatureArray[$cID]["eName"];
    $imageName = str_replace(" ","-",$imageName);
    $imageURL = "images/creature/".$imageName.".png";

?>

 <!-- TRPG Call of Cthulhu Gallery of Mythos Creature-->
 <!-- Author:       Fengyu-->
 

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
    <div class="div_card_investigator">
    <br>
    <div class="div_card_show_name">神话生物档案</div>
    
        <div class="div_creature_list">

        <?php
            $html = "";
            $count = 0;
            foreach ($creatureArray as  $key => $creature){ 
                if($count %4 == 0){
                    $html = $html . '<div class="row creature_list_row">';
                }
                $html = $html .'<div class="col-xs-3 col-md-3"> ';
                $html = $html .'<div class="div_creature_item">';
                $html = $html . '<a href="./creature.php?cid='.$count.'">';
                $html = $html . $creature["Name"]."<br>";
                $html = $html . $creature["eName"]."</div>";
                $html = $html . '</a>'; 
                $html = $html . "</div>";
                $count ++;
                if($count %4 == 0){
                    $html = $html . '</div>';     
                }  
            }  
            if($count %4 != 3){ //技能数目未满一排 补上结束符号
                $html = $html . '</div>';     
            }
            echo($html);
        ?>
        </div>
    </div>
    </div>
    <?php include("footer.php")?>
</body>
</html>