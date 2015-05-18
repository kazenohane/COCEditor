 <?php
//header('Access-Control-Allow-Origin: *');
//header('Access-Control-Allow-Methods: GET, POST');

function checkCard($items){

	return true;
}	
if(isset($_POST["card"])==true){
	$str = $_POST["card"];
	$mark = ">-";
	$items = explode($mark,$str);
	/*foreach($items as $item){
		echo $item;
	}*/
	if(!checkCard($items)){
		exit("建卡数据有误");
	}
	//echo("Check passed");
	
	
	$txt = "";
	$count = 0;
	foreach($items as $item){
		$txt = $txt . $item;
		if($count ==0){
			$txt = $txt . ":  ";
			$count = 1;
		}else{
			$txt = $txt . "\r\n";
			$count = 0;
		}
	}
	
	//echo $txt;
	
	$fr = fopen('./status/status.txt','r');
	if($fr){
		$count = (int)fgets($fr);
		fclose($fr);
	}
	//echo($count);
	$id = (string)($count + 1);
	$name = $items[1];
	
	//$name = iconv( "UTF-8", "gb2312//IGNORE" , $name);
	$txt = iconv( "UTF-8", "gb2312//IGNORE" , $txt);
	$name = str_replace(" ","_",$name); //去除空格
	$fileName = "./cards/" . $id . "_" . $name . ".txt";
	$link = "./cards/" . $id . "_" . $name . ".txt";
	

	
	echo("调查员Txt卡下载点这里 ->  <a href=\"".$link."\">[".$name."]</a>");
	$fw = fopen($fileName,'w');
	if($fw){
		echo("!\n");
		fwrite($fw, $txt);
		fclose($fw);
	}
	//echo("ha\n");
	$fws = fopen('./status/status.txt','w');
	if($fws){
	//	echo("\n!!");
		fwrite($fws, $id);
		fclose($fws);
	}else{
		echo("系统错误");
	}
	
	/*
	$con = mysql_connect("localhost","coc","coc_database");
	if(!$con){
		exit('Could not connect: ' . mysql_error());
	}
	echo ("successful");
	mysql_select_db("coc_db", $con); 
	$sql = "CREATE TABLE card(";
	for ($i = 0;$i<81;$i++){}*/
	/*$sql = "CREATE TABLE Persons 
			(
			FirstName varchar(15),
			LastName varchar(15),
			Age int
			)";
	mysql_query($sql,$con);*/
	mysql_close($con);
	
	
	
}else{
	echo "error";
}









?>
