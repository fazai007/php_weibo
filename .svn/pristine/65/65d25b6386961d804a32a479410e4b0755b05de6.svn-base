<?php
/**
 * Created by PhpStorm.
 * User: niu
 * Date: 2016/12/31
 * Time: 20:34
 */
namespace Home\Model;
use Think\Model;

class UserModel extends Model\RelationModel{
    //字段的验证
    protected $_validate = array(
        array('username','/^[^@]{2,20}$/i','用户名不得包含特殊字符@，且要2-20个字符！',0,'regex'),
        array('password','6,30','密码必须6-30个字符！',0,'length'),
        array('repassword','password','密码必须保持一致！',0,'confirm'),
        array('email','email','邮箱格式不正确！',0),
        array('username','','用户名已存在！',0,'unique',3),
        array('email','','邮箱已被存在！',0,'unique',3),
        array('login_name','2,50','登录用户名需2-50个字符',0,'length'),
        array('login_name','email','notEmail',0),
    );
    //字段自动处理
    protected $_auto = array(
        array('password','sha1',3,'function'),
        array('reg_time','time',2,'function'),
    );
    //与user_intro表关联
    protected $_link = array(
        'userIntro' => array(
            'mapping_type' => self::HAS_ONE,
            'class_name' => 'user_intro',
            'foreign_key' => 'uid',
            'mapping_fields' => 'intro'
        ),
    );
    /**
     * 注册用户
     */
    public function register($username,$password,$repassword,$email){
        $date = array(
            'username' => $username,
            'password' => $password,
            'repassword' => $repassword,
            'email' => $email,
            'reg_time' => time(),
        );
        if($this->create($date)){
            $uid = $this->add();
            return $uid ? $uid : 0;
        }else{
            echo $this->getError();
        }
    }
    /**
     * 单字段的验证（是否占用）
     */
    public function checkUsed($value,$type){
        $date = array();
        $date[$type] = $value;
        return $this->create($date) ? 1 : $this->getError();
    }

    /**
     * 用户登录处理
     * @param $username
     * @param $password
     * @param $auto
     * @return int|void
     */
    public function login($username,$password,$auto){
        $logDate = array(
            'login_name' => $username,
            'password' => $password
        );
        $userInfo = array();
        if($this->create($logDate)){            //使用自动验证校验数据
            $userInfo['email'] = $username;     //用户名是邮箱
        }else{
            if('notEmail' == $this->getError()){
                $userInfo['username'] = $username;       //用户名是昵称
            }
        }
        if(empty($userInfo)){
            echo $this->getError();
            return;
        }
        $user = $this->field('id,username,password,face,last_time')->where($userInfo)->find();       //在数据库中查找用户
        if($user){
            if($user['password'] == sha1($password)){
                $update = array(
                    'id' => $user['id'],
                    'last_time' => NOW_TIME,
                    'last_ip' => get_client_ip(1),
                );
                $this->save($update);       //更新用户登录信息
                unset($user['password']);
                session('userInfo',$user);  //存储用户信息到session中
                if($auto == 'on'){
                    cookie('auto',encryption($user['username'].'|'.get_client_ip()),3600*24*30);
                }
                return $user['id'];
            }
            return -9;      //密码错误
        }
        return 0;       //不存在此用户
    }
}