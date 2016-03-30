<?php $this->partial("shared/banner"); ?>
<?php echo $this->tag->javascriptinclude('js/jquery-1.9.0.js'); ?>
<?php echo $this->tag->javascriptinclude('js/layer/layer.js'); ?>
<div class="container">
    <h3><?php echo $userinfo['name']; ?> followings</h3>
    <?php foreach ($followings as $following) { ?>
    <p><?php echo $following['name']; ?></p>
    <?php } ?>
</div>
<?php $this->partial("shared/footer"); ?>

