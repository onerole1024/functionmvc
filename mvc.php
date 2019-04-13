<?php

function make($control,$action,$data=array()){
    $url = './controls/'.$control.'.php';
    if (file_exists($url)) {
        include ($url);
        $action($control,$data);
    }else{
        throw new Exception('找不到该控制器',404);
    }

}

function show($url,$data=array()){
    $url = './views/'.$url.'.php';
    if (file_exists($url)) {
        if(count($data)){
            extract($data);
        }
        include ('./views/layout/header.php');
        include ($url);
        include ('./views/layout/foot.php');
    }else{
        throw new Exception('找不到该视图',404);
    }

}

function data($model){
    require_once ('db.php');
    $url = './models/'.$model.'.php';
    if (file_exists($url)) {
        include ($url);
    }else{
        throw new Exception('找不到该模型',404);
    }

}

?>