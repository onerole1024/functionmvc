<?php
//对密码进行加密
function generatePasswordHash($password)
{
  //cost越高,服务器开销越大
  $cost = 13;

  if (function_exists('password_hash')) {

    return password_hash($password, PASSWORD_DEFAULT, ['cost' => $cost]);
  }else{
    echo "加密函数不支持,PHP 5 >= 5.5.0, PHP 7";
  }
}

/*$miwen =  generatePasswordHash('123456');
echo $miwen;
echo "*************";
echo strlen($miwen);
exit();*/


function newUser($user){
  //print_r($user);exit();
  $conn = db_connect();
  $result = $conn->query("select * from user where username='".$user['username']."' or email='".$user['email']."'");
  if (!$result) {
    throw new Exception('数据库操作失败');
  }

  if ($result->num_rows>0) {
    throw new Exception('已经被注册');
  }
  $passwd = generatePasswordHash($user['passwd']);

  $result = $conn->query("insert into user (`username`,`password`,`email`) values
                         ('".$user['username']."','".$passwd."' , '".$user['email']."')");
  if (!$result) {
    throw new Exception('注册失败');
  }
  $id = mysqli_insert_id ($conn);
  $conn->close();
  return  $id;
}


//按用户名or 邮箱 登录验证
function validUser($name,$pwd){
  $conn = db_connect();
  $result = $conn->query("select * from user where username='".$name."' or email='".$name."'");
  if (!$result) {
    throw new Exception('用户名或者密码错误');
  }
  $row = $result->fetch_object();
  $conn->close();
  //var_dump($row);
  if(!password_verify($pwd,$row->password)){
    throw new Exception('用户名或者密码错误');
  }
  return $row;
}

/*$validres = validUser('pipagg','123456');
var_dump($validres);exit();*/

//判断当前请求客户端是否登录
function hasLogin() {
  if (isset($_SESSION['me']))  {
   return $_SESSION['me'];
  }
  return false;
}

function loginme($name,$pwd){
  try{
    $validres = validUser($name,$pwd);
    $name = $validres->username;
    $_SESSION['me'] = $name;
    $_SESSION['meuid'] = $validres->uid;
    return array('success'=>true,'message'=>'登录成功','data'=>'');
  }catch(Exception $e){
    return array('success'=>false,'message'=>$e->getMessage(),'data'=>'');
  }
}


?>