 <?php
 
 $fileDir = "status/diceArena.txt";


 function getIP () //取IP函数
{
    global $_SERVER;
    if (getenv('HTTP_CLIENT_IP')) {
    $ip = getenv('HTTP_CLIENT_IP');
    } else if (getenv('HTTP_X_FORWARDED_FOR')) {
    $ip = getenv('HTTP_X_FORWARDED_FOR');
    } else if (getenv('REMOTE_ADDR')) {
    $ip = getenv('REMOTE_ADDR');
    } else {
    $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

 function rFile(){
    $maxNum= 100; 
    //Connect
    $mysqli = new mysqli("153.120.6.104", "coc", "fengyu", "db_coc");
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $sql_get = "SELECT * FROM DiceLog order by cLogID desc";
      /* create a prepared statement */
    if ($stmt =$mysqli->prepare($sql_get)){
        $res = ($stmt->execute());
        
        /* fetch value */
        $result = $stmt->get_result();
        $str = "";
        $count = 0;
        while($log = $result->fetch_array()){
            $str .= ("<p>". $log["cText"]."</p>");
            $count ++;
        }
        echo($str);
        if($count >= $maxNum){
            deleteFile($mysqli,   $maxNum);
        }
        $stmt->close();
    }
 }
  function deleteFile($mysqli,   $maxNum){

     $sql_get = "SELECT max(cLogID) FROM DiceLog";
     if ($stmt =$mysqli->prepare($sql_get)){
         $res = ($stmt->execute());
    
         $result = $stmt->get_result();
         $log = $result->fetch_array();
    
         //TODO
         $num = $log[0]- $maxNum+2;

         $sql_delete = "DELETE FROM DiceLog WHERE cLogID < ?";
         if ($stmt =$mysqli->prepare($sql_delete)){

                 /* bind parameters for markers */
                 $stmt->bind_param('i', $num);
                 $res = ($stmt->execute());
         }
    }
 }
 
 //add str to file
function updateFile($str){
   //Connect
    $mysqli = new mysqli("153.120.6.104", "coc", "fengyu", "db_coc");
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
      
    
    $sql_insert ="INSERT INTO DiceLog(cText)VALUES (?)";
 
     
     if($stmt =$mysqli->prepare($sql_insert)){

         $stmt->bind_param('s', $str);
         // cID 自增
         $stmt->execute();
       
         $stmt->close();   
         rFile();
     }

    
}
 
 //MAIN FUNCTION ENTRY
 if(isset($_POST["dice"])== true){


     $str = $_POST["dice"];
     $obj = json_decode($str,true);
     $log = "";

    
    
     switch($obj["code"]){
        
       //更新
        case 0:
            $log =rFile();
            
            break;
        //普通投点 COC
        case 1:
            
            $diceNum = $obj["p1"]; 
            $diceSize = $obj["p2"];
            $diceText = $obj["p3"];
            $str = getIP()." ".$diceText;
            $count = 0;
            
            if($diceNum ==1){
                $str .= " =<co> ". rand(1,$diceSize)."</co>";
            }else{
                $str .= " = {";
                for($i=0;$i<$diceNum;$i++){
                    $roll = rand(1,$diceSize);
                    $count += $roll;
                    $str .= (string)$roll.", ";
                }
                $str .= "} ";
                $str .= " =<co>" .(string)$count."</co>";
            }
            updateFile($str);
            break;
            
       //双重十字
       case 2:
            $diceX = $obj["p1"]; 
            $diceY = $obj["p2"];
            $diceText = $obj["p3"];
            $str = getIP()." ".$diceText;
            $strmax="";//记录每轮最大值的string
            
            $round= 1;
            
            $count = $diceX;
            $sum = 0;
            
            do{
                
                $diceNum = $count;
                $str .= " 第".(string)$round."轮={";
               
                $count = 0;
                $max = 0;
          
                for($i=0;$i<$diceNum;$i++){
                    $roll = rand(1,10);
                    $max = max($max, $roll);
                    
                    if($roll >= $diceY){
                        $count++;
                        $max = 10;
                        $str .= "<dx>".(string)$roll."</dx> ";
                    }else{
                        $str .= (string)$roll." ";
                    }
                    
                   
                }    
                if($max == 1){$max = 0;}
                $sum += $max;
                $str .="} ";
                $strmax .= (string)$max .", ";
                $round++;
            }while($count !=0);
            $str .= "每轮 = ".$strmax." "." 总值 =<co>".(string)$sum."</co>";
            updateFile($str);
            break;
            
           //COC 投点
        case 3:
            
            $diceText = $obj["p3"];
            $str = getIP()." ".$diceText;

            $result = array();
            for($i = 0;$i<5;$i++){
                $result[$i] = (rand(1,6) +rand(1,6) +rand(1,6));
            }
            for($i = 5;$i<7;$i++){
                $result[$i] = (rand(1,6) +rand(1,6) +6);
            }

            $result[7] = (rand(1,6) +rand(1,6) +rand(1,6)+3);
            $result[8] = (rand(1,10));
            $names = array();
             for($i=0;$i<9;$i++){
            $names[$i] ='力量';
            }
            $str= $str." !". (string)$result[0];

            $str= $str." !!!". $names[0];
     
            for($i=0;$i<9;$i++){
                $str = $str .' '.$names[$i].' '.((string)$result[$i]).' ';
            }
            $str= $str." !!END!";
            updateFile($str);
            break;
     } 
 }
 
 
 ?>