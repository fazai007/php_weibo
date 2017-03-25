<?php
namespace Home\Controller;
use Think\Db;
use Think\Verify;

class UserController extends HomeController {
    public function index(){
        if($this->isLogin()){
            echo '用户已登录！';
        }
    }
    /**
     * 测试函数
     */
    public function showUser(){
        $user = D('User');
        print_r($user->select());
    }
    /**
     * 添加用户
     */
    public function register(){
        if(IS_POST){
            $user = D('User');
            $uid = $user->register(I('post.username'),I('post.password'),I('post.repassword'),I('post.email'));
            echo $uid;
        }else{
            $this->error("非法访问！");
        }

    }
    /**
     * 字段验证
     */
    public function checkField(){
        if(IS_AJAX){
            $user = D('User');
            $type = I('post.type');
            $username = I("post.username");
            $email = I("post.email");
            if($username){
                $value = $username;
            }else{
                $value = $email;
            };
            $checkF = $user->checkUsed($value,$type);
            if($checkF == 1){
                echo 'true';
                return ;
            }
            echo 'false';
        }
    }
    /**
     * 验证验证码
     */
    public function checkCode(){
        $config = array(
            'reset' =>  false,
        );
        $verify = new Verify($config);
        if(IS_AJAX){
            $code = I('post.verifyCode');
            $result = $verify->check($code);
            if($result){
                echo 'true';
            }else{
                echo 'false';
            }
        }
    }
    /**
     * 用户登录
     */
    public function login(){
        if(IS_AJAX){
            $user = D('User');
            $result =  $user->login(I('post.user'),I('post.password'),I('post.auto'));
            echo $result;
            return; 
        }
        $this->error('非法访问');
    }

    /**
     *用户退出，清除session和cookie
     */
    public function logout(){
        //清除session
        session(null);
        //清除cookie中的auto存值
        cookie('auto',null);
        $this->success('退出成功',U('Login/index'));
    }
}