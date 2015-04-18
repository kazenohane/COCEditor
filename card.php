<?php

/**
 * Investigator Card Page
 *
 * 
 *
 * @version 1.0
 * @author Fengyu
 */
include 'common.php';

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
"65" => "外语:",
"66" => "外语:",
"67" => "外语:",
"68" => "其他:",
"69" => "其他:",
"70" => "其他:",
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
"51" => "机关枪",
"52" => "游泳",
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
$specialSkillID = array(57, 58, 59, 60, 61, 62, 63, 64, 65, 66, 67, 68, 69, 70, 71);
function damageBouns($str,$siz){
        //Damage Bonus
    $sum = $str + $siz;
    $db = "-1D6";
    if ($sum > 12) { $db = "-1D4"; }
    if ($sum > 16) { $db = "0"; }
    if ($sum > 24) { $db = "1D4"; }
    if ($sum > 32) { $db = "1D6"; }
    if ($sum > 40) { $db = "2D6"; }
    if ($sum > 56) { $db = "3D6"; }
    if ($sum > 72) { $db = "4D6"; }
    if ($sum > 88) {
        $d = ($sum - 88) / 16 + 1 + 4;
        $db = $d."D6";
    }
    return $db;
}

//MAIN ENTRY
    if(isset($_GET["cardid"])==true){
        $cID = (int)$_GET["cardid"];
    
        if(!is_int($cID)){
            echo("_(:з」∠)_");
            return;
        }
    }else{
        $cID = 21;
    }
    //Connect
    $mysqli = new mysqli("153.120.6.104", "coc", "fengyu", "db_coc");
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $sql_get = "SELECT * FROM Investigators WHERE cID = ?";
    
    /* create a prepared statement */
    if ($stmt =$mysqli->prepare($sql_get)){
        
        /* bind parameters for markers */
        $stmt->bind_param('i',$cID);
        $res = ($stmt->execute());
        
        /* fetch value */
        $result = $stmt->get_result();
        $card = $result->fetch_array();
        if($card == null){
            echo("错误的调查员ID");
            exit();
        }
        
        $stmt->close();
        
     
    }

 ?>
 
 
 <!--TRPG Call of Cthulhu Investigator Card Fengyu-->

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
    <div id="div_card_panel_1">
        <div class="div_card_image">
        
        </div>
        <div class="div_card_info">
            <div class="div_card_show_name"><?php echo($card['cName']);?></div>
            <div class="div_card_show_player"><?php echo("玩家 ".$card['cPlayer']);?></div>
             <br>
            <div class="div_card_show_occupation"><?php echo("职业 ".$card['cOccupation']);?></div>
            <br>

             <div class="div_card_show_info">
            <?php 
                $html = " 性别 ".$card["cGender"]." 年龄 ".$card["cAge"]." 国籍 ".$card["cNationality"]." 母语 ".$card["cLanguage"];
                echo($html);
            ?>
             </div>
            <br>

            <div class="div_card_show_status">
            <?php 
                $html = " 生命值 ".$card["cHP"]." 魔法值 ".$card["cMP"]." 心智值 ".$card["cSanity"];
                echo($html);
            ?>
            </div>
            <br>

            <div class="div_card_show_point">
            <?php 
            $html = " 力量 ".$card["cSTR"]." 体质 ".$card["cCON"]." 意志 ".$card["cPOW"]." 敏捷 ".$card["cDEX"]." 外表 ".$card["cAPP"]." 体型 ".$card["cSIZ"]." 智力 ".$card["cINT"]." 教育 ".$card["cEDU"]." 财产 ".$card["cMoney"];
                echo($html);
            ?>
            </div>
            <br>
            <div class="div_card_show_value">
            <?php 
                $know = $card["cEDU"]*5;
                if($know>100){$know = 100;}
                $html = " 灵感 ".($card["cINT"]*5)." 幸运 ".($card["cPOW"]*5)." 理智 ".($card["cPOW"]*5)." 知识 ".$know." 伤害加值 ".damageBouns((int)$card["cSTR"],(int)$card["cSIZ"])." 克苏鲁神话 ".$card["cCthulhuMythos"];
                echo($html);
                
            ?>
            </div>
            <br>
           
        </div>
    </div>
     <div class="div_card_show_skill">
            <?php 
            $html ="调查员技能<br><br>";
                foreach ($skillName as $key => $value){
                    $cSkill = "cSkill_".$key;
                    $cSkillName = "cSkillName_".$key;
                    if(array_key_exists($cSkill,$card)){
                        $skillName = $value;
                        if(array_key_exists($cSkillName,$card)){
                            if($card[$cSkillName] != "" && $card[$cSkillName] != "外语" && $card[$cSkillName] != "艺术" && $card[$cSkillName] != "手艺"){
                                $skillName = $card[$cSkillName];
                            }else{continue;}
                       
                        }
                        $html = $html . " " . $skillName . " " . $card[$cSkill] ." "; 
                    }
                }
                echo($html);
            ?>
    </div>

    <div class="div_card_item">
    <?php echo("携带物品<br> ".$card['cItem']);?>
    </div>
    <div class="div_card_background">
    <?php echo("人物背景<br> ".$card['cBackground']);?>
    </div>

    <div id="div_update_image">
        <form id="submit_image" method="post" action="uploadImage.php<?php echo('?cardid='.$card["cID"].'&player='.$card["cPlayer"]);?>" enctype="multipart/form-data" target="uploadfile">

          <div class="form-group">
            <label>修改调查员形象</label>
            <input type="file" name ="image" id="input_image_file" />
            <p class="help-block">仅接受1MB以内的jpg与png格式图像文件</p>
          </div>
          <button type="submit" id="button_image_submit" class="btn btn-success">Submit</button>
        </form>
        <iframe name="uploadfile" width="0px" height="0px"></iframe>

    </div>
</div>
</body>

<script type="text/javascript">
    $(document).ready(function () {

        $(".div_card_image").css("background-image", "url(<?php echo($card['cImage']);?> )");
    });

    $("#submit_image").submit(function (e) {

        var fileName = $("#input_image_file").val();

        if (fileName == "") {
            $(".help-block").html("请选择文件");
            return;
        }
        var dot = fileName.lastIndexOf(".");
        var tail = fileName.substr(dot);
        alert(fileName);
        alert(tail);
        if (tail == ".jpg" || tail == ".png") {
            $(".help-block").text("请稍等片刻后刷新页面");
        } else {
            $(".help-block").text("仅接受1MB以内的jpg与png格式图像文件");

        }
    });

</script>

</html>
