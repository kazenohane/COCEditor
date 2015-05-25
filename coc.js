/*!
* @projectDescription Call of Cthulhu Character Builder
* @author Fengyu
* @version 1.1
*/

/*
<div id="div_menu">
<div class="div_menu_item">
<p class="menu_name">在线建卡</p>
</div>
<div class="div_menu_item">
<p class="menu_name">跑团检定</p>
</div>
<div class="div_menu_item">
<p class="menu_name">怪物速查</p>
</div>
</div>
*/
function onlyNum(obj) {
    obj.value = obj.value.replace(/\D/g, '');
}

function toInt(text) {
    var res = parseInt(text);
    if (isNaN(res)) { res = 0; }
    return res;
}
function getSkillID(idText) {
    var id = 0;
    for (var i = 0; i < idText.length; i++) { //Only fits format 'xxx_xxx_xx_123'
        if (idText[i] >= '0' && idText[i] <= '9') {
            id = id * 10;
            id += (idText[i] - '0');
        }
    }
    return id;
}


function updateSkillPoints(idText) {
    var total = toInt($("#skill_initial_" + idText).val())
				+ toInt($("#skill_occupation_" + idText).val())
				+ toInt($("#skill_interest_" + idText).val());
    if (total > 100) { total = 100 };
    $("#skill_total_" + idText).val(total.toString());
}

var interestLeft = 0;
var occupationLeft = 0;
function updateOccupationPoints() {
    var prefix = "#skill_occupation_";
    var count = toInt($("#value_7").val());
    for (var j = 0; j < skills.length; j++) {
        count -= toInt($("#skill_occupation_" + skills[j][0].toString()).val());
    }
    occupationLeft = count;
    $(".label_occupation_points").html('剩余职业点数： <span class="span_bold span_green">' + count.toString() + '</span>');
}


function updateInterestPoints() {
    var prefix = "#skill_interest_";
    var count = toInt($("#value_8").val());
    for (var j = 0; j < skills.length; j++) {
        count -= toInt($("#skill_interest_" + skills[j][0].toString()).val());
    }
    interestLeft = count;
    $(".label_interest_points").html('剩余兴趣点数： <span class="span_bold span_green">' + count.toString() + '</span>');
}

function pointInput(obj) {
    onlyNum(obj);
    var idNum = getSkillID(obj.id);
    if (idNum < 7) {
        if (obj.value < 3 || obj.value > 18) {
            obj.value = 11;
        }
    } else if (idNum == 7) {
        if (obj.value < 6 || obj.value > 27) {//考虑到教育随年龄增长的规则
            obj.value = 14;
        }
    } else if (idNum == 8) {
        if (obj.value < 1 || obj.value > 10) {
            obj.value = 6;
        }
    } else {
        if (obj.value < 0 || obj.value > 99) {
            obj.value = 0;
        }    
    }
    updateValues();
}

function occupationSkillInput(obj) {
    onlyNum(obj);
    var idNum = getSkillID(obj.id);
    var idText = idNum.toString();
    updateSkillPoints(idText);
    var occupationID = document.getElementById("select_occupations").selectedIndex;

    if (occupationID == -1) {
        $(".label_occupation_info_error").html('<span class="span_bold span_red">请先选择职业</span>');
        return;
    }
    updateOccupationPoints();

    var profession_skills = occupations[occupationID][1];

    for (var j = 0; j < profession_skills.length; j++) {
        if (profession_skills[j] == idNum) {
            return; //No need to check skills
        }
    }

    var elective_number = occupations[occupationID][2];
    var elective_skills = occupations[occupationID][3];
    var count = 0;
    for (var j = 0; j < skills.length; j++) {
        if (toInt($("#skill_occupation_" + skills[j][0].toString()).val()) != 0) { count += 1; }
    }
    for (var j = 0; j < profession_skills.length; j++) {
        if (toInt($("#skill_occupation_" + profession_skills[j].toString()).val()) != 0) { count -= 1; }
    }
    $(".label_occupation_info_check").html("已选择 " + count.toString() + " 个任选职业技能");

    if (count > elective_number) {
        $(".label_occupation_info_error").html('<span class="span_bold span_red">任选的职业技能超过规定</span>');
    } else {
        $(".label_occupation_info_error").html("");
    }
    if (elective_skills.length != 0) {
        var countValid = 0;
        for (var j = 0; j < elective_skills.length; j++) {
            if (toInt($("#skill_occupation_" + elective_skills[j].toString()).val()) != 0) { countValid += 1; }
        }
        if (countValid != count) {
            $(".label_occupation_info_error").html('<span class="span_bold  span_red">选择了不被允许的职业技能</span>');
        }
    }

    updateOccupationPoints();
}

function interestSkillInput(obj) {
    onlyNum(obj);
    var idText = getSkillID(obj.id).toString();
    updateSkillPoints(idText);
    updateInterestPoints()
}
function changeOccupation(obj) {
    var occupation_id = document.getElementById("select_occupations").selectedIndex;
    if (occupation_id == -1) {
        return;
    }
    var profession_skills = occupations[occupation_id][1];
    var elective_number = occupations[occupation_id][2];
    var elective_skills = occupations[occupation_id][3];
    var id_root = "#label_skill_";
    
    //Reset all skills' css  将颜色变回原状，便于之后赋值
    for (var j = 1; j < skills.length+1; j++) {
        $(id_root + j.toString()).css("color", "#000");
        $(id_root + j.toString()).css("font-weight", "normal");
    }

    //Set professional skills
    for (var j = 0; j < profession_skills.length; j++) {
        //Set custom skills
        if (profession_skills[j] == 59 || profession_skills[j] == 60 || profession_skills[j] == 61) {
            $(id_root + profession_skills[j].toString()).val("艺术");
        }
        if (profession_skills[j] == 62 || profession_skills[j] == 63 || profession_skills[j] == 64) {
            $(id_root + profession_skills[j].toString()).val("手艺");
        }
        if (profession_skills[j] == 65 || profession_skills[j] == 66 || profession_skills[j] == 67) {
            $(id_root + profession_skills[j].toString()).val("外语");
        }

        $(id_root + profession_skills[j].toString()).css("color", "blue");
        $(id_root + profession_skills[j].toString()).css("font-weight", "bold");
    }
    var info_msg = '';
    if (elective_skills.length == 0) {
        info_msg = '允许从 <span class="span_bold span_black">黑色</span> 技能中选择 ' + elective_number + ' 个作为职业技能';
    } else {
        info_msg = '允许从 <span class="span_bold span_green">绿色</span> 技能中选择 ' + elective_number + ' 个作为职业技能';
        for (var j = 0; j < elective_skills.length; j++) {
            $(id_root + elective_skills[j].toString()).css("color", "green");
            $(id_root + elective_skills[j].toString()).css("font-weight", "bold");
        }
    }

    //医生
    if (occupation_id == 7) {
        $("#label_skill_65").val("拉丁文");
    }
    $(".label_occupation_info").html(info_msg);

    updateOccupationPoints();
}
var skills = new Array(
[50, "侦查", 25],
[29, "图书馆利用", 25],
[13, "闪躲", -1],
[30, "聆听", 25],
[17, "快速交谈", 5],
[33, "武术", 1],
[31, "钳工", 1],
[40, "劝说", 15],
[22, "手枪", 20],
[14, "驾车/马术", 20],
[11, "信誉度", 15],
[19, "拳击/厮打", 50],
[24, "躲藏", 10],
[38, "神秘学", 5],
[21, "擒抱", 25],
[49, "潜行", 10],
[45, "心理学", 5],
[27, "踢", 25],
[12, "乔装", 1],
[9, "电脑使用", 1],
[26, "跳跃", 25],
[10, "藏匿", 15],
[35, "医学", 5],
[8, "攀爬", 40],
[54, "跟踪", 10],
[18, "急救", 30],
[53, "投掷", 25],
[55, "母语", -1],
[44, "心理分析", 1],
[3, "考古学", 1],
[65, "外语:", 1],
[66, "外语:", 1],
[67, "外语:", 1],
[68, "其他:", 0],
[69, "其他:", 0],
[70, "其他:", 0],
[1, "会计学", 10],
[2, "人类学", 1],
[4, "天文学", 1],
[5, "议价", 5],
[6, "生物学", 1],
[7, "化学", 1],
[15, "电器维修", 10],
[16, "电子学", 1],
[20, "地理学", 1],
[23, "头顶", 10],
[25, "历史", 20],
[28, "法律", 5],
[32, "机关枪", 15],
[34, "机器维修", 20],
[36, "自然史", 10],
[37, "领航", 10],
[39, "重型机械", 1],
[41, "药剂学", 1],
[42, "摄影", 10],
[43, "物理", 1],
[46, "骑术", 5],
[47, "来复枪", 25],
[48, "霰弹枪", 30],
[51, "冲锋枪", 15],
[52, "游泳", 25],
[57, "驾驶:", 1],
[58, "驾驶:", 1],
[59, "艺术:", 5],
[60, "艺术:", 5],
[61, "艺术:", 5],
[62, "手艺:", 5],
[63, "手艺:", 5],
[64, "手艺:", 5],
[56, "克苏鲁神话", 0]
)
var infoName = new Array('姓名', '玩家', '姓别', '年龄', '国籍', '母语', '职业')
var pointName = new Array('力量', '体质', '意志', '敏捷', '外表', '体型', '智力', '教育', '财产',"克苏鲁神话")
var valueName = new Array('生命值', '魔法值', '心智值', '灵感', '幸运', '理智', '知识', '职业点', '兴趣点', '伤害加值')
var skill_initial = new Array(10, 1, 1, 1, 5, 1, 1, 40, 1, 15, 15, 1, -1, 20, 10, 1, 5, 30, 50, 1, 25, 20, 10, 10, 20, 25, 25, 5, 25, 25, 1, 15, 1, 20, 5, 10, 10, 5, 1, 15, 1, 10, 1, 1, 1, 1, 1, 5, 5, 25, 30, 10, 25, 15, 25, 25, 10, -1, 0, 5, 5, 5, 5, 5, 5, 1, 1, 1, 0, 0, 0);
var special_skill_id = new Array(57, 58, 59, 60, 61, 62, 63, 64, 65, 66, 67, 68, 69, 70, 71)
var occupations = new Array(
['古董商人', [59, 60, 61, 5, 62, 63, 64, 25, 29, 65, 66, 67, 50], 1, []],
['艺术家', [59, 60, 61, 62, 63, 64, 17, 25, 42, 45, 50], 1, []],
['运动员', [8, 13, 26, 33, 46, 52, 53], 1, []],
['作家', [25, 29, 38, 65, 66, 67, 55, 40, 45], 1, []],
['牧师', [1, 25, 29, 30, 65, 66, 67, 40, 45], 1, []],
['罪犯', [5, 12, 17, 22, 31, 49, 50], 1, []],
['业余艺术爱好者', [59, 60, 61, 62, 63, 64, 11, 65, 66, 67, 46, 48], 2, []],
['医生', [6, 11, 18, 65, 35, 41, 44, 45], 1, []], //其他语言：拉丁文
['流浪者', [5, 17, 24, 30, 36, 45, 49], 1, []],
['工程师', [7, 15, 20, 29, 34, 39, 43], 1, []],
['艺人', [59, 60, 61, 11, 12, 13, 17, 30, 45], 1, []],
['农夫/伐木工', [62, 63, 64, 15, 18, 34, 36, 39, 54], 1, []],
['黑客/顾问', [9, 15, 16, 17, 29, 65, 66, 67, 43], 1, []],
['记者', [17, 25, 29, 55, 40, 42, 45], 1, []],
['律师', [5, 11, 17, 28, 29, 40, 45], 1, []],
['军官', [1, 5, 11, 28, 37, 40, 45], 1, []],
['传教士', [59, 60, 61, 62, 63, 64, 18, 34, 35, 36, 40], 1, []],
['音乐家', [59, 60, 61, 5, 62, 63, 64, 17, 30, 40, 45], 1, []],
['心理学家', [2, 25, 29, 38, 65, 66, 67, 42, 45], 1, []],
['飞机轮船驾驶员', [4, 15, 34, 37, 39, 43, 57, 58], 1, []],
['警方侦探', [5, 17, 28, 30, 40, 45, 50], 1, []],
['警察', [13, 17, 18, 21, 28, 45], 2, [5, 14, 33, 46, 50]],
['私家侦探', [5, 17, 28, 29, 31, 42, 45], 1, []],
['教授', [5, 11, 29, 65, 66, 67, 40, 45], 2, [2, 3, 4, 6, 7, 16, 20, 25, 28, 35, 36, 43]],
['士兵', [13, 18, 24, 30, 34, 47, 49], 1, []],
['发言人', [11, 12, 13, 17, 40, 45], 1, []],
['部落成员', [5, 30, 36, 38, 50, 52, 53], 1, []],
['狂热者', [10, 24, 29, 40, 45], 2, [7, 15, 28, 41, 47]],
['自定义',[],70,[]]
)
var jsonName = new Array("cName", "cPlayer", "cGender", "cAge", "cNationality", "cLanguage", "cOccupation", "cSTR", "cCON", "cPOW", "cDEX", "cAPP", "cSIZ", "cINT", "cEDU", "cMoney","cCthulhuMythos", "cHP", "cMP", "cSanity", "cWeapon", "cItem", "cBackground", "cImage", "cTime", "cExperience");
function initializeSkill() {
    var innerHTML = "";
    var innerHTML_1 = "";
    var innerHTML_2 = ""; //For skill page 2
    //Title

    innerHTML += '\
		<div class="row">\
			<div class="col-xs-12 col-sm-12 col-md-1">\
			</div>\
			<div class="col-xs-12 col-sm-12 col-md-1"><p class="label_name">技能</p></div>\
			<div class="col-xs-12 col-sm-12 col-md-2">\
				<div class = "div_skill_input">\
					<p class="label_name input_skills">初始</p>\
					<p class="label_name input_skills">职业</p>\
					<p class="label_name input_skills">兴趣</p>\
					<p class="label_name input_skills">合计</p>\
				</div>\
			</div>\
			<div class="col-xs-12 col-sm-12 col-md-1"><p class="label_name">技能</p></div>\
			<div class="col-xs-12 col-sm-12 col-md-2">\
				<div class = "div_skill_input">\
					<p class="label_name input_skills">初始</p>\
					<p class="label_name input_skills">职业</p>\
					<p class="label_name input_skills">兴趣</p>\
					<p class="label_name input_skills">合计</p>\
				</div>\
			</div>\
			<div class="col-xs-12 col-sm-12 col-md-1"><p class="label_name">技能</p></div>\
			<div class="col-xs-12 col-sm-12 col-md-2">\
				<div class = "div_skill_input">\
					<p class="label_name input_skills">初始</p>\
					<p class="label_name input_skills">职业</p>\
					<p class="label_name input_skills">兴趣</p>\
					<p class="label_name input_skills">合计</p>\
				</div>\
			</div>\
		</div>\
	';
    innerHTML_2 += innerHTML;

    for (var j = 0; j < skills.length; j++) {
        if (skills[j][0] == 56) { continue; } //克苏鲁神话技能单列
        if (j == 36) {
            innerHTML_1 = innerHTML;
            innerHTML = innerHTML_2;
        }
        if (j % 3 == 0) {  // 新建行 & 插入空行
            innerHTML += '<div class="row">\
			<div class="col-xs-12 col-sm-12 col-md-1">\
			</div>';
        }
        var special_skill = false;
        for (var k = 0; k < special_skill_id.length; k++) {
            if (skills[j][0] == special_skill_id[k]) {
                innerHTML += '<div class="col-xs-12 col-sm-12 col-md-1">\
				<input type="text"  class="form-control input_custom_skills input_skills "' + ' placeholder="' + skills[j][1].toString() + '" id="label_skill_' + skills[j][0].toString() + '"></input>';
                special_skill = true;
            }
        }
        if (special_skill == false) {
            innerHTML += '			<div class="col-xs-12 col-sm-12 col-md-1">\
			<p class="label_name label_skill" id="label_skill_' + skills[j][0].toString() + '">'
			+ skills[j][1] +
			'</p>';
        }

        innerHTML += ('</div>\
			<div class="col-xs-12 col-sm-12 col-md-2">\
				<div class = "div_skill_input">\
					<input type="text"  class="form-control input_skills input_no_border" readonly="readonly"'
					+ 'value="' + skills[j][2] + '" id="skill_initial_' + skills[j][0].toString() + '"></input>'
					+ '<input type="text"  class="form-control input_skills" onchange="occupationSkillInput(this);" style="ime-mode:Disabled" placeholder="0"'
					+ ' id="skill_occupation_' + skills[j][0].toString() + '"></input>'
					+ '<input type="text"  class="form-control input_skills" onchange="interestSkillInput(this);" style="ime-mode:Disabled" placeholder="0"'
					+ ' id="skill_interest_' + skills[j][0].toString() + '"></input>'
					+ '<input type="text"  class="form-control input_skills input_no_border" readonly="readonly"'
					+ 'id="skill_total_' + skills[j][0].toString() + '"></input>\
				</div>\
			</div>');
        if (j % 3 == 2) {
            innerHTML += '</div>';
        }

    }
    innerHTML_2 = innerHTML;
    $("#div_skills").html(innerHTML_1);
    $("#div_skills_2").html(innerHTML_2);
    //Update total skill points
    for (var j = 0; j < skills.length; j++) {
        updateSkillPoints(skills[j][0].toString());
    }

    //其他技能 初始应当可以修改
    $("#skill_initial_68").removeAttr('readonly');
    $("#skill_initial_69").removeAttr('readonly');
    $("#skill_initial_70").removeAttr('readonly');

    //
}

function initializeOccupation() {
    var innerHTML = "";
    for (var j = 0; j < occupations.length; j++) {
        innerHTML += ('<option>' + occupations[j][0] + '</option>\n');
    }
    $("#select_occupations").html(innerHTML);
    document.getElementById("select_occupations").selectedIndex = -1; // Show blank in state option	

}



function createCard() {
    var infoPrefix = "#info_";
    var pointPrefix = "#point_";
    var valuePrefix = "#value_";
    var skillPrefix = "#skill_total_";
    var txtText = "";
    var data = "";
    var mark = ">-";
    var jsonObj = new Object();
    //Name Check
    if ($("#info_0").val() == "") {
        $("#div_link").html("调查员不能没有名字！");
        return false;
    }
    if ($("#info_1").val() == "") {
        $("#div_link").html("请填入玩家名字！");
        return false;
    }
    if ($("#info_6").val() == "") {
        $("#div_link").html("请在个人信息里填写职业！");
        return false;
    }
    if (document.getElementById("select_occupations").selectedIndex == -1) {
        $("#div_link").html("调查员必须选择一项职业模板！");
        return false;
    }
    if (occupationLeft < 0) {
        $("#div_link").html("请注意职业技能点数的分配不能超过规定点数！");
        return false;
    }

    if (interestLeft < 0) {
        $("#div_link").html("请注意兴趣技能点数的分配不能超过规定点数！");
        return false;
    }
    for (var i = 0; i < infoName.length; i++) {
        var infoVal = $(infoPrefix + i.toString()).val();
        txtText += infoName[i] + ":  " + infoVal + "\n";
        data += (infoName[i] + mark + infoVal + mark);

        if (infoName[i] == "年龄") { infoVal = toInt(infoVal); }
        jsonObj[jsonName[i]] = infoVal;
    }


    txtText += "\n";
    for (var i = 0; i < pointName.length; i++) {
        var pointVal = $(pointPrefix + i.toString()).val();

        if (pointVal == "") {
            $("#div_link").html("调查员有属性空缺！");
            return false;
        }

        txtText += pointName[i] + ":  " + pointVal + "\n";
        data += (pointName[i] + mark + pointVal + mark);

        pointVal = toInt(pointVal);
        jsonObj[jsonName[infoName.length + i]] = pointVal;
    }

    txtText += "\n";
    for (var i = 0; i < valueName.length; i++) {
        var valueVal = $(valuePrefix + i.toString()).val();
        txtText += valueName[i] + ":  " + valueVal + "\n";
        data += (valueName[i] + mark + valueVal + mark);

    }

    txtText += "\n";
    var skill_name;
    var valid_skill = 1;
    for (var i = 0; i < skills.length; i++) {

        if (skills[i][0] == 56) { continue; } //克苏鲁神话技能不列在技能栏里
        skill_name = skills[i][1];
        valid_skill = 1;
        for (var k = 0; k < special_skill_id.length; k++) {
            if (skills[i][0] == special_skill_id[k]) {
                var special_name = $("#label_skill_" + skills[i][0].toString()).val();
                if (special_name == "") { valid_skill = 0; };
                skill_name += (" 【" + special_name + "】");
                jsonObj["cSkillName_" + skills[i][0]] = special_name;
                break;
            }
        }
        //if(valid_skill ==0){continue;}
        var skillVal = $(skillPrefix + skills[i][0].toString()).val();
        txtText += skill_name + ":  " + skillVal + "\n";
        data += (skill_name + mark + skillVal + mark);
        skillVal = toInt(skillVal);
        jsonObj["cSkill_" + skills[i][0]] = skillVal;

    }

    txtText += "\n" + $("#input_background").val() + "\n\n";
    txtText += $("#input_item").val() + "\n";

    data += "人物背景" + mark + $("#input_background").val() + mark;
    data += "携带物品" + mark + $("#input_item").val() + mark;

    jsonObj["cHP"] = toInt($("#value_0").val());
    jsonObj["cMP"] = toInt($("#value_1").val());
    jsonObj["cSanity"] = toInt($("#value_2").val());
    jsonObj["cWeapon"] = "";
    jsonObj["cItem"] = $("#input_item").val();
    jsonObj["cBackground"] = $("#input_background").val();
    jsonObj["cImage"] = "";
    jsonObj["cTime"] = "";
    jsonObj["cExperience"] = "";

    jsonObj["cNPC"] = $('#value_npc').is(':checked');

    //txtText = txtText.replace(/\n/g,"<br>");
    //$("#input_card").val(txtText);
    //$("#input_card").css("width", "100%");
    //$("#input_card").css("height", "200px");

    //Database
    var json = JSON.stringify(jsonObj);

    //alert(json);
    var targetURL = "createCard.php";
    $.post(targetURL, { card: json }, function (data) {
        $("#div_link").html(data);
    });
    /* deprecated -- using database json to generate txt now
        //TXT卡
        var targetURL = "create.php";
        $.post(targetURL, { card: data }, function (data) {

        }
        );
    */

    return true;
}

var rollMaxCount = 10;
var rollCount = 0;
var rollResult = new Array(9);
var rollResultArray = new Array(9 * rollMaxCount);
function getRandom(n) {
    return (Math.floor(Math.random() * 1000000)) % n+1;
}

function getButtonHtml(n) {
    var id = "button_roll_" + n;
    return "<button type=\"button\" id=\"" + id + "\" class=\"btn btn-success\" name = \"" + n + "\">选择</button>";
}
function fixNumberLength(num, n) {
    var str = num.toString();
    if (str.length < n);
    for (var i = 0; i < n - str.length; i++) {
        str += "&nbsp;&nbsp;";
    }
    return str;
}
//Show colors according to input number
function getSpanColorClass(n, flag) {
    if (flag == 0) {
        if (n >= 18 && flag == 0) { return "span_gold" };
        if (n < 7) { return "span_green"; }
        if (n > 14) { return "span_red"; }
        return "span_blue";
    }
    if (flag == 1) {
        if (n >= 18 && flag == 0) { return "span_gold" };
        if (n < 12) { return "span_green"; }
        if (n > 14) { return "span_red"; }
        return "span_blue";
    }

    if (flag == 2) {
        if (n >= 21 && flag == 0) { return "span_gold" };
        if (n < 10) { return "span_green"; }
        if (n > 17) { return "span_red"; }
        return "span_blue";
    }
}

function updateValues() {
    var str = "";

    var hp = parseInt((toInt($("#point_1").val()) + toInt($("#point_5").val()) + 0.5) / 2); //HP = CON+SIZ/2
    var mp = toInt($("#point_2").val()); //MP = POW
    var san = toInt($("#point_2").val()) * 5; //SAN = POW*5
    var sanityPoints = san; //Sanity points begin as equal to SAN
    var maxSanityPoints = 100 - toInt($("#point_9").val());
    if (sanityPoints > maxSanityPoints) { sanityPoints = maxSanityPoints; } //Sanity points <= 100 - Cthulhu Mythoes

    var luck = toInt($("#point_2").val()) * 5; //LUCK = POW*5
    var idea = toInt($("#point_6").val()) * 5; //IDEA = INT*5
    var know = toInt($("#point_7").val()) * 5; //KNOW = EDU * 5
    if (know > 100) { know = 100; } //MAX 100
    var occupation_points = toInt($("#point_7").val()) * 20; //Occupation points = EDU * 20
    var interest_points = toInt($("#point_6").val()) * 10; //Personal interest points  = INT * 10

    //Damage Bonus
    var str_siz = toInt($("#point_0").val()) + toInt($("#point_5").val());
    var damage_bonus = "-1D6";
    if (str_siz > 12) { damage_bonus = "-1D4"; }
    if (str_siz > 16) { damage_bonus = "0"; }
    if (str_siz > 24) { damage_bonus = "1D4"; }
    if (str_siz > 32) { damage_bonus = "1D6"; }
    if (str_siz > 40) { damage_bonus = "2D6"; }
    if (str_siz > 56) { damage_bonus = "3D6"; }
    if (str_siz > 72) { damage_bonus = "4D6"; }
    if (str_siz > 88) {
        var n = (str_siz - 88) / 16 + 1 + 4;
        damage_bonus = n.toString() + "D6";
    }

    $("#value_0").val(hp);
    $("#value_1").val(mp);
    $("#value_2").val(sanityPoints);
    $("#value_3").val(idea);
    $("#value_4").val(luck);
    $("#value_5").val(san);
    $("#value_6").val(know);
    $("#value_7").val(occupation_points);
    $("#value_8").val(interest_points);
    $("#value_9").val(damage_bonus);
    $("#value_10").val(toInt($("#point_7").val()) +6);//EDU+6

    //Show skill table
    //initializeSkill();
    //initializeOccupation();

    var dodge = toInt($("#point_3").val()) * 2; //DEX*2
    var own_language = toInt($("#point_7").val()) * 5; //EDU*5
    if (own_language > 100) { own_language = 100; } //MAX 100
    $("#skill_initial_13").val(dodge);
    $("#skill_initial_55").val(own_language);

    //Update total skill points
    for (var j = 0; j < skills.length; j++) {
        updateSkillPoints(skills[j][0].toString());
    }

    //Update occupation points and interest points left
    updateOccupationPoints();
    updateInterestPoints();
}
function selectRoll(p) {
    var offset = parseInt(p, 10) * 9;
    var str = "";
    var pointer = "#point_";
    for (var j = 0; j < 9; j++) {
        str += " " + rollResultArray[offset + j];
        var p = pointer + j.toString();
        $(p).val(rollResultArray[offset + j]);
    }
    updateValues();

    $("#point_9").val("0"); //初始化克苏鲁神话点数

    $("#div_roll").hide(); //清除投点结果
    if (autoScroll) {
        scrollDown(); //移动到下一页
    }
}

var autoScroll = true; //自动滚动模式,开启自动滚动时，每次滚动一页
var currentPage = 1;
var MIN_PAGE = 1;
var MAX_PAGE = 6;
var canScroll = true; //滚动锁：当前是否在自动滚动中
var canEditPoints = false; //角色属性锁：是否允许编辑属性

function scrollToPage(pi) {
    if (canScroll) {
        canScroll = false;
        $(window).scrollTo($(".div_page").height() * (pi - 1), 300, { onAfter: function () { canScroll = true; } });
        currentPage = pi;
        changeDot(currentPage);
    }
}
function scrollUp() {
    if (canScroll && currentPage > MIN_PAGE) {
        canScroll = false;
        $(window).scrollTo($(".div_page").height() * (currentPage - 2), 300, { onAfter: function () { canScroll = true; } });
        currentPage--;
        changeDot(currentPage);
    }
}

function scrollDown() {
    if (canScroll && currentPage < MAX_PAGE) {
        canScroll = false;
        $(window).scrollTo($(".div_page").height() * currentPage, 300, { onAfter: function () { canScroll = true; } });
        currentPage++;
        changeDot(currentPage);
    }
}
function changeDot(pi) {
    for (var i = 0; i < MAX_PAGE; i++) {
        $("#dot_" + (i + 1).toString()).removeClass("active");
    }
    $("#dot_" + (pi).toString()).addClass("active");
}

function pageResize() {

    if ($(window).width() < 992) {
        $(".div_page").css("height", "auto");
        autoScroll = false;
        $("html").css("overflow-y", "visible"); //去除竖直滚动条
        $("#div_indicator").hide();
    } else {
        autoScroll = true;
        scrollToPage(currentPage); //滚动到当前页面顶端
        $("html").css("overflow-y", "hidden"); //去除竖直滚动条
        if ($(window).height() < 765) {
            $(".div_page").css("height", 768); //在初始化技能页面后执行
        } else {
            $(".div_page").css("height", $(window).height());
        }
        $("#div_indicator").show();
    }
    $(".div_page").width($(window).width())
    //当窗口宽度过小时，调整那些固定宽度的元素，
    if ($(window).width() < $("#div_info").width()) {
        $("#div_info").css("width", "100%");
        $("#div_points").css("width", "100%");
    }
    //当窗口长度过小时，调整部分元素大小使得它们适应屏幕
    /*if($(window).height()<765){
    //	$("body").css("font-size","13.5px");
    //	$(".form-control").css("font-size","13.5px");
    $(".label_name").css("height","30px");
    $(".input_skills").css("height","34px");
    $(".btn").css("padding","3px 8px");
    }*/

}
//Activated when window size is changed
$(window).resize(function () {
    pageResize();
});
$(document).ready(function () {
    //$("#div_info").hide();
    //$("#div_points").hide();
    $("#input_card").hide();

    initializeSkill();
    initializeOccupation();

    $("input").attr("maxlength", 30)//Limit the maximum input.



    pageResize();



    $("#button_submit").click(function (e) {

        $("#div_link").val("");
        $("#div_link").show();
        if (createCard() == true) {
          //  $("#input_card").show();
          //  $("#input_card").focus();
          //  $("#input_card").select();
        }

    })
    $("#button_dice").click(function (e) {
        var num = parseInt($("#input_dice_num").val(), 10);
        var range = parseInt($("#input_dice_range").val(), 10);
        if (isNaN(num)) { num = 1; }
        if (isNaN(range)) { range = 100; }
        var res = 0;
        for (var i = 0; i < num; i++) {
            res += getRandom(range);
        }
        var today = new Date();
        var h = today.getHours();
        var m = today.getMinutes();
        var s = today.getSeconds();

        res = "投掷结果  " + num.toString() + " D " + range.toString() + "&nbsp&nbsp = &nbsp&nbsp<span class='span_bold span_gold'>" + res + "</span>"
	+ "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp"
	+ "投掷时间 " + h.toString() + ":" + m.toString() + ":" + s.toString() + "";
        $("#div_dice").html(res);
        $("#input_dice_num").val("");
        $("#input_dice_range").val("");
    })

    $("#button_roll").click(function (e) {
        var num = parseInt($("#input_roll").val(), 10);

        if (isNaN(num)) {
            num = 5;
        }


        if (rollCount > rollMaxCount) { return; }

        if (num > rollMaxCount - rollCount) {
            num = rollMaxCount - rollCount;
        }



        var rollHtml = $("#div_roll").html();
        for (var i = 0; i < num; i++) {
            for (var j = 0; j < 5; j++) {
                rollResult[j] = getRandom(6) + getRandom(6) + getRandom(6);
            }
            for (var j = 0; j < 2; j++) {
                rollResult[j + 5] = getRandom(6) + getRandom(6) + 6; 	//体型，智力
            }
            rollResult[7] = getRandom(6) + getRandom(6) + getRandom(6) + 3; //教育	
            rollResult[8] = getRandom(10); //财产	
            var singleHTML =
			"力量STR " + "&nbsp;&nbsp;<span class=\"span_bold " + getSpanColorClass(rollResult[0], 0) + "\">" + fixNumberLength(rollResult[0], 2) + "</span>&nbsp;&nbsp; " +
			"体质CON " + "&nbsp;&nbsp;<span class=\"span_bold " + getSpanColorClass(rollResult[1], 0) + "\">" + fixNumberLength(rollResult[1], 2) + "</span>&nbsp;&nbsp; " +
			"意志POW " + "&nbsp;&nbsp;<span class=\"span_bold " + getSpanColorClass(rollResult[2], 0) + "\">" + fixNumberLength(rollResult[2], 2) + "</span>&nbsp;&nbsp; " +
			"敏捷DEX " + "&nbsp;&nbsp;<span class=\"span_bold " + getSpanColorClass(rollResult[3], 0) + "\">" + fixNumberLength(rollResult[3], 2) + "</span>&nbsp;&nbsp; " +
			"外表APP " + "&nbsp;&nbsp;<span class=\"span_bold " + getSpanColorClass(rollResult[4], 0) + "\">" + fixNumberLength(rollResult[4], 2) + "</span>&nbsp;&nbsp; " +
			"体型SIZ " + "&nbsp;&nbsp;<span class=\"span_bold " + getSpanColorClass(rollResult[5], 1) + "\">" + fixNumberLength(rollResult[5], 2) + "</span>&nbsp;&nbsp; " +
			"智力INT " + "&nbsp;&nbsp;<span class=\"span_bold " + getSpanColorClass(rollResult[6], 1) + "\">" + fixNumberLength(rollResult[6], 2) + "</span>&nbsp;&nbsp; " +
			"教育EDU " + "&nbsp;&nbsp;<span class=\"span_bold " + getSpanColorClass(rollResult[7], 2) + "\">" + fixNumberLength(rollResult[7], 2) + "</span>&nbsp;&nbsp; " +
			"财产 $  " + "&nbsp;&nbsp;<span class=\"span_bold " + getSpanColorClass(10, 0) + "\">" + fixNumberLength(rollResult[8], 2) + "</span>&nbsp;&nbsp; ";
            rollHtml += "<p>" + singleHTML + getButtonHtml(rollCount + i) + "</p>";
            var offset = (rollCount + i) * 9;
            for (var j = 0; j < 9; j++) {
                rollResultArray[offset + j] = rollResult[j];
            }
        }
        rollCount += num;
        $("#div_roll").html(rollHtml);
        for (var i = 0; i < rollCount; i++) {
            var id = "button_roll_" + i;
            $("#" + id).click(function () {
                selectRoll($(this).attr("name"));
            });
        }
        $("#div_roll").show();
    })

    $("#button_clear").click(function (e) {
        rollCount = 0;
        $("#div_roll").html("");
    })

    $("#button_lock").click(function (e) {
        if (!canEditPoints) {
            for (var i = 0; i < pointName.length; i++) {
                $("#point_" + i.toString()).removeAttr('readonly');
            }
            canEditPoints = true;
            $("#button_lock").text("关闭属性编辑");
        } else {
            for (var i = 0; i < pointName.length; i++) {
                $("#point_" + i.toString()).attr('readonly', 'readonly');
            }
            canEditPoints = false;
            $("#button_lock").text("打开属性编辑");
        }
    })
    
    $(".dot").click(function (e) {
        var dotID = $(this).attr("id");
        var pageNum = parseInt(dotID[4]);
        scrollToPage(pageNum);
    })

    $(window).bind("DOMMouseScroll", function (e) {//FIREFOX
        if (!autoScroll) { return; }

        if (e.originalEvent.detail < 0) {
            //	scrollUp();
        }
        else {
            //	scrollDown();
        }
    });


    $(window).bind("mousewheel", function (e) {
        if (!autoScroll) { return true; }

        if (e.originalEvent.wheelDelta > 0 || e.detail < 0) {
            scrollUp();
        }
        else {
            scrollDown();
        }
    });

});

