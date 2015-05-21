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
<div id = "div_card_arcade" class="container-fluid">
<div class="div_card_investigator">
    <br>
    <div class="div_card_show_name">调查员档案</div>
    <div class="div_card_list">
        
    <div class="row">
        <div class="col-xs-offset-1 col-xs-4">
        <span class="span_bold span_gold"><h4>调查员</h4></span>
        </div>
        <div class="col-xs-3">
        <span class="span_bold span_gold"><h4>玩家</h4></span>
        </div>
        <div class="col-xs-3">  
        
        </div>
    </div>

  
<?php

/**
 * Gallery of Investigators
 *
 * 
 *
 * @version 1.0
 * @author Fengyu
 */
include 'common.php';


function space($n){
    $space ="";
    for($i=0;$i<$n;$i++){
        $space .= "&nbsp";
    }
    return $space;
}




    //Connect
    $mysqli = new mysqli("153.120.6.104", "coc", "fengyu", "db_coc");
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $sql_get = "SELECT cID, cName, cPlayer FROM Investigators order by cID desc";
    
    /* create a prepared statement */
    if ($stmt =$mysqli->prepare($sql_get)){
        
        /* bind parameters for markers */
        $stmt->bind_param('i',$cID);
        $res = ($stmt->execute());
        
        /* fetch value */
        $result = $stmt->get_result();
        while($card = $result->fetch_array()){
            $html = '<div class="row card_list_row">';
            $html .= '<div class="col-xs-offset-1 col-xs-4">';
            
            $html .= '<a href="http://fny.me/coc/card.php?cardid='
            . $card['cID'].'">'.$card['cName'].'</a></div>';
            
            $html .= '<div class=" col-xs-3">';
            $html .=  $card['cPlayer'].'</div>';
            
            $html .= '<div class=" col-xs-3">';
            
            $cardName = str_replace(" ","_",$card['cName']); 
            $txtName =  $card['cID'].'_'.$cardName.'.txt';
            $html .= '<a href="http://fny.me/coc/cards/'
            .$txtName .'">'.txt卡.'</a></div>';
            
            $html .='</div>';
            echo($html);
        }
        
        $stmt->close();
        
     
    }
    
    //文本处理
  
 ?>
 
 
 <!-- TRPG Call of Cthulhu the Gallery of Investigators-->
 <!-- Art Designer: Mr.p -->
 <!-- Arthur:       Fengyu-->

     </div>
</div>
</div>
</body>
</html>
<?php include("footer.php")?>