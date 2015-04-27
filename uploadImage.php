<?php

/**
 * uploadImage 
 *
 * 
 *
 * @version 1.0
 * @author Fengyu
 */
include 'common.php';
function validateAndUpdate($imageID,$player,$tmp, $target){
    
    $cID = (int)$imageID;

    //Connect
    $mysqli = new mysqli("153.120.6.104", "coc", "fengyu", "db_coc");
    if ($mysqli->connect_errno) {
        echo "Connect Failure";
    }
    
    
    $sql_get = "SELECT * FROM Investigators WHERE cID = ? AND cPlayer = ?" ;
    
    /* create a prepared statement */
    if ($stmt =$mysqli->prepare($sql_get)){
        
        /* bind parameters for markers */
        $stmt->bind_param('is',$cID,$cPlayer);

        $cID = sqlFilter($mysqli,$cID,SQL_INT);   
        $cPlayer = sqlFilter($mysqli,$player,SQL_STRING);
        
        $res = $stmt->execute();
        
        /* fetch value */
        $result = $stmt->get_result();
        $card = $result->fetch_array();
        
        $stmt->close();
        if($card == null){
            $mysqli->close();
            return false;
        }
        if(!move_uploaded_file($_FILES['image']['tmp_name'] , $target)){
            $mysqli->close();
            return false;            
        }
        $sql_update = "UPDATE Investigators SET cImage = ? WHERE cID = ?";
        if ($stmt =$mysqli->prepare($sql_update)){
            $target = sqlFilter($mysqli, $target,SQL_STRING);
 
            /* bind parameters for markers */
            $stmt->bind_param('si',$target,$cID);

            $res = $stmt->execute();
        
            if(!$res){
                $mysqli->close();
                return false;
            }
            return true;
        }
    }

}

echo("!!!");

$imageID = $_GET["cardid"];
$player = $_GET["player"];
$imageName = $_FILES['image']['name'];
$imageError = $_FILES['image']['error'];
$imageSize = $_FILES['image']['size'];
echo($imageID." ".$imageName);
if($imageName != ''){
    //$tail = " ";
    $start = strripos($imageName,'.');
    $tail = substr($imageName,$start);
    
    if($tail == ".jpg" || $tail == ".png"){
        $target = "./cards/images/".$imageID. $tail;
        $tmp = $_FILES['image']['tmp_name'];
        if(validateAndUpdate($imageID,$player,$tmp,$target)){
           
        }else{}
    }else{
        
    }

}else{
}

?>
