<?php
/**
 * Created by PhpStorm.
 * User: niu
 * Date: 2017/2/25
 * Time: 20:03
 */
namespace Home\Model;
use Think\Model;

class ReferModel extends Model\RelationModel{
    //自动填充字段
    protected $_auto = array(
        array('create','time',1,'function'),
    );
    //关联--topic表
    protected $_link = array(
        'topic' => array(
            'mapping_type' => self::BELONGS_TO,
            'class_name' => 'Topic',
            'foreign_key' => 'tid',
            'mapping_fields' => 'content',
            'as_fields' => 'content',
        ),
    );
    /**
     * 新增关联数据
     * @param $tid
     * @param $uid
     */
    public function addData($tid,$uid){
        $data = array(
            'tid' => $tid,
            'uid' => $uid,
            'read' => 0
        );
        if($this->create($data)){
            $referId = $this->add();
            $referId ? $referId : 0;
        }else{
            $this->getError();
        }
    }
    
    
    
}