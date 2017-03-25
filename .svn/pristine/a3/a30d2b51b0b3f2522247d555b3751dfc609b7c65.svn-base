<?php
namespace Home\Controller;
use Think\Session\Driver\Memcache;

class IndexController extends HomeController {
    /**
     * 微博首页显示
     */
    public function index(){
        if($this->isLogin()){
            $topicModel = D('Topic');
            $topics = $topicModel->relation(true)
                                 ->table('__TOPIC__ a,__USER__ b')
                                 ->field('a.id,a.content,a.content_over,a.create,a.uid,b.face face,b.username username')
                                 ->where('a.uid=b.id')
                                 ->order('`create` DESC')
                                 ->limit(0,5)
                                 ->select();
            $topcicsAllNum = count($topicModel->select());
            if(is_array($topics)){
                foreach($topics as $topicNum=>$topic){
                    $commentModel = D("comment");
                    $comments = $commentModel->relation(true)->field("content,creat,uid")->where('tid='.$topic["id"])->order("creat DESC")->select();
                    foreach ($comments as $com_th => $comment){
                        $comments[$com_th]['creat'] = $this->timeStr($comments[$com_th]['creat']);
                    }
                    $topics[$topicNum]['comment'] = $comments;
                    if(is_array($topic['topicImg'])){
                        foreach($topic['topicImg'] as $imgNum=> $img){
                            $imgArr = json_decode($img['data'],true);
                            $topics[$topicNum]['topicImg'][$imgNum] = $imgArr;
                        }
                    }
                    $topics[$topicNum]['imgCount'] = count($topics[$topicNum]['topicImg']);
                    $topics[$topicNum]['create'] = $this->timeStr($topics[$topicNum]['create']);
                    $topics[$topicNum]['content'] = changeLink($topics[$topicNum]['content']);
                    $topics[$topicNum]['content_over'] = changeLink($topics[$topicNum]['content_over']);
                }
            }
            $this->assign('face',session("userInfo")["face"]);
            $this->assign('topicsNum',$topcicsAllNum);
            $this->assign('topics',$topics);
            S("seeTimeUser_".session("userInfo")["id"],time());
            $this->display();
        }
    }

    /**
     * 下拉滚动条进行后续加载
     */
    public function partLoad(){
        if(IS_AJAX){
            $seleSta = I('post.page')*5;
            $topicModel = D('Topic');
            $topics = $topicModel->relation(true)
                ->table('__TOPIC__ a,__USER__ b')
                ->field('a.id,a.content,a.content_over,a.create,a.uid,b.face face,b.username username')
                ->where('a.uid=b.id')
                ->order('`create` DESC')
                ->limit($seleSta,5)
                ->select();
            if(is_array($topics)){
                foreach($topics as $topicNum=>$topic){
                    $commentModel = D("comment");
                    $comments = $commentModel->relation(true)->field("content,creat,uid")->where('tid='.$topic["id"])->order("creat DESC")->limit(5)->select();
                    foreach ($comments as $com_th => $comment){
                        $comments[$com_th]['creat'] = $this->timeStr($comments[$com_th]['creat']);
                    }
                    $topics[$topicNum]['comment'] = $comments;
                    if(is_array($topic['topicImg'])){
                        foreach($topic['topicImg'] as $imgNum=> $img){
                            $imgArr = json_decode($img['data'],true);
                            $topics[$topicNum]['topicImg'][$imgNum] = $imgArr;
                        }
                    }
                    $topics[$topicNum]['imgCount'] = count($topics[$topicNum]['topicImg']);
                    $topics[$topicNum]['create'] = $this->timeStr($topics[$topicNum]['create']);
                    $topics[$topicNum]['content'] = changeLink($topics[$topicNum]['content']);
                    $topics[$topicNum]['content_over'] = changeLink($topics[$topicNum]['content_over']);
                }
            }
            $this->assign('topics',$topics);
            $this->display();
        }else{
            $this->error('非法访问');
        }
    }
    /**
     * 微博发布时间转化为距今的时间差
     * @param $timeInt
     * @return bool|string
     */
    public function timeStr($timeInt){
        $time = time()-$timeInt;
        $y = date('Y');
        /*$m = date('m');
        $d = date('d');
        $todyTime = mktime(0,0,0,$d,$m,$y);*/
        if($time < 60){
            return '刚刚发布';
        }elseif($time < 60*60){
            return floor($time/60).'分钟之前';
        }elseif(date('Y-m-d') == date('Y-m-d',$timeInt)){
            return '今天'.date('H:i',$timeInt);
        }elseif($timeInt > mktime(0,0,0,1,1,$y)){
            return date('m月d日 H:i',$timeInt);
        }else{
            return date('Y年m月d日',$timeInt);
        }
    }

    /**
     * 接收评论内容
     */
    public function comment(){
        if(IS_AJAX){
            $tid = I("post.tid");
            $com_content = I("post.com_content");
            $commentModel = D("comment");
            $com_id = $commentModel->addComment($tid,$com_content);
            if($com_id){
                echo '评论成功';
            }else{
                echo '评论失败';
            }
        }
    }

    /**
     * 获取缓存总新增加的微博条目
     */
    public function getCache(){
        if(IS_AJAX){
            $seeTime = S("seeTimeUser_".session("userInfo")["id"]);
            $newWeibo = array();
            $weiboCache = S("weibo");
            foreach ($weiboCache as $value){
                if($value[1] > $seeTime){
                    $newWeibo[] = $value[0];
                }
            }
            $this->ajaxReturn($newWeibo);
        }
    }
}

