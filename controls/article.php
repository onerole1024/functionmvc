<?php

function lists($control,$data){
    data('user');
    if(!hasLogin()){
    header("location:./?c=welcome&a=index");
}
    $data['pageTitle'] = '笔记列表';
    data('article');
    $data['articles'] = arlists($_SESSION['meuid']);
    //print_r($data);exit();
    show($control.'/list',$data);
}



?>