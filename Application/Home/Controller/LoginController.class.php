<?php
namespace Home\Controller;
use Think\Verify;

class LoginController extends HomeController {
    public function index(){
        $this->display();
    }
    /**
     * 输出验证码
     */
    public function checkCode(){
        $verify = new Verify();
        $verify->entry();
    }
}