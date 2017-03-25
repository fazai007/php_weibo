<?php
/**
 * Created by PhpStorm.
 * User: niu
 * Date: 2016/12/31
 * Time: 20:34
 */
namespace Home\Model;
use Think\Model;

//TopicImg会对应数据库中的topic_img表格。
class TopicImgModel extends Model{
    /**
     * 存储图片信息
     */
    public function storage($imgs,$topicId){
        foreach($imgs as $key=>$imgPath){
            $imgspath = array(
                'data' => $imgPath,
                'topic_id' => $topicId
            );
            if(!$this->add($imgspath)){
                return 0;
            };
        }
        return 1;
    }
}