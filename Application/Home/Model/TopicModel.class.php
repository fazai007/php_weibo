<?php
/**
 * Created by PhpStorm.
 * User: niu
 * Date: 2016/12/31
 * Time: 20:34
 */
namespace Home\Model;
use Think\Model;

class TopicModel extends Model\RelationModel{
    //字段的验证
    protected $_validate = array(
        array('allContent','0,280',-1,0,'length'),
    );
    //字段自动处理
    protected $_auto = array(
        array('create','time',1,'function'),
    );
    //关联TopicImgModel,进行联合查询
    protected $_link = array(
        'topicImg' => array(
            'mapping_type' => self::HAS_MANY,
            'class_name' => 'TopicImg',
            'foreign_key' => 'topic_id'
        ),
        'comment' => array(
            'mapping_type' => self::HAS_MANY,
            'class_name' => 'Comment',
            'foreign_key' => 'tid',
            'mapping_fields' => 'id,content,creat,tid,uid',
            'mapping_order' => 'creat DESC'
        ),
    );
    /**
     * 存储发布内容
     */
    public function saveContent($allContent,$uid){
        $data = array(
            'allContent' => $allContent,
            'uid' => $uid,
            'ip' => get_client_ip(1),
        );
        $utfLeng = mb_strlen($allContent,'utf8');
        $data['content_over'] = '';
        if($utfLeng > 255){
            $data['content'] = mb_strcut($allContent,0,255,'utf8');
            $data['content_over'] = mb_strcut($allContent,255,25,'utf8');
        }else{
            $data['content'] = $allContent;
        }
        if($this->create($data)){
            $topicId = $this->add();
            return $topicId;
        }else{
            return 0;
        }
    }
}