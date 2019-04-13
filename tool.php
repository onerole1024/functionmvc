<?php

function url($href,$title) {
 return '<a href="'.htmlspecialchars($href).'">'.$title.'</a>';
}

function isAjax(){
  if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
      strtolower($_SERVER['HTTP_X_REQUESTED_WITH'])=='xmlhttprequest'
  ) {

    return true;

  }else{
    return false;
  }
}

function returnData($data){
  $output =json_encode($data);
  //ob_clean();
  header("HTTP/1.0 200 OK");
  header('Content-type: text/json; charset=utf-8');
  header('Content-Length: ' . strlen($output));
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache");
  echo $output;
}

?>