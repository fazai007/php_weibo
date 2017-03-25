<volist name="topics" id="obj">
    <dl class="weibo_content_data">
        <dt>
            <a href="/space/index?id={$obj.uid}" target="_blank"><img src="{$obj.face}"></a>
        </dt>
        <dd>
            <h4><a href="/space/index?id={$obj.uid}" target="_blank">{$obj.username}</a> </h4>
            <p>{$obj.content}{$obj.content_over}</p>
            <for start="0" end="$obj.imgCount">
                <div class="img"><img src="{$obj['topicImg'][$i]['thumb']}" src-unfold="{$obj['topicImg'][$i]['unfold']}" src-source="{$obj['topicImg'][$i]['source']}" ></div>
            </for>
            <div class="content-footer">
                <span class="time">{$obj.create}</span>
                <span class="handler">赞(0) | <a class="do_comment" href="javascript:void(0)">评论</a> | 收藏</span>
            </div>
            <div class="comment">
                <div class="comment_input">
                    <input type="hidden" name="tid" value="{$obj.id }">
                    <textarea class="send_content" name="send_content"></textarea>
                    <input type="button" value="评论" class="com_button">
                </div>
                <empty name="obj.comment"><ol class="comment_list" style="display: none;"></ol><else/>
                    <ol class="comment_list">
                        <volist name="obj.comment" id="comment">
                            <li>
                                <p><a target="_blank" href="/space/index?id={$comment.uid}">{$comment.username}：</a>{$comment.content}</p>
                                <p class="com_time" >{$comment.creat}</p>
                            </li>
                        </volist>
                    </ol>
                </empty>
            </div>
        </dd>
    </dl>
</volist>