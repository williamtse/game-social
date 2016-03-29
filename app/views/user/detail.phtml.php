<?php $this->partial("shared/banner"); ?>
<?php echo $this->tag->javascriptinclude('js/jquery-1.9.0.js'); ?>
<?php echo $this->tag->javascriptinclude('js/layer/layer.js'); ?>
<div class="container">
<h1><?php echo $userinfo['name']; ?>的主页</h1>
<?php if ($userId != $userinfo['userId']) { ?>
<?php if ($userName) { ?>
    <?php if ($followed) { ?>
    <button onclick="unfollow(<?php echo $userinfo['userId']; ?>)" id="unfollow"  class="applyBtn">
        取消关注
    </button>
    <?php } else { ?>
    <button onclick="follow(<?php echo $userinfo['userId']; ?>)" id="follow">关注</button>
    <?php } ?>
<?php } else { ?>
    <button onclick="follow(<?php echo $userinfo['userId']; ?>)">关注</button>
<?php } ?>
<?php } ?>
</div>
<script>
    
    </script>
<?php $this->partial("shared/footer"); ?>

