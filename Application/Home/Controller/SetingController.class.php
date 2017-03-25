<?php
/**
 * Created by PhpStorm.
 * User: niu
 * Date: 2017/2/14
 * Time: 15:48
 */
namespace Home\Controller;
use Think\Controller;
use Think\Image;

class SetingController extends Controller{
    /**
     * 用户个人信息展示
     */
    public function index(){
        $userId = $_SESSION['userInfo']['id'];
        $userModel = D("user");
        $user = $userModel->field('id,username,email')->relation(true)->find($userId);
        if(!is_array($user['userIntro'])){
            $intro = array(
                'uid' => session('userInfo')['id']
            );
            $introModel = M("user_intro");
            if(!$introModel->add($intro)){
                echo '简介新建失败';
            }
        }
        $this->assign('userInfo',$user);
        $this->display();
    }

    /**
     * 修改个人信息
     */
    public function setUserInfo(){
        if(IS_AJAX){
            $data = array(
                'id' => session('userInfo')['id'],
                'email' => I("post.email"),
                'userIntro' => array(
                    'intro' => I("post.intro"),
                ),
            );
            $userModel = D("user");
            echo $userModel->relation(true)->save($data);
        }else{
            $this->error('非法访问');
        }
    }

    /**
     * 头像设置
     */
    public function face(){
        $userId = session("userInfo")['id'];
        $userModel = D("user");
        if(IS_AJAX){
            $pic_path = ".".I("post.pic_path");
            $pic_w = I("post.pic_w");
            $pic_h = I("post.pic_h");
            $pic_x = I("post.pic_x");
            $pic_y = I("post.pic_y");
            $imgModel = new Image();
            $imgModel->open($pic_path);
            //后台获取文件路径需要在根目录上加长‘./’
            $face_path = './Uploads/face/'.session("userInfo")["id"].".jpg";
            if($imgModel->crop($pic_w,$pic_h,$pic_x,$pic_y)->thumb(200,200)->save($face_path)){
                $face_path = substr($face_path,1,strlen($face_path)-1);
                $user = array(
                    'face' => $face_path,
                );
                $userModel->where('id='.$userId)->save($user);
                echo true;
            }else{
                echo false;
            };
        }else{
            $userFace = $userModel->field("face")->where("id=".$userId)->find();
            $this->assign("face",$userFace["face"]);
            $this->display();
        }
    }

    /**
     * 提及到我的微博
     */
    public function refer(){
        $userId = session("userInfo")["id"];
        $referModel = D("Refer");
        $conditions = array(
            'uid' => $userId,
            'read' => 0
        );
        $refers = $referModel->relation(true)->field("id,tid,create")->where($conditions)->order("`create` DESC")->select();
        $this->assign("refers",$refers);
        $this->display();
    }

    /**
     * 清除提及到我的
     */
    public function cleanRefer(){
        if(IS_AJAX){
            $referId = I("post.id");
            $referModel = D("refer");
            if($referModel->where("id=".$referId)->delete()){
                echo 1;
            }else{
                echo 0;       
            }
        }
    }
}

