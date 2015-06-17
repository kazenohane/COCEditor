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


function space($n){
    $space ="";
    for($i=0;$i<$n;$i++){
        $space .= "&nbsp";
    }
    return $space;
}

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
"20" => "地质学",
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
$specialSkillID = array(57, 58, 59, 60, 61, 62, 63, 64, 65, 66, 67, 68, 69, 70, 71);


//MAIN ENTRY
    if(isset($_GET["cardid"])==true){
        $cID = (int)$_GET["cardid"];
    
        if(!is_int($cID)){
            echo("_(:з」∠)_");
            return;
        }
    }else{
        $cID = 10000;
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
            echo("抱歉，这是错误的调查员ID");
            exit();
        }
        
        $stmt->close();
        
     
    }
    
    //文本处理

    
    $card['cBackground'] = str_replace('\n',"<br><br>",$card['cBackground']);
    $card['cItem'] = str_replace('\n',"<br><br>",$card['cItem']);   
    
 ?>
 
 `
 <!-- TRPG Call of Cthulhu Investigator Card Viewer-->
 <!-- Art Designer: Mr.p -->
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
<div id = "div_card_arcade" class="container-fluid">
<div class="div_card_investigator">
    <div class="div_card_show_player"><?php echo("玩家 ".$card['cPlayer']);?></div>
    <div class="div_card_show_name"><?php echo($card['cName']);?></div>
    <div class="div_card_show_occupation"><?php echo("".$card['cOccupation']);?></div>
    <div class="div_card_show_info">
            <?php 
                $html = " ".$card["cGender"].space(2)." ".$card["cAge"]." 岁  ".space(2).$card["cNationality"]."人  ";
                echo($html);
            ?>
    </div>

    <div class="div_card_panel_1">
        <div class="div_card_image">
        
        </div>
        <div class="div_card_info">
            

  




            <div class="div_card_show_status">
                <div class="div_card_show_status_item" id = "div_card_show_status_1">
                <img class="img_status_icon"src="images/hp.png" />
                <?php 
                    $html = space(1)."".$card["cHP"]."";
                    echo($html);
                ?>
                </div>
                <div class="div_card_show_status_item" id = "div_card_show_status_2">
                <img class="img_status_icon"src="images/mp.png" />
                <?php 
                    $html = space(1)."".$card["cMP"]."";
                    echo($html);
                ?>
                </div>
                 <div class="div_card_show_status_item" id = "div_card_show_status_3">
                <img class="img_status_icon " id = "img_status_icon_san" src="images/san.png" />
                <?php 
                    $html = space(1)."".$card["cSanity"]."";
                    echo($html);
                ?>
                </div>
            </div>
            <div class="div_card_show_point_1">
            <?php 
            $html = '<p class="p_show_point">力量 '.$card['cSTR'].'</p><p class="p_show_point"> 体质 '.$card['cCON'].'</p><p class="p_show_point">意志 '.$card['cPOW'].'</p> <p class="p_show_point">敏捷 '.$card['cDEX'].'</p> <p class="p_show_point">外表 '.$card['cAPP'].'</p>';
                echo($html);
            ?>
            </div>

            <div class='div_card_show_point_2'>
            <?php 
            $html = ' <p class="p_show_point">体型 '.$card['cSIZ'].'</p> <p class="p_show_point">智力 '.$card['cINT'].'</p> <p class="p_show_point">教育 '.$card['cEDU'].'</p> <p class="p_show_point">财产 '.$card['cMoney'].'</p> <p class="p_show_point">母语 '.$card['cLanguage'].'</p>';
                echo($html);
            ?>
            </div>

            <div class='div_card_show_value'>
            <?php 
                $know = $card['cEDU']*5;
                if($know>100){$know = 100;}
                $html = ' <p class="p_show_point">灵感 '.($card['cINT']*5).'</p> <p class="p_show_point">幸运 '.($card['cPOW']*5).'</p> <p class="p_show_point">理智 '.($card['cPOW']*5).'</p> <p class="p_show_point">知识 '.$know.'</p> <p class="p_show_point">伤害加值 '.damageBouns((int)$card['cSTR'],(int)$card['cSIZ']).'</p> <p class="p_show_point">克苏鲁神话 '.$card['cCthulhuMythos'].'</p>';
                echo($html);
                
            ?>
            </div>

           
        </div>
    </div>

     <div class="div_card_skill_title"></div>

     <div class="div_card_show_skill">
            <?php 
            $html ="";
            $count = 0;
            $valid = 1;
            foreach ($skillName as $key => $value){
                    if($valid == 1 &&$count %6 == 0){
                        $html = $html . '<div class="row">';
                    }
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
                            $span = '<span class="span_black">';
                            if($card[$cSkill]>79){
                                $span = '<span class="span_red">';
                            }else if($card[$cSkill]>49){
                                $span = '<span class="span_blue">';
                            }else if($card[$cSkill]>29){
                                $span = '<span class="span_green">';
                            }
                            
                            $html = $html . '<div class="col-xs-2 col-md-2"> ' . $span . $skillName . " ".  $card[$cSkill] ."</span></div> ";
                            $count++;
                            if($count %6 == 0){
                                $html = $html . '</div>';     
                            }
                        }
                    }


                }
                
                if($count %6 != 5){ //技能数目未满一排 补上结束符号
                    $html = $html . '</div>';     
                }
                
                echo($html);
            ?>
    </div>

     <div class="div_card_skill_note">
         <img class="img_skill_icon"src="images/amateur.png" />30~49 业余
         <img class="img_skill_icon"src="images/skilled.png" />50~79 熟练
         <img class="img_skill_icon"src="images/master.png" />80~100 大师
     </div>

    <div class="div_card_item_title"></div>
    <div class="div_card_item">
    <?php echo("".$card['cItem']);?>
    </div>
    <div class="div_card_background_title"></div>
    <div class="div_card_background">
    <?php echo("".$card['cBackground']);?>
    </div>

    <div class="div_card_end">
    <img src="images/triangle.png" />
    </div>
    <div id="div_update_image">
        <form id="submit_image" method="post" action="uploadImage.php<?php echo('?cardid='.$card["cID"].'&player='.$card["cPlayer"]);?>" enctype="multipart/form-data" target="uploadfile">

          <div class="form-group div_update_align">
          
            <label>修改调查员形象</label>
           
            <input type="file" name ="image" id="input_image_file" />
            <p class="help-block">仅接受1MB以内的jpg与png格式图像文件</p>
          </div>
          
          <div class="div_update_align">
          <button type="submit" id="button_image_submit" class="btn btn-success">提交</button>
          </div>
        </form>
        <iframe name="uploadfile" width="0px" height="0px"></iframe>
        
        
        <div class="div_update_align">
        <label>修改调查员资料</label>
        </div>
		<textarea id="input_background" class="input_info"  placeholder ="人物背景"></textarea>
		
		<textarea id="input_item" class="input_info" placeholder ="携带物品"></textarea>
        <div class="div_update_align">
		<button type="submit" id="button_info_submit" class="btn btn-success">提交</button>
        <br><br>
        </div>
    </div>
    <div class="div_card_end">
    <br>
    可以使用键盘 左右方向键 查看其它调查员。
    <br>
    </div>
</div>

</body>

<script type="text/javascript">
    $(document).ready(function () {

        $(".div_card_image").css("background-image", "url(<?php echo($card['cImage']);?> )");

        $(document).keydown(function (event) {
            var cID =  <?php echo($cID);?>;
            //Left Array = 37, Right Array = 39
            if (event.keyCode == 37) {
                window.location.href = 'card.php?cardid='+ parseInt(cID-1).toString();
            } else if (event.keyCode == 39) {
                window.location.href = 'card.php?cardid='+ parseInt(cID+1).toString();
            }
        }); 

       $("#button_info_submit").click(function (e) {
            
            var jsonObj = new Object();
            var valid = false;
    
            var backgroundText = $.trim($("#input_background").val());
            var itemText = $.trim($("#input_item").val());
            
            var oldBackgroundText = $.trim($(".div_card_background").html());
            var oldItemText = $.trim($(".div_card_item").html());
            if(backgroundText != ''){
                if(backgroundText.length < oldBackgroundText.length -100){
                    if(!window.confirm('你的新背景似乎比之前短很多，确定要提交吗？')){
                        return;
                    }
                }
               jsonObj["bg"] = backgroundText ;
               valid = true;
            }
            if(itemText != ''){
               if(itemText.length < oldItemText.length -100){
                    if(!window.confirm('你的新背景似乎比之前短很多，确定要提交吗？')){
                        return;
                    }
                }
                jsonObj["item"] = itemText ;
                valid = true;
            }
            
            if(valid == true){    
                var targetURL = "updateInfo";
                var json = JSON.stringify(jsonObj);
                alert(json);
                $.post(targetURL, { info: json }, function (data) {
                    showResult(data);
                });   
    
            }
        });
    
    });

    $("#submit_image").submit(function (e) {

        var fileName = $("#input_image_file").val();

        if (fileName == "") {
            $(".help-block").html("请选择文件");
            return;
        }
        var dot = fileName.lastIndexOf(".");
        var tail = fileName.substr(dot);
        //alert(fileName);
        //alert(tail);
        if (tail == ".jpg" || tail == ".png") {
            $(".help-block").text("请稍等片刻后刷新页面");
        } else {
            $(".help-block").text("仅接受1MB以内的jpg与png格式图像文件");

        }
    });

 
    
</script>

</html>
<?php include("footer.php")?>

<?php

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
"20" => "地质学",
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
//$txtName = iconv( "UTF-8", "gb2312//IGNORE" , $name);
$fileDir = "./cards/".$txtName;
//echo($fileDir);


$txt =      "-------TRPG Call of Cthulhu 人物卡-------"."\r\n";
                                                     
if(!file_exists($fileDir)){

    $know = $card['cEDU']*5;
    if($know>100){$know = 100;}
                
    foreach($cardInfoArray as $key => $value){
        $txt .= $value.':  '.$card[$key]."\r\n";
    }
    $txt .= "\r\n"."\r\n";
    $txt .=  "生命值".':  '.$card['cHP']."\r\n";
    $txt .=  "魔法值".':  '.$card['cMP']."\r\n";
    $txt .=  "心智点".':  '.$card['cSanity']."\r\n";
    $txt .=  "灵感".':  '.($card['cINT']*5)."\r\n";
    $txt .=  "幸运".':  '.($card['cPOW']*5)."\r\n";
    $txt .=  "理智".':  '.($card['cPOW']*5)."\r\n";
    $txt .=  "知识".':  '.($know)."\r\n";
    $txt .=  "伤害加值".':  '.damageBouns((int)$card['cSTR'],(int)$card['cSIZ'])."\r\n";
    $txt .= "\r\n"."\r\n";

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
                $txt .=  $skillName.':  '.$card[$cSkill]."\r\n";
            }
         }
     }
    $txt .= "\r\n"."\r\n";
    $txt .=  "人物背景".':  '.$card['cBackground']."\r\n";
    $txt .= "\r\n"."\r\n";
    $txt .=  "携带物品".':  '.$card['cItem']."\r\n";

    $fw = fopen($fileDir,'w');
	if($fw){
		fwrite($fw, $txt);
		fclose($fw);
	}else{
        echo("TXT ERROR");
    }

}
?>