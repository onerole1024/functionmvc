<?php

function db_connect() {
  $result = new mysqli('localhost', 'freeuser', 'free99', 'login');
  if (!$result) {
    throw new Exception('连接不上数据库');
  } else {
    return $result;
  }
}
/*$res = db_connect();
var_dump($res);*/


?>