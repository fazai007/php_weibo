<?php
/**
 * Created by PhpStorm.
 * User: niu
 * Date: 2017/2/25
 * Time: 10:54
 */
namespace Home\Model;
use Think\Model;

class CommentModel extends Model\RelationModel{

    //字段自动处理
    protected $_auto = array(
        array('creat','time',1,'function'),
    );
    //关联查询
    protected $_link = array(
        'user' => array(
            'mapping_type' => self::BELONGS_TO,
            'class_name' => 'User',
            'foreign_key' => 'uid',
            'mapping_fields' => 'username',
            'as_fields' => 'username',
        ),
    );
    /**
     * 新增微博评论
     * @param $tid
     * @param $com_content
     * @return int|mixed
     */
    public function addComment($tid,$com_content){
        $data = array(
            'content' => $com_content,
            'ip' => get_client_ip(1),
            'tid' => $tid,
            'uid' => session("userInfo")["id"],
        );
        if($this->create($data)){
            $com_id = $this->add();
            return $com_id ? $com_id : 0;
        }
        return 0;
    }
}