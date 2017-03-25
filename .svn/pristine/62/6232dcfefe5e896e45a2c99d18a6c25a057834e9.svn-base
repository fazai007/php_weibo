<?php
namespace Home\Controller;
use Home\Model\TopicModel;
use Think\Controller;

class TopicController extends Controller {
    /**
     * 接收发布微博，存储表格
     */
    public function publish(){
        if(IS_AJAX){
            $uId = session('userInfo')['id'];
            $weibo_content = I('post.content');
            $userArr = changeLink($weibo_content,0);
            $topic = D('Topic');
            $topicId = $topic->saveContent(I('post.content'),$uId);
            if($topicId>0){
                //再缓存中增加发布条数
                if(S("weibo")){
                    $userWeibo = S("weibo");
                    $userWeibo[] = array($topicId,time());
                }else{
                    $userWeibo = array(array($topicId,time()));
                }
                S("weibo",$userWeibo);
                //处理提及到的人
                if($userArr){
                    $refer = D("Refer");
                    foreach($userArr as $userId){
                        $refer->addData($topicId,$userId);
                    }
                }
                $imgs = I('post.imgs','',false);
                if(is_array($imgs)){
                    $topicImg = D('TopicImg');
                    $saveTag = $topicImg->storage($imgs,$topicId);
                }
            }
            return $saveTag;
        }
        $this->error('非法访问');
    }
}