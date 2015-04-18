<?php
define("SQL_STRING",0);
define("SQL_INT",1);
function SQLFilter($str, $type)
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
  $str = str_replace("'", "&#039;",$str);
  $str = mysql_real_escape_string($str);
  return $str;
}



//Connect
$mysqli = new mysqli("153.120.6.104", "coc", "fengyu", "db_coc");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
echo $mysqli->host_info . "\n";

//Constant Variable
$SKILL_NUM = 71;


//Create table
$sql_create="
CREATE TABLE Investigators(
cID int,
cName varchar(90),
cPlayer varchar(90),
cGender varchar(90),
cAge int,
cNationality varchar(90),
cLanguage varchar(90),
cOccupation varchar(90),
cSTR int,
cCON int,
cPOW int,
cDEX int,
cAPP int,
cSIZ int,
cINT int,
cEDU int,
cMoney int,
cSkill_50 int,
cSkill_29 int,
cSkill_13 int,
cSkill_30 int,
cSkill_17 int,
cSkill_33 int,
cSkill_31 int,
cSkill_40 int,
cSkill_22 int,
cSkill_14 int,
cSkill_11 int,
cSkill_19 int,
cSkill_24 int,
cSkill_38 int,
cSkill_21 int,
cSkill_49 int,
cSkill_45 int,
cSkill_27 int,
cSkill_12 int,
cSkill_9 int,
cSkill_26 int,
cSkill_10 int,
cSkill_35 int,
cSkill_8 int,
cSkill_54 int,
cSkill_18 int,
cSkill_53 int,
cSkill_55 int,
cSkill_44 int,
cSkill_3 int,
cSkillName_65 varchar(90),
cSkill_65 int,
cSkillName_66 varchar(90),
cSkill_66 int,
cSkillName_67 varchar(90),
cSkill_67 int,
cSkillName_68 varchar(90),
cSkill_68 int,
cSkillName_69 varchar(90),
cSkill_69 int,
cSkillName_70 varchar(90),
cSkill_70 int,
cSkill_1 int,
cSkill_2 int,
cSkill_4 int,
cSkill_5 int,
cSkill_6 int,
cSkill_7 int,
cSkill_15 int,
cSkill_16 int,
cSkill_20 int,
cSkill_23 int,
cSkill_25 int,
cSkill_28 int,
cSkill_32 int,
cSkill_34 int,
cSkill_36 int,
cSkill_37 int,
cSkill_39 int,
cSkill_41 int,
cSkill_42 int,
cSkill_43 int,
cSkill_46 int,
cSkill_47 int,
cSkill_48 int,
cSkill_51 int,
cSkill_52 int,
cSkillName_57 varchar(90),
cSkill_57 int,
cSkillName_58 varchar(90),
cSkill_58 int,
cSkillName_59 varchar(90),
cSkill_59 int,
cSkillName_60 varchar(90),
cSkill_60 int,
cSkillName_61 varchar(90),
cSkill_61 int,
cSkillName_62 varchar(90),
cSkill_62 int,
cSkillName_63 varchar(90),
cSkill_63 int,
cSkillName_64 varchar(90),
cSkill_64 int,
cHP int,
cMP int,
cSanity int,
cWeapon varchar(900),
cItem varchar(900),
cBackground varchar(30000),
cImage varchar(900),
cTime varchar(90),
cExperience varchar(9000),
PRIMARY KEY (cID)
)
";
  //  echo($sql_create);
    if (!$mysqli->query($sql_create)){
        echo "Table creation failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }

class Investigator{
    var $name;
    var $player;
    var $gender;
    var $age;
    var $nationality;
    var $language;
    var $occupation;
    var $pSTR;
    var $pCON;
    var $pPOW;
    var $pDEX;
    var $pAPP; 
    var $pSIZ;
    var $pINT; 
    var $pEDU;
    var $pMoney;
    var $sanity;
    var $HP;
    var $MP;
    var $image;
    var $weapon;
    var $items;
    var $background;
    var $skill= array(71);
    var $time;
    var $experience;
}

?>