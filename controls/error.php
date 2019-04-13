<?php

function index($control,$data){
    $data['pageTitle'] = '错误';
    show($control.'/error',$data);
}


?>