<?php

/**
 * common short summary.
 *
 * common description.
 *
 * @version 1.0
 * @author Fengyu
 */
 define("SQL_STRING",0);
 define("SQL_INT",1);
 
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
 ?>