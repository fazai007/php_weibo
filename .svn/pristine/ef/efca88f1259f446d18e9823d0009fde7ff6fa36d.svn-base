<?php
/**
 * Created by PhpStorm.
 * User: niu
 * Date: 2017/1/4
 * Time: 17:39
 */
namespace Home\Controller;
use Think\Controller;

class HomeController extends Controller{
    /**
     * 判断用户是否登录
     * @return bool|mixed
     */
    protected function isLogin(){
        $userModel = D('User');
        //根据cookie开启session回话
        if(!is_null(cookie('auto')) && !session('?userInfo')){
            $value = explode('|',encryption(cookie('auto'),1));
            list($username,$ip) = $value;
            if($ip == get_client_ip()){
                $username = encryption(cookie('auto'),1);
                $condition['username'] = $username;
                $user = $userModel->field('id,username,last_time')->where($condition)->find();
                session('userInfo',$user);  //存储用户信息到session中
            }
        }
        //判断session回话
        if(session("?userInfo")){
            $user = session("userInfo");
            $update = array(
                'id' => $user['id'],
                'last_time' => NOW_TIME,
                'last_ip' => get_client_ip(1),
            );
            $userModel->save($update);       //更新用户登录信息
            return $user;
        }
        $this->redirect("Login/index");
    }
}