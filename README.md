该项目文件结构简单，根据MVC设计思想，使用函数式编程，未使用类和面向对象编程，简化框架结构，轻量展示MVC编程结构。使用原生php，实现注册、登录和笔记列表展示，[可以加深session cookie工作原理的理解](https://www.jianshu.com/p/9c2f4063c862)。

项目源码：https://github.com/onerole1024/learnmvc.git

![mvc.jpg](https://upload-images.jianshu.io/upload_images/13253304-4d9259b4fa099394.jpg?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

> index.php 是入口文件

引入使用mvc结构的函数和工具【公共】函数，并接收参入的参数c和a代表请求的控制器和动作方法，然后调用make函数调用控制器下的某个控制器中的某个方法处理这次请求。

```
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
```
> controls文件夹包含了所有控制器，welcome.php是默认控制器，该控制器只有一个index方法，只设置了下页面title，然后调用show方法，渲染views目录下的视图。

```
<?php

function index($control,$data){
    $data['pageTitle'] = '欢迎';
    show($control.'/index',$data);
}


?>
```
> views文件夹里面都是视图文件，文件夹的命名为控制器的名称，方便管理。如何将控制器中的变量渲染到视图文件使用了一个函数extract($data);以下是welcome.php控制器中index方法渲染的视图文件index.php

```
欢迎来学习这个小小记事本项目，<?php echo url('./?c=user&a=reg','注册');?>之后才可以查看自己的记事本<br/>
已有账户，<?php echo url('./?c=user&a=login','登录');?>查看
```
> 视图的头部和脚部都不在每个视图文件中，而在layout文件夹中，只要一前一后include 进来就可以实现将每个页面公共一样的部分提取出来，方便管理。

> welcome.php控制器中没什么逻辑处理，但像user.php或者article.php控制器，需要对数据库进行操作，我们借助models文件夹下的相应model来实现具体数据库操作。例如article.php，我们使用mvc.php文件中的data方法实现db.php数据库连接函数文件引入和models下相应model文件引入。

```
function data($model){
    require_once ('db.php');
    $url = './models/'.$model.'.php';
    if (file_exists($url)) {
        include ($url);
    }else{
        throw new Exception('找不到该模型',404);
    }

}
```


```
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
```

> 采用try catch 捕获异常，错误手动抛出异常【 throw new Exception('连接不上数据库');】，在入口文件中进行异常捕获，渲染错误页面，列出错误信息

```
try{
  make($control,$action);
}catch(Exception $e){
  make('error','index',array('except'=>$e));
}


错误码：<?php  echo $except->getCode();?><br/>
错误信息：<?php  echo $except->getMessage();?><br/>
错误文件：<?php  echo $except->getFile();?><br/>
错误行：<?php  echo $except->getLine();?>

```
