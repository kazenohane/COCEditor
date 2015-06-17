

 <!-- TRPG Call of Cthulhu Investigator Card Viewer-->
 <!-- Art Designer: Mr.p -->
 <!-- Author:       Fengyu-->

<!DOCTYPE html>
<html lang="zh-CN">
<head>

<!-- jQuery CDN-->
<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.1.min.js"></script>
<script src="jquery.scrollTo.js"></script>
<!-- bootstrap CDN-->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>


<link rel="stylesheet" href="coc.css">

<meta name="viewport" content="width=device-width, initial-scale=1,  user-scalable=no">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

</head>

<body>
<div id = "div_card_arcade" class="container-fluid">
<div class="div_card_investigator">
    <br>
    <div class="div_card_show_name"><?php echo("Dice Arena");?></div>
    <br>
    
     <div class="row card_list_row">
            <div class="col-xs-3">
                <p class="label_name">昵称</p>
            </div>
            <div class="col-xs-7">
                <input type="text"  class="form-control input_info" placeholder = "显示昵称" id="input_dice_name"></input>
            </div>
            <div class="col-xs-2">
                  <button id="button_refresh" class="button_dice btn btn-success">刷新</button>
            </div>
            
     </div>
     
    <div class="row card_list_row">
            <div class="col-xs-3">
                <p class="label_name">输入</p>
            </div>
            <div class="col-xs-7">
                <input type="text"  class="form-control input_info" placeholder = "投点代码" id="input_dice_code"></input>
            </div>
            <div class="col-xs-2">
                  <button id="button_roll" class="button_dice btn btn-success">执行</button>
            </div>
    </div> 
    
        <div class="row card_list_row">
            <div class="col-xs-2">
                  <button id="button_0" class="button_dice btn btn-warning">1d100</button>
            </div>
            <div class="col-xs-2">
                  <button id="button_1" class="button_dice btn btn-warning">1d20</button>
            </div>
            <div class="col-xs-2">
                  <button id="button_2" class="button_dice btn btn-success">1d10</button>
            </div>            
            <div class="col-xs-2">
                  <button id="button_3" class="button_dice btn btn-success">1d6</button>
            </div>
            <div class="col-xs-2">
                  <button id="button_4" class="button_dice btn btn-success">1d4</button>
            </div>
             <div class="col-xs-2">
                  <button id="button_5" class="button_dice btn btn-success">1d3</button>
            </div>
    </div> 
    
     <div class="row card_list_row">
        <div class="col-xs-2">
             <button id="button_6" class="button_dice btn btn-info">COC</button>
        </div>
    
        <div class="col-xs-2">
             <button id="button_7" class="button_dice btn btn-info">COCx5</button>
        </div>
    </div>
    
    <br>
     <div class="row card_list_row">
	<div id="div_dice_info">
	</div>    
    </div> 
    
    <div class="row card_list_row">
	<div id="div_dice_code">
        <p>.r xdy  -- 投x个y面骰， 注意xdy不能用空格</p>
        <p>.dx xay  -- dx骰池，x次，暴击值y 注意xay不能用空格</p>
	</div>    
    </div> 
    
    <hr>

	<div id="div_dice_result">
	</div>
</div>
</div>
<?php include("footer.php")?>

</body>

<script type="text/javascript">
function getTime(){
        var today = new Date();
        
        var year = today.getFullYear();
                var month =(today.getMonth() + 1).toString();
                var day = (today.getDate()).toString();
                if (month.length == 1) {
                    month = "0" + month;
                }
                if (day.length == 1) {
                    day = "0" + day;
                }
         var dateTime =  month + "/"+ day;

        var h = today.getHours().toString();
        var m = today.getMinutes().toString();
        var s = today.getSeconds().toString();
        
        if (h.length == 1) {
             h = "0" + h;
        }
        if (m.length == 1) {
             m = "0" + m;
        }        
        if (s.length == 1) {
             s = "0" + s;
        }
        var timeText = h + ":" + m + ":" + s;
        return (dateTime+" "+timeText);
}

var ddd = 24 * 3600;

function clearMsg(){
     $("#div_dice_info").html("");
}
function showMsg(info){
     $("#div_dice_info").html("<span class=\"span_gold\">"+info +"</span>");
}
function showError(err){
var info = "未知的错误";
switch(err)
    {
    case 0:
      info = "请输入投点代码";
      break;
    case 1:
      info = "投点代码不正确";
      break;
    default:
    }    
    $("#div_dice_info").html("<span class=\"span_red\">"+info +"</span>");
}

var reDA = /\.*r* *(\d*)[Dd](\d*) *([\+\-]) *(\d*)[Dd]?(\d*) *([\+\-])? *(\d*)[Dd]?(\d*) *([\+\-])? *(\d*)[Dd]?(\d*) *([\+\-])? *(\d*)[Dd]?(\d*) *([\+\-])? *(\d*)[Dd]?(\d*) *([\+\-])? *(\d*)[Dd]?(\d*) *(.*)/;

var reD = /\.*r* *(\d*)[Dd](\d*) *(.*)/;
var reDX = /\.*[Dd][Xx] *(\d*)[Aa]?(\d*) *(.*)/;
var reTag = /\d*\.\d*\.(\d*\.\d* \d*\/\d*)/g;
$(document).keypress(function(e) {  
    // 回车键事件  
    if(e.which == 13) {  
       jQuery("#button_roll").click();  
    }  
}); 

function toInt(text) {
    var res = parseInt(text);
    if (isNaN(res)) { res = 0; }
    return res;
}
function blank(num){
	var blank = '';
	for(var i=0;i<num;i++){
		blank +="&nbsp";
	}
	return blank;
}
function showResult(data){
    clearMsg();
	
	 
    //FOR COC
    data = data.replace(/<co>/g,"<span class=\"span_gold span_bold\">");
    data = data.replace(/<\/co>/g,"</span>");
    
    //FOR DOUBLE CROSS
    data = data.replace(/<dx>/g,"<span class=\"span_dx\">");
    data = data.replace(/<\/dx>/g,"</span>");

    //FOR COC Characteristic

	//data = data.replace(/COC属性/g,"COC属性<br>"+blank(20));
	
    data = data.replace(/<coc0>/g,blank(1)+"<span class=\"span_green span_bold\">");
    data = data.replace(/<\/coc0>/g,"</span>"+blank(2));

    data = data.replace(/<coc1>/g,blank(1)+"<span class=\"span_blue \">");
    data = data.replace(/<\/coc1>/g,"</span>"+blank(2));

    data = data.replace(/<coc2>/g,blank(1)+"<span class=\"span_red span_bold\">");
    data = data.replace(/<\/coc2>/g,"</span>"+blank(2));

    data = data.replace(/<coc3>/g,blank(1)+"<span class=\"span_gold span_bold\">");
    data = data.replace(/<\/coc3>/g,"</span>"+blank(2));
	
	// Shorten IP and make IP/TIME grey
    data =data.replace(reTag,"<span class=\"span_tag\"> $1 </span>");
     
    $("#div_dice_result").html(data);    
}

//CODE for ajax
//0 -- pull
//1 -- dice for normal use
//
function pullResult(){
    var jsonObj = new Object();
    jsonObj["code"] = 0;
    var json = JSON.stringify(jsonObj);
    var targetURL = "diceArena.php";
    $.post(targetURL, { dice: json }, function (data) {
        showResult(data);
    });
}
function diceBonus(diceReg,diceText){
    var jsonObj = new Object();
    jsonObj["code"] = 4;
    //alert(diceReg);
    for(var i=1;i<diceReg.length;i++){
        jsonObj["p"+i.toString()] = diceReg[i]; 
    }
    jsonObj["str"] = diceText;
    var json = JSON.stringify(jsonObj);
    //alert(json);
    var targetURL = "diceArena.php";
    $.post(targetURL, { dice: json }, function (data) {
        showResult(data);
    });   
    
}

function diceNormal(diceNum,diceSize,diceText){

        showMsg("投点已提交...请等待...");
        var jsonObj = new Object();
        jsonObj["code"] = 1;
        jsonObj["p1"] = diceNum;
        jsonObj["p2"] = diceSize;
        jsonObj["p3"] = diceText;
        //Database
        var json = JSON.stringify(jsonObj);
        //alert(json);
        var targetURL = "diceArena.php";
        $.post(targetURL, { dice: json }, function (data) {
            showResult(data);
        });
    
}

function diceDX(diceX,diceY,diceText){

        showMsg("投点已提交...请等待...");
        var jsonObj = new Object();
        jsonObj["code"] = 2;
        jsonObj["p1"] = diceX;
        jsonObj["p2"] = diceY;
        jsonObj["p3"] = diceText;
        //Database
        var json = JSON.stringify(jsonObj);
        //alert(json);
        var targetURL = "diceArena.php";
        $.post(targetURL, { dice: json }, function (data) {
            showResult(data);
        });
}

function diceCOC(diceText){

        showMsg("投点已提交...请等待...");
        var jsonObj = new Object();
        jsonObj["code"] = 3;
        jsonObj["p3"] = diceText;
        //Database
        var json = JSON.stringify(jsonObj);
        //alert(json);
        var targetURL = "diceArena.php";
        $.post(targetURL, { dice: json }, function (data) {
            showResult(data);
        });
}
        
function getName(){
        var name = $("#input_dice_name").val();
        name = $.trim(name);
        if(name.length>30){name = name.substr(0,30);}
        if(name.length==0){name ="某人";}
        return name;
}

var defaultDiceSize = 100;//COC

$(document).ready(function () {
    setInterval(pullResult, 8000);  
   
    $("#button_roll").click(function (e) {
        
        var code = $("#input_dice_code").val();
        code = $.trim(code);
        if(code.length>100){name = code.substr(0,100);}
        if(code.length ==0){
            showError(0);
            return;
        }else{
        }
 
        
               //Double Cross .dx优先判定 不然会被.r d覆盖
        var res =code.match(reDX);
        if(res != null){
            //alert(res);
            var diceX = toInt(res[1]);
            var diceY = toInt(res[2]);
            var diceName = res[3];
            
            if(diceX == 0 ){diceX = 1;}//默认1个骰子
            if(diceX >10000){diceX = 10000;}
            if(diceY == 0 ){diceY = 10;}//默认为10
            if(diceY >11){diceY = 1;}//最大为11 --无法暴击
            
            var diceText = getTime() +" " + getName() + " 投掷 "+ diceName+" "+diceX+"A"+diceY ;
            
            diceDX(diceX,diceY,diceText);//DX骰池
            
            return;
        }
        
        res = code.match(reDA);
        if(res != null){
            var diceText = getTime() +" " + getName() + " 投掷 "+ res[0] ;
            diceBonus(res,diceText);//带+/-的投掷
            return;
        }
        res =code.match(reD);
        //alert(res);
        //DND & COC
        if(res != null){
            var diceNum = toInt(res[1]);
            var diceSize = toInt(res[2]);
            var diceName = res[3];
            if(diceNum == 0 ){diceNum = 1;}//默认1个骰子
            if(diceSize == 0 ){diceSize = defaultDiceSize;}//默认骰面
            
            if(diceNum >100){diceNum = 100;}//上限100个骰子
            if(diceSize>10000){diceSize =10000;}//上限10000面骰
            var diceText = getTime() +" " + getName() + " 投掷 "+ diceName+" "+diceNum+"D"+diceSize ;
            diceNormal(diceNum,diceSize,diceText);//普通投点
            return;
        }
        
 
        
        showError(1);
    });

    $("#button_refresh").click(function (e) {
        pullResult();
    });
    
    $("#button_0").click(function (e) {
        var diceText = getTime() +" " + getName() + " 投掷 1D100" ;
        diceNormal(1,100,diceText);// 普通投点
    });
    $("#button_1").click(function (e) {
        var diceText = getTime() +" " + getName() + " 投掷 1D20" ;
        diceNormal(1,20,diceText);// 普通投点
    });
    $("#button_2").click(function (e) {
        var diceText = getTime() +" " + getName() + " 投掷 1D10" ;
        diceNormal(1,10,diceText);// 普通投点
    });
    $("#button_3").click(function (e) {
        var diceText = getTime() +" " + getName() + " 投掷 1D6" ;
        diceNormal(1,6,diceText);// 普通投点
    });
    $("#button_4").click(function (e) {
        var diceText = getTime() +" " + getName() + " 投掷 1D4" ;
        diceNormal(1,4,diceText);// 普通投点
    });
    $("#button_5").click(function (e) {
        var diceText = getTime() +" " + getName() + " 投掷 1D3" ;
        diceNormal(1,3,diceText);// 普通投点
    });
    $("#button_6").click(function (e) {
        var diceText = getTime() +" " + getName() + " 投掷 COC =" ;
        diceCOC(diceText);// COC属性
    });
    $("#button_7").click(function (e) {
        var diceText = getTime() +" " + getName() + " 投掷 COC =" ;
        for(var i=0;i<5;i++){
            diceCOC(diceText);
        }
    });
});



</script>

</html>