<?php
/**
 * Created by PhpStorm.
 * User: niu
 * Date: 2017/1/5
 * Time: 9:19
 */

/**
 * 对字符串进行加密
 * @param $data
 * @param $type
 * @return int|string
 */
function encryption($data,$type=0){
    $key = sha1(C('COOKIE_KEY'));
    if(!$type){
        return base64_encode($data ^ $key);
    }
    return base64_decode($data)^$key;
}

/**
 * 获取发布内容中的用户名
 * @param $content
 * @param int $returnFlag 默认为 1 返回被处理的微博内容，0 时返回提及到的用户id（数组）
 * @return mixed
 */
function changeLink($content,$returnFlag=1){
    $userIdArr = array();
    $pattern = '/@(\S+)\s/i';
    preg_match_all($pattern,$content,$out, PREG_SET_ORDER);
    if($out){
        $userModel = D("user");
        foreach ($out as $user){
            $condition = array(
                "username" => $user[1]
            );
            $userId = $userModel->field("id")->where($condition)->find();
            if($userId){
                $userIdArr[] = $userId["id"];
                $userLink = '<a target="_blank" href="/space/index?id='.$userId["id"].'">'.$user[0].'</a>';
                $content = str_replace($user[0],$userLink,$content);
            }
        }
    }
    if($returnFlag){
        return $content;
    }
    return $userIdArr;
}