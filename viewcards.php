<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
 <?php
 function scan_dir($dir_name,$dir_flag=1) {
	
	@$dir_handle=opendir($dir_name);    
	if(!$dir_handle)
    die("目录打开错误！");
	while(false!==($filename=readdir($dir_handle)))  //文件名为‘0’时，readdir返回 FALSE，判断返回值是否不全等
	{                                   

		if($filename!='.'&&$filename!='..')
		{
			echo "<a href=".$dir_name.$filename.">".$filename."</a><br>";

		}
	}
	closedir($dir_handle);                 //关闭目录句柄
}

scan_dir('./cards/');

?>
</body>