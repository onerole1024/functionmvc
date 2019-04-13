<?php

function index($control,$data){
    $data['pageTitle'] = '欢迎';
    show($control.'/index',$data);
}


?>