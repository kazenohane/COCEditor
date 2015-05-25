 <?php
 //header('Access-Control-Allow-Origin: *');
 //header('Access-Control-Allow-Methods: GET, POST');
 include 'common.php';
 
 $typeArray = array (
     'cName' => 0,
     'cPlayer' => 0,
     'cGender' => 0,
     'cAge' => 1,
     'cNationality' => 0,
     'cLanguage' => 0,
     'cOccupation' => 0,
     'cSTR' => 1,
     'cCON' => 1,
     'cPOW' => 1,
     'cDEX' => 1,
     'cAPP' => 1,
     'cSIZ' => 1,
     'cINT' => 1,
     'cEDU' => 1,
     'cMoney' => 1,
     'cCthulhuMythos' => 1,
     'cSkill_50' => 1,
     'cSkill_29' => 1,
     'cSkill_13' => 1,
     'cSkill_30' => 1,
     'cSkill_17' => 1,
     'cSkill_33' => 1,
     'cSkill_31' => 1,
     'cSkill_40' => 1,
     'cSkill_22' => 1,
     'cSkill_14' => 1,
     'cSkill_11' => 1,
     'cSkill_19' => 1,
     'cSkill_24' => 1,
     'cSkill_38' => 1,
     'cSkill_21' => 1,
     'cSkill_49' => 1,
     'cSkill_45' => 1,
     'cSkill_27' => 1,
     'cSkill_12' => 1,
     'cSkill_9' => 1,
     'cSkill_26' => 1,
     'cSkill_10' => 1,
     'cSkill_35' => 1,
     'cSkill_8' => 1,
     'cSkill_54' => 1,
     'cSkill_18' => 1,
     'cSkill_53' => 1,
     'cSkill_55' => 1,
     'cSkill_44' => 1,
     'cSkill_3' => 1,
     'cSkillName_65' => 0,
     'cSkill_65' => 1,
     'cSkillName_66' => 0,
     'cSkill_66' => 1,
     'cSkillName_67' => 0,
     'cSkill_67' => 1,
     'cSkillName_68' => 0,
     'cSkill_68' => 1,
     'cSkillName_69' => 0,
     'cSkill_69' => 1,
     'cSkillName_70' => 0,
     'cSkill_70' => 1,
     'cSkill_1' => 1,
     'cSkill_2' => 1,
     'cSkill_4' => 1,
     'cSkill_5' => 1,
     'cSkill_6' => 1,
     'cSkill_7' => 1,
     'cSkill_15' => 1,
     'cSkill_16' => 1,
     'cSkill_20' => 1,
     'cSkill_23' => 1,
     'cSkill_25' => 1,
     'cSkill_28' => 1,
     'cSkill_32' => 1,
     'cSkill_34' => 1,
     'cSkill_36' => 1,
     'cSkill_37' => 1,
     'cSkill_39' => 1,
     'cSkill_41' => 1,
     'cSkill_42' => 1,
     'cSkill_43' => 1,
     'cSkill_46' => 1,
     'cSkill_47' => 1,
     'cSkill_48' => 1,
     'cSkill_51' => 1,
     'cSkill_52' => 1,
     'cSkillName_57' => 0,
     'cSkill_57' => 1,
     'cSkillName_58' => 0,
     'cSkill_58' => 1,
     'cSkillName_59' => 0,
     'cSkill_59' => 1,
     'cSkillName_60' => 0,
     'cSkill_60' => 1,
     'cSkillName_61' => 0,
     'cSkill_61' => 1,
     'cSkillName_62' => 0,
     'cSkill_62' => 1,
     'cSkillName_63' => 0,
     'cSkill_63' => 1,
     'cSkillName_64' => 0,
     'cSkill_64' => 1,
     'cHP' => 1,
     'cMP' => 1,
     'cSanity' => 1,
     'cWeapon' => 0,
     'cItem' => 0,
     'cBackground' => 0,
     'cImage' => 0,
     'cTime' => 0,
     'cExperience' => 0,
     );
 

 
 function prepareDatabase()
 {
     //////初始化数据表  Used to create table and typeArray
     
     $str = '{"cName":"fz","cPlayer":"","cGender":"女","cAge":0,"cNationality":"","cLanguage":"","cOccupation":"","cSTR":10,"cCON":13,"cPOW":12,"cDEX":14,"cAPP":6,"cSIZ":14,"cINT":17,"cEDU":10,"cMoney":8,"cSkill_50":25,"cSkill_29":25,"cSkill_13":28,"cSkill_30":25,"cSkill_17":5,"cSkill_33":1,"cSkill_31":1,"cSkill_40":15,"cSkill_22":20,"cSkill_14":20,"cSkill_11":15,"cSkill_19":50,"cSkill_24":10,"cSkill_38":5,"cSkill_21":25,"cSkill_49":10,"cSkill_45":5,"cSkill_27":25,"cSkill_12":1,"cSkill_9":1,"cSkill_26":25,"cSkill_10":15,"cSkill_35":5,"cSkill_8":40,"cSkill_54":10,"cSkill_18":30,"cSkill_53":25,"cSkill_55":50,"cSkill_44":1,"cSkill_3":1,"cSkillName_65":"","cSkill_65":1,"cSkillName_66":"","cSkill_66":1,"cSkillName_67":"","cSkill_67":1,"cSkillName_68":"","cSkill_68":0,"cSkillName_69":"","cSkill_69":0,"cSkillName_70":"","cSkill_70":0,"cSkill_1":10,"cSkill_2":1,"cSkill_4":1,"cSkill_5":5,"cSkill_6":1,"cSkill_7":1,"cSkill_15":10,"cSkill_16":1,"cSkill_20":1,"cSkill_23":10,"cSkill_25":20,"cSkill_28":5,"cSkill_32":15,"cSkill_34":20,"cSkill_36":10,"cSkill_37":10,"cSkill_39":1,"cSkill_41":1,"cSkill_42":10,"cSkill_43":1,"cSkill_46":5,"cSkill_47":25,"cSkill_48":30,"cSkill_51":15,"cSkill_52":25,"cSkillName_57":"","cSkill_57":1,"cSkillName_58":"","cSkill_58":1,"cSkillName_59":"","cSkill_59":5,"cSkillName_60":"","cSkill_60":5,"cSkillName_61":"","cSkill_61":5,"cSkillName_62":"","cSkill_62":5,"cSkillName_63":"","cSkill_63":5,"cSkillName_64":"","cSkill_64":5,"cHP":13,"cMP":12,"cSanity":60,"cWeapon":"","cItem":"","cBackground":"","cImage":"","cTime":"","cExperience":""}';
     $obj = json_decode($str,true);
     $str = SQLFilter($str,"SQL_STRING");
     
     var_dump($obj);
     
     $sql_create="CREATE TABLE Investigators(";
     
     $typeArray = array();
     $column = "cID,";
     $data = "0,";
     $count = 0;
     $param = "?";
     $bindParam = "i";
     $bindValue ="$cID,";
     foreach ($obj as  $key => $value){ 
   
         if($count!=0){
             $column = $column.",";
             $data = $data.",";
         }else{$count = 1;}
         
         $param = $param."?,";
         $column = $column.$key;
         $bindValue =$bindValue.'$obj["'.$key.'"],';
         if(is_int($value)){
             $sql_create = $sql_create.$key." int,\n";
             $data = $data.sqlFilter($value,SQL_INT);   
             $typeArray[$key] = SQL_INT;
             $bindParam= $bindParam."i";
             
         }else{
             $sql_create = $sql_create.$key." varchar(30),\n";
             $data = $data.'"'.sqlFilter($value,SQL_STRING).'"';
             $typeArray[$key] = SQL_STRING;
             $bindParam= $bindParam."s";
         }
     }  
     //echo($column);
    // echo($data);
     
     echo("<br><br>");
     var_dump($typeArray);
     echo("<br><br>");
     echo($sql_create);
     echo("<br><br>");
     $sql_insert="INSERT INTO Investigators (".$column.")VALUES (".$param.")";//需要手动修改逗号  
     echo("<br><br>");
     $sql_insert2 = "INSERT INTO Investigators (".$column.")VALUES (".$data.")";
     
     echo($sql_insert);
     echo("<br><br>");
     echo($sql_insert2);
     echo("<br><br>");
     echo($bindParam);
     echo("<br><br>");
     echo($bindValue);
}   
// prepareDatabase();
 
 
 $errorLog ="建卡数据错误_(:з」∠)_";
 function checkCard($obj){
    $skillHeader = "cSkill_";
    $skillNum = 70;
    for($id = 1;$id<$skillNum+1;$id++){
        $skillName = $skillHeader.(string)$id;
         if(array_key_exists($skillName,$obj)){
             $skillValue = $obj[$skillName];
             if($skillValue<0 || $skillValue>100){
                 return false;
             }
         }
    }
    if($obj['cSTR']<0 || $obj['cSTR']>18){
        return false;
    }
    if($obj['cCON']<0 || $obj['cCON']>18){
        return false;
    }
    if($obj['cPOW']<0 || $obj['cPOW']>18){
        return false;
    }
    if($obj['cDEX']<0 || $obj['cDEX']>18){
        return false;
    }
    if($obj['cAPP']<0 || $obj['cAPP']>18){
        return false;
    }    
    if($obj['cSIZ']<0 || $obj['cSIZ']>18){
        return false;
    }
    if($obj['cINT']<0 || $obj['cINT']>18){
        return false;
    }    
    if($obj['cEDU']<0 || $obj['cEDU']>27){//考虑年龄规则
        return false;
    }
    if($obj['cCthulhuMythos']<0 || $obj['cCthulhuMythos']>100){
        return false;
    }
    return true;
 }	
 
 //MAIN FUNCTION ENTRY
 
 if(isset($_POST["card"])==true){
     
     $str = $_POST["card"];
     
     $obj = json_decode($str,true);

     //echo("Check passed");
     
     if(!checkCard($obj)){
         exit("建卡数据有错误");
     }
     
     //Connect
     $mysqli = new mysqli("153.120.6.104", "coc", "fengyu", "db_coc");
     if ($mysqli->connect_errno) {
         echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
     }
     //echo $mysqli->host_info . "\n";
     
     foreach ($obj as  $key => $value){ 
         if(!array_key_exists($key, $typeArray)){continue;}
    
         if($typeArray[$key] == SQL_INT){
             $obj[$key] = sqlFilter($mysqli,$value,SQL_INT);   
         }else{
             $obj[$key] = sqlFilter($mysqli,$value,SQL_STRING);   
         }
     }  
     
     $sql_get = "SELECT cID FROM Investigators WHERE cName = ? AND cPlayer = ? AND cItem = ? AND cBackground = ?";
     if ($stmt =$mysqli->prepare($sql_get)){
         
         /* bind parameters for markers */
         $stmt->bind_param('ssss',$obj["cName"],$obj["cPlayer"],$obj["cItem"],$obj["cBackground"]);
         $res = ($stmt->execute());
         
         /* fetch value */
         $result = $stmt->get_result();
         $card = $result->fetch_array();

         $stmt->close();
         if($card != null){
             echo("数据库上已有该名调查员");
             exit();
         }
     }
     
     


     $SKILL_NUM = 71;  
     
     $sql_insert ="INSERT INTO Investigators(cName,cPlayer,cGender,cAge,cNationality,cLanguage,cOccupation,
 cSTR,cCON,cPOW,cDEX,cAPP,cSIZ,cINT,cEDU,cMoney,cCthulhuMythos,cSkill_50,cSkill_29,cSkill_13,cSkill_30,cSkill_17,cSkill_33,
 cSkill_31,cSkill_40,cSkill_22,cSkill_14,cSkill_11,cSkill_19,cSkill_24,cSkill_38,cSkill_21,cSkill_49,cSkill_45,
 cSkill_27,cSkill_12,cSkill_9,cSkill_26,cSkill_10,cSkill_35,cSkill_8,cSkill_54,cSkill_18,cSkill_53,cSkill_55,
 cSkill_44,cSkill_3,cSkillName_65,cSkill_65,cSkillName_66,cSkill_66,cSkillName_67,cSkill_67,cSkillName_68,
 cSkill_68,cSkillName_69,cSkill_69,cSkillName_70,cSkill_70,cSkill_1,cSkill_2,cSkill_4,cSkill_5,cSkill_6,
 cSkill_7,cSkill_15,cSkill_16,cSkill_20,cSkill_23,cSkill_25,cSkill_28,cSkill_32,cSkill_34,cSkill_36,cSkill_37,
 cSkill_39,cSkill_41,cSkill_42,cSkill_43,cSkill_46,cSkill_47,cSkill_48,cSkill_51,cSkill_52,cSkillName_57,cSkill_57,
 cSkillName_58,cSkill_58,cSkillName_59,cSkill_59,cSkillName_60,cSkill_60,cSkillName_61,cSkill_61,cSkillName_62,
 cSkill_62,cSkillName_63,cSkill_63,cSkillName_64,cSkill_64,cHP,cMP,cSanity,cWeapon,cItem,cBackground,cImage,cTime,
 cExperience)VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,
 ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
     
     
     
     if($stmt =$mysqli->prepare($sql_insert)){
         $stmt->bind_param('sssisssiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiisisisisisisiiiiiiiiiiiiiiiiiiiiiiiiiisisisisisisisisiiiissssss',
             $obj["cName"],$obj["cPlayer"],$obj["cGender"],$obj["cAge"],$obj["cNationality"],$obj["cLanguage"],$obj["cOccupation"],
             $obj["cSTR"],$obj["cCON"],$obj["cPOW"],$obj["cDEX"],$obj["cAPP"],$obj["cSIZ"],$obj["cINT"],$obj["cEDU"],$obj["cMoney"],$obj["cCthulhuMythos"],
             $obj["cSkill_50"],$obj["cSkill_29"],$obj["cSkill_13"],$obj["cSkill_30"],$obj["cSkill_17"],$obj["cSkill_33"],$obj["cSkill_31"],
             $obj["cSkill_40"],$obj["cSkill_22"],$obj["cSkill_14"],$obj["cSkill_11"],$obj["cSkill_19"],$obj["cSkill_24"],$obj["cSkill_38"],
             $obj["cSkill_21"],$obj["cSkill_49"],$obj["cSkill_45"],$obj["cSkill_27"],$obj["cSkill_12"],$obj["cSkill_9"],$obj["cSkill_26"],
             $obj["cSkill_10"],$obj["cSkill_35"],$obj["cSkill_8"],$obj["cSkill_54"],$obj["cSkill_18"],$obj["cSkill_53"],$obj["cSkill_55"],
             $obj["cSkill_44"],$obj["cSkill_3"],$obj["cSkillName_65"],$obj["cSkill_65"],$obj["cSkillName_66"],$obj["cSkill_66"],$obj["cSkillName_67"],
             $obj["cSkill_67"],$obj["cSkillName_68"],$obj["cSkill_68"],$obj["cSkillName_69"],$obj["cSkill_69"],$obj["cSkillName_70"],$obj["cSkill_70"],
             $obj["cSkill_1"],$obj["cSkill_2"],$obj["cSkill_4"],$obj["cSkill_5"],$obj["cSkill_6"],$obj["cSkill_7"],$obj["cSkill_15"],$obj["cSkill_16"],
             $obj["cSkill_20"],$obj["cSkill_23"],$obj["cSkill_25"],$obj["cSkill_28"],$obj["cSkill_32"],$obj["cSkill_34"],$obj["cSkill_36"],$obj["cSkill_37"],
             $obj["cSkill_39"],$obj["cSkill_41"],$obj["cSkill_42"],$obj["cSkill_43"],$obj["cSkill_46"],$obj["cSkill_47"],$obj["cSkill_48"],$obj["cSkill_51"],
             $obj["cSkill_52"],$obj["cSkillName_57"],$obj["cSkill_57"],$obj["cSkillName_58"],$obj["cSkill_58"],$obj["cSkillName_59"],$obj["cSkill_59"],
             $obj["cSkillName_60"],$obj["cSkill_60"],$obj["cSkillName_61"],$obj["cSkill_61"],$obj["cSkillName_62"],$obj["cSkill_62"],$obj["cSkillName_63"],
             $obj["cSkill_63"],$obj["cSkillName_64"],$obj["cSkill_64"],
             $obj["cHP"],$obj["cMP"],$obj["cSanity"],$obj["cWeapon"],$obj["cItem"],$obj["cBackground"],$obj["cImage"],$obj["cTime"],$obj["cExperience"]);
   
         // cID 自增
         $stmt->execute();
         
         $stmt->close();
         
         $sql_get = "SELECT cID FROM Investigators WHERE cName = ? AND cPlayer = ? AND cItem = ? AND cBackground = ?";
         if ($stmt =$mysqli->prepare($sql_get)){
             
             /* bind parameters for markers */
             $stmt->bind_param('ssss',$obj["cName"],$obj["cPlayer"],$obj["cItem"],$obj["cBackground"]);
             $res = ($stmt->execute());
             
             /* fetch value */
             $result = $stmt->get_result();
             $card = $result->fetch_array();

             $stmt->close();
             if($card == null){
                 echo("数据库错误_(:з」∠)_");
                 exit();
             }
            
             $cID = $card['cID'];
             $card = $obj;
            $card['cID'] = $cID;
$cardInfoArray = array (
     'cName' => '姓名',
     'cPlayer' => '玩家',
     'cGender' => '性别',
     'cAge' => '年龄',
     'cNationality' => '国籍',
     'cLanguage' => '母语',
     'cOccupation' => '职业',
     'cSTR' => '力量',
     'cCON' => '体质',
     'cPOW' => '意志',
     'cDEX' => '敏捷',
     'cAPP' => '外表',
     'cSIZ' => '体型',
     'cINT' => '智力',
     'cEDU' => '教育',
     'cMoney' => '财产',
     'cCthulhuMythos' => '克苏鲁神话点数',

);
$skillName = array(
"50" => "侦查",
"29" => "图书馆利用",
"13" => "闪躲",
"30" => "聆听",
"17" => "快速交谈",
"33" => "武术",
"31" => "钳工",
"40" => "劝说",
"22" => "手枪",
"14" => "驾车/马术",
"11" => "信誉度",
"19" => "拳击/厮打",
"24" => "躲藏",
"38" => "神秘学",
"21" => "擒抱",
"49" => "潜行",
"45" => "心理学",
"27" => "踢",
"12" => "乔装",
"9" => "电脑使用",
"26" => "跳跃",
"10" => "藏匿",
"35" => "医学",
"8" => "攀爬",
"54" => "跟踪",
"18" => "急救",
"53" => "投掷",
"55" => "母语",
"44" => "心理分析",
"3" => "考古学",
"1" => "会计学",
"2" => "人类学",
"4" => "天文学",
"5" => "议价",
"6" => "生物学",
"7" => "化学",
"15" => "电器维修",
"16" => "电子学",
"20" => "地理学",
"23" => "头顶",
"25" => "历史",
"28" => "法律",
"32" => "机关枪",
"34" => "机器维修",
"36" => "自然史",
"37" => "领航",
"39" => "重型机械",
"41" => "药剂学",
"42" => "摄影",
"43" => "物理",
"46" => "骑术",
"47" => "来复枪",
"48" => "霰弹枪",
"51" => "冲锋枪",
"52" => "游泳",
"65" => "外语:",
"66" => "外语:",
"67" => "外语:",
"68" => "其他:",
"69" => "其他:",
"70" => "其他:",
"57" => "驾驶:",
"58" => "驾驶:",
"59" => "艺术:",
"60" => "艺术:",
"61" => "艺术:",
"62" => "手艺:",
"63" => "手艺:",
"64" => "手艺:",
"56" => "克苏鲁神话"
);
$cardName = str_replace(" ","_",$card['cName']); //去除空格    
$txtName =  $card['cID'].'_'.$cardName.'.txt';
$fileDir = "./cards/".$txtName;


$txt =      "-------TRPG Call of Cthulhu 人物卡-------"."\n";
                                                     
if(!file_exists($fileDir)){

    $know = $card['cEDU']*5;
    if($know>100){$know = 100;}
                
    foreach($cardInfoArray as $key => $value){
        $txt .= $value.':  '.$card[$key]."\n";
    }
    $txt .= ""."\n";
    $txt .=  "生命值".':  '.$card['cHP']."\n";
    $txt .=  "魔法值".':  '.$card['cMP']."\n";
    $txt .=  "心智点".':  '.$card['cSanity']."\n";
    $txt .=  "灵感".':  '.($card['cINT']*5)."\n";
    $txt .=  "幸运".':  '.($card['cPOW']*5)."\n";
    $txt .=  "理智".':  '.($card['cPOW']*5)."\n";
    $txt .=  "知识".':  '.($know)."\n";
    $txt .=  "伤害加值".':  '.damageBouns((int)$card['cSTR'],(int)$card['cSIZ'])."\n";
    $txt .= ""."\n";

    foreach ($skillName as $key => $value){
        
        $valid = 1;
        $cSkill = "cSkill_".$key;
        $cSkillName = "cSkillName_".$key;
        if(array_key_exists($cSkill,$card)){
            $skillName = $value;
            if(array_key_exists($cSkillName,$card)){
                if($card[$cSkillName] != "" && $card[$cSkillName] != "外语" && $card[$cSkillName] != "艺术" && $card[$cSkillName] != "手艺"){
                     if((int)$card[$cSkill]==0){
                          $valid = 0;
                     }
                     $skillName = $card[$cSkillName];
                 }else{
                      $valid = 0;
                 }                       
            }
            if($valid == 1){
                $txt .=  $skillName.':  '.$card[$cSkill]."\n";
            }
         }
     }
    $txt .= ""."\n";
    $txt .=  "人物背景".':  '.$card['cBackground']."\n";
    $txt .= ""."\n";
    $txt .=  "携带物品".':  '.$card['cItem']."\n";

    $fw = fopen($fileDir,'w');
	if($fw){
		fwrite($fw, $txt);
		fclose($fw);
	}else{
        echo("TXT ERROR");
    }
	
}


             echo("<p>调查员在线卡点这里 ->  <a href=\"http://fny.me/coc/card.php?cardid=".$card["cID"]."\">"."http://fny.me/coc/card.php?cardid=".$card["cID"]."</a></p>");
             
             echo("<p>TXT卡 下载点这里 ->  <a href=\"http://fny.me/coc/cards/".$txtName."\">".$card["cName"]."</a></p>");
         }
         
     }else{
        echo("数据库错误_(:з」∠)_");
     }
     $mysqli->close();
 }else{
     //Not from Ajax
     
 }










?>
