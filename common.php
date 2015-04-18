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