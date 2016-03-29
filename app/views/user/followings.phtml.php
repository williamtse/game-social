<?php $this->partial("shared/banner"); ?>
<?php echo $this->tag->javascriptinclude('js/jquery-1.9.0.js'); ?>
<?php echo $this->tag->javascriptinclude('js/layer/layer.js'); ?>
<div class="container">
    <?php foreach ($followings as $following) { ?>
    <p><?php echo $following['name']; ?></p>
    <?php } ?>
</div>
<?php $this->partial("shared/footer"); ?>

