<?php
include_once ('mvc.php');
include_once ('tool.php');
session_start();

if(isset($_GET['c']) && $_GET['c']){
  $control = $_GET['c'];
  unset($_GET['c']);
}else{
  $control ='welcome';
}


if(isset($_GET['a']) && $_GET['a']){
  $action = $_GET['a'];
  unset($_GET['a']);
}else{
  $action ='index';
}


try{
  make($control,$action);
}catch(Exception $e){
  make('error','index',array('except'=>$e));
}




?>