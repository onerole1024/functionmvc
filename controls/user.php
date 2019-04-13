<?php

function reg($control,$data){
    $data['pageTitle'] = '注册';
    if(isAjax()){
        $user = $_POST;
        try{
            data('user');
            //print_r($user);exit();
            if($uid = newUser($user['User'])){
                $_SESSION['me'] = $user['User']['username'];
                $_SESSION['meuid'] = $uid;
                $res = array('success'=>true,'message'=>'注册成功','data'=>array());
            }
        }catch(Exception $e){
            $res = array('success'=>false,'message'=>$e->getMessage(),'data'=>array());
        }


        returnData($res);
    }
    show($control.'/reg',$data);
}


function login($control,$data){
    $data['pageTitle'] = '登录';
    if(isAjax()){
        $user = $_POST;

        data('user');
        $res =loginme($user['User']['username'],$user['User']['passwd']);
        returnData($res);
    }
    show($control.'/login',$data);
}




?>