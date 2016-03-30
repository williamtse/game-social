<?php $this->partial("shared/banner"); ?>
<?php echo $this->tag->javascriptinclude('js/jquery-1.9.0.js'); ?>
<?php echo $this->tag->javascriptinclude('js/layer/layer.js'); ?>
<div class="container">
    <h3><?php echo $userinfo['name']; ?> followers</h3>
    <?php foreach ($followers as $follower) { ?>
    <p><?php echo $follower['name']; ?></p>
    <?php } ?>
</div>
<?php $this->partial("shared/footer"); ?>

