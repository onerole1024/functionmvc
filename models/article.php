<?php


function arlists($uid){
  $conn = db_connect();
  $result = $conn->query("select * from article where uid=".$uid);
  if (!$result) {
    return false;
  }

  $articles = array();
  while ($row = $result->fetch_assoc()) {
    $articles[] =$row;
  }
  $conn->close();
  return $articles;

}




?>