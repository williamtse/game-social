<div class="top"><?php $this->partial("shared/banner"); ?></div>
<?php echo $this->tag->javascriptInclude("js/jquery.raty.js") ?>
<?php echo $this->tag->javascriptInclude("js/ueditor/ueditor.config.js") ?>
<?php echo $this->tag->javascriptInclude("js/ueditor/ueditor.all.js") ?>

<div class="container">
    <div class="game-info">
        <div class="game-left">
            <img src="/public/img/<?php echo $detail['img']; ?>" class="game-item-image">
            <p>游戏名称：<a href="/game/detail?id=<?php echo $detail['gameId'] ?>"><?php echo $detail['gameName'] ?></a></p>
            <p>游戏开发商：<?php echo $detail['developCompany'] ?></p>
            <p>评分：<span id="star-<?php echo $detail['gameId'] ?>"></span></p>
        </div>
        <div class="game-right">
            <video src="/public/videos/<?php echo $detail['video']; ?>" controls="controls" width="500" autoplay="autoplay">
            您的浏览器不支持 video 标签。
            </video>
        </div>
    </div>

    <div class="clearBoth"></div>
    <div class="game-intro">
        <h3>游戏简介</h3>
        <p><?php echo $detail['intro'] ?></p>
    </div>

    <script>
        $('#star-<?php echo $detail['gameId'] ?>').raty({
            path: '/public/js/img/',readOnly:true,start:<?php echo $score ?>
        });
    </script>
    <div class="comments">
        <h3>评论</h3>
        <div id="comment-list">
            <?php if (!empty($comments)) foreach ($comments as $comment) { ?>
                    <div class="comment-item">
                        <p>
                            <a href='/user/index?name=<?php echo $comment['name'] ?>'><?php echo $comment['name'] ?></a>
                            <span id="comment-star-<?php echo $comment['id'] ?>"></span>
                            <span class="comment-time"><?php echo $comment['create_time'] ?></span>
                        </p>
                        <p><?php echo $comment['content']; ?></p>
                    </div>
                    <script>
                        $('#comment-star-<?php echo $comment['id'] ?>').raty({
                            path: '/public/js/img/',readOnly:true,start:<?php echo $comment['score'] ?>
                        });
                    </script>
                <?php } ?>
        </div>
        <div id="comment-form">
            <h3>我来说两句</h3>
            <p><span>评分：</span><span id="comment-star"></span></p>
            <div id="content"></div>
            <p>
                <label for="validate_code">验证码：</label>
                <?php echo $this->tag->textField(array('validate_code','size'=>4)); ?>
                <img id="code" class="validate_code"  src="/validatecode/flush" onclick="this.src='/validatecode/flush?'+Math.random()"/>
            </p>
            <script type="text/javascript">
                $('#comment-star').raty({
                    path: '/public/js/img/'
                });
                var ue = UE.getEditor('content', {
                    toolbars: [
                        [
                            'emotion', //表情
                        ]
                    ]
                });
                function gameComment() {
                    var content = ue.getContent();
                    var type = 'game';
                    var score = $('#comment-star-score').val();
                    var validcode = $('input[name=validate_code]').val();
                    if(content.length==0){
                        $('#commentError').html('请填写评论内容！');
                        return;
                    }else{
                        $('#commentError').html('');
                    }
                    if(validcode.length==0){
                        $('#commentError').html('请填写验证码！');
                        return;
                    }else{
                        $('#commentError').html('');
                    }
                    $.ajax({
                        url: '/comment/add',
                        data: {content: content, type: type, rowId:<?php echo $detail['gameId']; ?>,score:score,validate_code:validcode},
                        dataType: 'json',
                        type: 'post',
                        success: function (re) {
                            if (re.status == 200) {
                                history.go(0);
//                                $('#commentError').html('');
//                                var data = re.data;
//                                $('#comment-list').append('<div class="comment-item"><p><a href="/user/detail?name='+data.name+'">'+data.name+'</a></p><p>' + content + '</p></div>');
                            }else if(re.status==500){
                                $('#commentError').html(re.message);
                            }
                        }
                    });
                }
            </script>
            <p><button onclick="gameComment()">提交</button> <span id="commentError" class="error"></span></p>
        </div>
    </div>
</div>
<div class="top"><?php $this->partial("shared/copyright"); ?></div>
