<?php
/**
 * Created by PhpStorm.
 * User: niu
 * Date: 2017/2/24
 * Time: 9:20
 */

namespace Home\Controller;

class SpaceController extends HomeController{

    /**
     * 个人首页
     */
    public function index(){
        $uid = I("get.id");
        if($uid){
            $userModel = D("user");
            $user = $userModel->relation(true)->where("id=".$uid)->find();
            if(!$user){
                $this->error("用户不存在");
            }
            $user["userIntro"] = $user["userIntro"]["intro"];
            $this->assign("user",$user);
            $this->display();
        }else{
            $this->error("用户不存在");
        }
    }
}