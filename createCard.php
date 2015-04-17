 <?php
 //header('Access-Control-Allow-Origin: *');
 //header('Access-Control-Allow-Methods: GET, POST');
 define("SQL_STRING",0);
 define("SQL_INT",1);
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
 function sqlFilter($mysqli,$str, $type)
 {
     // INT
     if ($type == SQL_INT)
     {
         if (is_numeric($str))
             return $str;
         else
             return 0;//default int
     }
     // String
     $str = str_replace("&", "&amp;",$str);
     $str = str_replace("<", "&lt;", $str);
     $str = str_replace(">", "&gt;", $str);
     if ( get_magic_quotes_gpc() )
     {
         $str = str_replace("\\\"", "&quot;",$str);
         $str = str_replace("\\''", "&#039;",$str);
     }
     else
     {
         $str = str_replace("\"", "&quot;",$str);
         $str = str_replace("'", "&#039;",$str);
         
     }
     
     //Customized
     
     $str = $mysqli->real_escape_string($str);
     
    
     return $str;
 }
 
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
 
 
 
 function checkCard($items){

     return true;
 }	
 
 //MAIN FUNCTION ENTRY
 
 if(isset($_POST["card"])==true){
     $str = $_POST["card"];
     
     $obj = json_decode($str,true);

     //echo("Check passed");
     
     if(!checkCard($obj)){
         exit("建卡数据有误");
     }
     
     //Connect
     $mysqli = new mysqli("153.120.6.104", "coc", "fengyu", "db_coc");
     if ($mysqli->connect_errno) {
         echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
     }
     echo $mysqli->host_info . "\n";
     
     foreach ($obj as  $key => $value){ 
         if(!array_key_exists($key, $typeArray)){continue;}
    
         if($typeArray[$key] == SQL_INT){
             $obj[$key] = sqlFilter($mysqli,$value,SQL_INT);   
         }else{
             $obj[$key] = sqlFilter($mysqli,$value,SQL_STRING);   
         }
     }  
     


     $SKILL_NUM = 71;  
     
     $sql_insert ="INSERT INTO Investigators(cName,cPlayer,cGender,cAge,cNationality,cLanguage,cOccupation,
 cSTR,cCON,cPOW,cDEX,cAPP,cSIZ,cINT,cEDU,cMoney,cSkill_50,cSkill_29,cSkill_13,cSkill_30,cSkill_17,cSkill_33,
 cSkill_31,cSkill_40,cSkill_22,cSkill_14,cSkill_11,cSkill_19,cSkill_24,cSkill_38,cSkill_21,cSkill_49,cSkill_45,
 cSkill_27,cSkill_12,cSkill_9,cSkill_26,cSkill_10,cSkill_35,cSkill_8,cSkill_54,cSkill_18,cSkill_53,cSkill_55,
 cSkill_44,cSkill_3,cSkillName_65,cSkill_65,cSkillName_66,cSkill_66,cSkillName_67,cSkill_67,cSkillName_68,
 cSkill_68,cSkillName_69,cSkill_69,cSkillName_70,cSkill_70,cSkill_1,cSkill_2,cSkill_4,cSkill_5,cSkill_6,
 cSkill_7,cSkill_15,cSkill_16,cSkill_20,cSkill_23,cSkill_25,cSkill_28,cSkill_32,cSkill_34,cSkill_36,cSkill_37,
 cSkill_39,cSkill_41,cSkill_42,cSkill_43,cSkill_46,cSkill_47,cSkill_48,cSkill_51,cSkill_52,cSkillName_57,cSkill_57,
 cSkillName_58,cSkill_58,cSkillName_59,cSkill_59,cSkillName_60,cSkill_60,cSkillName_61,cSkill_61,cSkillName_62,
 cSkill_62,cSkillName_63,cSkill_63,cSkillName_64,cSkill_64,cHP,cMP,cSanity,cWeapon,cItem,cBackground,cImage,cTime,
 cExperience)VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,
 ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
     
     
     echo($obj);
     
     $stmt =$mysqli->prepare($sql_insert);
     
     $stmt->bind_param('sssisssiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiisisisisisisiiiiiiiiiiiiiiiiiiiiiiiiiisisisisisisisisiiiissssss',
         $obj["cName"],$obj["cPlayer"],$obj["cGender"],$obj["cAge"],$obj["cNationality"],$obj["cLanguage"],$obj["cOccupation"],
         $obj["cSTR"],$obj["cCON"],$obj["cPOW"],$obj["cDEX"],$obj["cAPP"],$obj["cSIZ"],$obj["cINT"],$obj["cEDU"],$obj["cMoney"],
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
     
    // $cID = $id;
     $stmt->execute();
     

 }else{
     
     //Connect
     $mysqli = new mysqli("153.120.6.104", "coc", "fengyu", "db_coc");
     if ($mysqli->connect_errno) {
         echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
     }
     echo $mysqli->host_info . "\n";

     $SKILL_NUM = 71;
     
 
    
  
     
     $str = '{"cName":"fz","cPlayer":"","cGender":"女","cAge":0,"cNationality":"","cLanguage":"","cOccupation":"","cSTR":10,"cCON":13,"cPOW":12,"cDEX":14,"cAPP":6,"cSIZ":14,"cINT":17,"cEDU":10,"cMoney":8,"cSkill_50":25,"cSkill_29":25,"cSkill_13":28,"cSkill_30":25,"cSkill_17":5,"cSkill_33":1,"cSkill_31":1,"cSkill_40":15,"cSkill_22":20,"cSkill_14":20,"cSkill_11":15,"cSkill_19":50,"cSkill_24":10,"cSkill_38":5,"cSkill_21":25,"cSkill_49":10,"cSkill_45":5,"cSkill_27":25,"cSkill_12":1,"cSkill_9":1,"cSkill_26":25,"cSkill_10":15,"cSkill_35":5,"cSkill_8":40,"cSkill_54":10,"cSkill_18":30,"cSkill_53":25,"cSkill_55":50,"cSkill_44":1,"cSkill_3":1,"cSkillName_65":"","cSkill_65":1,"cSkillName_66":"","cSkill_66":1,"cSkillName_67":"","cSkill_67":1,"cSkillName_68":"","cSkill_68":0,"cSkillName_69":"","cSkill_69":0,"cSkillName_70":"","cSkill_70":0,"cSkill_1":10,"cSkill_2":1,"cSkill_4":1,"cSkill_5":5,"cSkill_6":1,"cSkill_7":1,"cSkill_15":10,"cSkill_16":1,"cSkill_20":1,"cSkill_23":10,"cSkill_25":20,"cSkill_28":5,"cSkill_32":15,"cSkill_34":20,"cSkill_36":10,"cSkill_37":10,"cSkill_39":1,"cSkill_41":1,"cSkill_42":10,"cSkill_43":1,"cSkill_46":5,"cSkill_47":25,"cSkill_48":30,"cSkill_51":15,"cSkill_52":25,"cSkillName_57":"","cSkill_57":1,"cSkillName_58":"","cSkill_58":1,"cSkillName_59":"","cSkill_59":5,"cSkillName_60":"","cSkill_60":5,"cSkillName_61":"","cSkill_61":5,"cSkillName_62":"","cSkill_62":5,"cSkillName_63":"","cSkill_63":5,"cSkillName_64":"","cSkill_64":5,"cHP":13,"cMP":12,"cSanity":60,"cWeapon":"","cItem":"","cBackground":"","cImage":"","cTime":"","cExperience":""}';
     $obj = json_decode($str,true);
     $str = SQLFilter($str,"SQL_STRING");
     
     var_dump($obj);
     
     $typeArray = array();
     $column = "";
     $data = "";
     $count = 0;
     
     foreach ($obj as  $key => $value){ 
         if(!array_key_exists($key, $typeArray)){continue;}
         
         if($count!=0){
             $column = $column.",";
             $data = $data.",";
         }else{$count = 1;}

         $column = $column.$key;
    
         if($typeArray[$key] == SQL_INT){
             $data = $data.sqlFilter($value,SQL_INT);   
             $typeArray[$key] = SQL_INT;
         }else{
             $data = $data.'"'.sqlFilter($value,SQL_STRING).'"';
             $typeArray[$key] = SQL_STRING;
         }
     }  
     
 $sql_insert ="INSERT INTO Investigators(cID,cName,cPlayer,cGender,cAge,cNationality,cLanguage,cOccupation,
 cSTR,cCON,cPOW,cDEX,cAPP,cSIZ,cINT,cEDU,cMoney,cSkill_50,cSkill_29,cSkill_13,cSkill_30,cSkill_17,cSkill_33,
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
     
     

     $stmt =$mysqli->prepare($sql_insert);
     echo($mysqli->prepare);
     $stmt->bind_param('isssisssiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiisisisisisisiiiiiiiiiiiiiiiiiiiiiiiiiisisisisisisisisiiiissssss',
         $cID,$obj["cName"],$obj["cPlayer"],$obj["cGender"],$obj["cAge"],$obj["cNationality"],$obj["cLanguage"],$obj["cOccupation"],
         $obj["cSTR"],$obj["cCON"],$obj["cPOW"],$obj["cDEX"],$obj["cAPP"],$obj["cSIZ"],$obj["cINT"],$obj["cEDU"],$obj["cMoney"],
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
     
     $cID = 1;
     $stmt->execute();
 }









?>