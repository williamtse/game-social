<?php $this->partial("shared/banner"); ?>
<?php echo $this->tag->javascriptInclude("js/jquery-1.9.0.js"); ?>
<?php echo $this->tag->javascriptinclude('js/layer/layer.js'); ?>
<?php echo $this->tag->javascriptinclude('js/ueditor/ueditor.config.js'); ?>
<?php echo $this->tag->javascriptinclude('js/ueditor/ueditor.all.js'); ?>
<?php echo $this->tag->stylesheetLink("css/default.css") ?>

<div class="container">
    <div class="team-info">
        <div class="fleft">
            <img src="/public/img/<?php echo $team['img']; ?>" class="game-item-image">
        </div>
        <div class="fleft">
            <p>创建者：<a href="/user/detail?name=<?php echo $creater['name']; ?>"><?php echo $creater['name']; ?></a></p>
            <h3>最新公告</h3>
            <?php echo $ann['content']; ?>
        </div>
    </div>

    <div class="clearBoth"></div>
    <div class="team-intro">
        <h3>简介</h3>
        <p><?php echo $team['intro'] ?></p>
    </div>
    <p>
        <?php if ($userName != false) { ?>
            <?php if ($isLeader) { ?>
                <h3>发布战队公告(对所有人可见)：</h3>
                <textarea id="anounce" name="content"></textarea>
                <p><button onclick="postAnn()">发布</button></p>
            <?php } else { ?>
                <?php if ($status == 0) { ?><button onclick="applyJoinTeam()" class="applyBtn">申请加入</button>
                <?php } else { ?><button disabled="disabled"><?php echo $statusText; ?></button>
                <?php } ?>
            <?php } ?>
        <?php } else { ?>
        <button onclick="applyJoinTeam()" class="applyBtn">申请加入</button>
        <?php } ?>
    </p>

<div>
    <h3>战队动态（仅战队成员可见）</h3>

</div>
</div>
<script>
    <?php if ($userName != false) { ?>
    <?php if ($isLeader) { ?>
    var ue = UE.getEditor('anounce', {
        toolbars: [
            [
                'undo', 'redo'
            ]
        ],
        maximumWords: 500
    });
    <?php } ?>
    <?php } ?>
    function applyJoinTeam() {
        $.ajax({
            url: '/team/join',
            type: 'post',
            dataType: 'json',
            data: {teamId:<?php echo $team['id'] ?>},
            success: function (re) {
                if (re.status === 503) {
                    layer.open({
                        type: 2,
                        title: '登陆',
                        shadeClose: true,
                        shade: 0.8,
                        area: ['400px', '300px'],
                        content: '/signup/layerlogin' //iframe的url        
                    });
                }else{
                    layer.alert(re.message);
                    $('.applyBtn').attr('disabled','disabled').html('申请审核中');
                }
//                alert(re.message);
//                history.go(0);
            }
        });
    }
    function postAnn() {
        $.ajax({
            url: '/team/postann',
            type: 'post',
            dataType: 'json',
            data: {teamId:<?php echo $team['id'] ?>, content: ue.getContent()},
            success: function (re) {
                if (re.status == 500)
                    alert(re.message);
                else
                    history.go(0);
            }
        });
    }
</script>
<?php $this->partial("shared/footer"); ?>
