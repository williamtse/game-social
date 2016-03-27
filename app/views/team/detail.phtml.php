<div class="top"><?php $this->partial("shared/banner"); ?></div>
<?php echo $this->tag->javascriptinclude('js/ueditor/ueditor.config.js'); ?>
<?php echo $this->tag->javascriptinclude('js/ueditor/ueditor.all.js'); ?>
<?php echo $this->tag->stylesheetLink("css/default.css")?>

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
    <p><?php if ($userName != false) { ?>
            <?php if ($isLeader) { ?>
            <h3>发布战队公告(对所有人可见)：</h3>
            <textarea id="anounce" name="content"></textarea>
            <p><button onclick="postAnn()">发布</button></p>
            <?php } else { ?>
                <?php if ($status == 0) { ?><button onclick="applyJoinTeam()">申请加入</button>
                <?php } else { ?><button disabled="disabled"><?php echo $statusText; ?></button>
                <?php } ?>
            <?php } ?>
        <?php } else { ?>
            <button onclick="applyJoinTeam()">申请加入</button>
        <?php } ?>
    </p>
    <div>
        <h3>战队动态（仅战队成员可见）</h3>
        
    </div>
</div>
<script>
    var ue = UE.getEditor('anounce', {
                    toolbars: [
                        [
                            'undo', 'redo'
                        ]
                    ],
                    maximumWords:500
                });
    function applyJoinTeam(){
        $.ajax({
            url:'/team/join',
            type:'post',
            dataType:'json',
            data:{teamId:<?php echo $team['id'] ?>},
            success:function(re){
                alert(re.message);
                history.go(0);
            }
        });
    }
    function postAnn(){
        $.ajax({
            url:'/team/postann',
            type:'post',
            dataType:'json',
            data:{teamId:<?php echo $team['id'] ?>,content:ue.getContent()},
            success:function(re){
                if(re.status==500)
                    alert(re.message);
                else
                    history.go(0);
            }
        });
    }
</script>
<div class="top"><?php $this->partial("shared/copyright"); ?></div>
