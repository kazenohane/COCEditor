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

function validatePassord($p,$q){

    if($q ==null){
        $q = "callofcthulhu";
    }
    if($p == $q){
        return true;
    }
    return false;
}
function validateAndUpdate($cardID,$player,$background,$item,$password){
    
    $cID = (int)$cardID;
    $cPlayer = $player;
    
    
    //Connect
    $mysqli = new mysqli("153.120.6.104", "coc", "fengyu", "db_coc");
    if ($mysqli->connect_errno) {
        echo "Connect Failure";
    }
    $cPlayer = sqlFilter($mysqli,$player,SQL_STRING);

    
    $sql_get = "SELECT * FROM Players WHERE cName = ?" ;
    if ($stmt =$mysqli->prepare($sql_get)){
        
        /* bind parameters for markers */
        $stmt->bind_param('s',$cPlayer);

        
        $res = $stmt->execute();
        
        /* fetch value */
        $result = $stmt->get_result();
        $card = $result->fetch_array();
        
        $stmt->close();
        
        if($card == null){
            if(!validatePassord($password,null)){       
                $mysqli->close();
                return false;
            }
        }else{
        
            $storedPassword = $card['cPassword'];
             if(!validatePassord($password,$storedPassword)){
                $mysqli->close();
                return false;
            }
        }
        
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
        if($background != null && $background != ''){
            $sql_update = "UPDATE Investigators SET cBackground = ? WHERE cID = ?";
            if ($stmt =$mysqli->prepare($sql_update)){
                /* bind parameters for markers */
                $stmt->bind_param('si',$background,$cID);

                $res = $stmt->execute();
                if(!$res){
                    $mysqli->close();
                    return false;
                }
            }
        }
        if($item != null && $item != ''){
            $sql_update = "UPDATE Investigators SET cItem = ? WHERE cID = ?";
            if ($stmt =$mysqli->prepare($sql_update)){
                /* bind parameters for markers */
                $stmt->bind_param('si',$item,$cID);

                $res = $stmt->execute();
                if(!$res){
                    $mysqli->close();
                    return false;
                }
            }
        }
    }
    return true;
}


$str = $_POST["info"];
$obj = json_decode($str,true);
$cardID = $obj["cardid"];
$player = $obj["player"];
$background = $obj["bg"];
$item = $obj["item"];
$password = $obj["pwd"];

if(!validateAndUpdate($cardID,$player,$background,$item,$password)){
    echo("玩家 [".$player. "] 密码验证错误");
}else{
    echo("资料更新成功，请刷新页面");
}


?>
