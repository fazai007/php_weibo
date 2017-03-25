<?php if (!defined('THINK_PATH')) exit(); if(is_array($topics)): $i = 0; $__LIST__ = $topics;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$obj): $mod = ($i % 2 );++$i;?><dl class="weibo_content_data">
        <dt>
            <a href="/space/index?id=<?php echo ($obj["uid"]); ?>" target="_blank"><img src="<?php echo ($obj["face"]); ?>"></a>
        </dt>
        <dd>
            <h4><a href="/space/index?id=<?php echo ($obj["uid"]); ?>" target="_blank"><?php echo ($obj["username"]); ?></a> </h4>
            <p><?php echo ($obj["content"]); echo ($obj["content_over"]); ?></p>
            <?php $__FOR_START_19880__=0;$__FOR_END_19880__=$obj["imgCount"];for($i=$__FOR_START_19880__;$i < $__FOR_END_19880__;$i+=1){ ?><div class="img"><img src="<?php echo ($obj['topicImg'][$i]['thumb']); ?>" src-unfold="<?php echo ($obj['topicImg'][$i]['unfold']); ?>" src-source="<?php echo ($obj['topicImg'][$i]['source']); ?>" ></div><?php } ?>
            <div class="content-footer">
                <span class="time"><?php echo ($obj["create"]); ?></span>
                <span class="handler">赞(0) | <a class="do_comment" href="javascript:void(0)">评论</a> | 收藏</span>
            </div>
            <div class="comment">
                <div class="comment_input">
                    <input type="hidden" name="tid" value="<?php echo ($obj["id"]); ?>">
                    <textarea class="send_content" name="send_content"></textarea>
                    <input type="button" value="评论" class="com_button">
                </div>
                <?php if(empty($obj["comment"])): ?><ol class="comment_list" style="display: none;"></ol><?php else: ?>
                    <ol class="comment_list">
                        <?php if(is_array($obj["comment"])): $i = 0; $__LIST__ = $obj["comment"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$comment): $mod = ($i % 2 );++$i;?><li>
                                <p><a target="_blank" href="/space/index?id=<?php echo ($comment["uid"]); ?>"><?php echo ($comment["username"]); ?>：</a><?php echo ($comment["content"]); ?></p>
                                <p class="com_time" ><?php echo ($comment["creat"]); ?></p>
                            </li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ol><?php endif; ?>
            </div>
        </dd>
    </dl><?php endforeach; endif; else: echo "" ;endif; ?>