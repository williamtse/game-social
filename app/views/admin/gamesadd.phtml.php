<?php echo $this->partial('admin/devision_header'); ?>
<?php echo $this->tag->stylesheetlink('css/default.css'); ?>
<?php echo $this->tag->javascriptinclude('js/jquery-1.9.0.js'); ?>
<?php echo $this->tag->javascriptinclude('js/jQuery-File-Upload-9.12.1/js/vendor/jquery.ui.widget.js'); ?>
<?php echo $this->tag->javascriptinclude('js/jQuery-File-Upload-9.12.1/js/tmpl.min.js'); ?>
<?php echo $this->tag->javascriptinclude('js/jQuery-File-Upload-9.12.1/js/load-image.all.min.js'); ?>
<?php echo $this->tag->javascriptinclude('js/jQuery-File-Upload-9.12.1/js/canvas-to-blob.min.js'); ?>
<?php echo $this->tag->javascriptinclude('js/jQuery-File-Upload-9.12.1/js/bootstrap.min.js'); ?>
<?php echo $this->tag->javascriptinclude('js/jQuery-File-Upload-9.12.1/js/jquery.blueimp-gallery.min.js'); ?>
<?php echo $this->tag->javascriptinclude('js/jQuery-File-Upload-9.12.1/js/jquery.iframe-transport.js'); ?>
<?php echo $this->tag->javascriptinclude('js/jQuery-File-Upload-9.12.1/js/jquery.fileupload.js'); ?>
<?php echo $this->tag->javascriptinclude('js/jQuery-File-Upload-9.12.1/js/jquery.fileupload-process.js'); ?>
<?php echo $this->tag->javascriptinclude('js/jQuery-File-Upload-9.12.1/js/jquery.fileupload-image.js'); ?>
<?php echo $this->tag->javascriptinclude('js/jQuery-File-Upload-9.12.1/js/jquery.fileupload-audio.js'); ?>
<?php echo $this->tag->javascriptinclude('js/jQuery-File-Upload-9.12.1/js/jquery.fileupload-video.js'); ?>
<?php echo $this->tag->javascriptinclude('js/jQuery-File-Upload-9.12.1/js/jquery.fileupload-validate.js'); ?>
<div class="rightContent">
    <h3>添加游戏  <span class="success"><?php if (isset($sucessMessage)) {
    echo $sucessMessage;
} ?></span></h3>
    <?php echo $this->tag->form(array('admin/gamesadd')); ?>
    <p>
        <label for="gameBigCategoryId">游戏分类：</label>
        <?php echo $this->tag->selectstatic('gameBigCategoryId', $gameBigCategorys); ?>   
        <label for="gameCategoryId">游戏类型：</label>
        <?php echo $this->tag->selectstatic('gameCategoryId', $gameCategorys); ?>
        <label for="gameCategoryId">游戏题材：</label>
        <?php echo $this->tag->selectstatic('gameStyleId', $gameStyles); ?>
    </p>
    <p>
        <label for="gameName">游戏名称：</label>
        <?php echo $this->tag->textfield('gameName'); ?>
        <span class="error"><?php echo isset($gameNameError) ? $gameNameError : ''; ?></span>
    </p>
    <p>
        <label for="preCharacter">游戏名称-拼音头字母：</label>
        <?php echo $this->tag->textfield('preCharacter'); ?>
        <span class="error"><?php echo isset($preCharacterError) ? $preCharacterError : ''; ?></span>
    </p>
    <p>
        <label for="preCharacter">游戏图片：</label>
<?php echo $this->tag->fileField(array('name' => "imgs[]", "id" => 'imgUpload')) ?>
        <span class="error"><?php //echo isset($preCharacterError) ? $preCharacterError : '';  ?></span>
        <?php echo $this->tag->hiddenfield('imgids'); ?>
    <ul id="img-list">
    </ul>
    <div class="clearBoth"></div>
</p>
<p>
    <label for="preCharacter">游戏视频：</label>
<?php echo $this->tag->textField(array("video", 'size' => 100)) ?>
    <span class="error"><?php //echo isset($preCharacterError) ? $preCharacterError : '';  ?></span>
</p>
<div>
    <ul id="img-list"></ul>
    <div class="clearBoth"></div>
</div>
<p>
    <label for="developCompany">开发公司：</label>
    <?php echo $this->tag->textfield('developCompany'); ?>
    <span class="error"><?php echo isset($developCompanyError) ? $developCompanyError : ''; ?></span>
</p>
<p>
    <label for="startRunTime">开始运营时间：</label>
    <?php echo $this->tag->datefield('startRunTime'); ?>
</p>
<p>
    <label for="whichD">游戏画面：</label>
<?php echo $this->tag->selectStatic("whichD", ["2D" => "2D", "2.5D" => "2.5D", "3D" => "3D"]) ?>
</p>
<p>
    <label for="intro">游戏介绍：</label><span class="error"><?php echo isset($introError) ? $introError : ''; ?></span>
    <br>
<?php echo $this->tag->textArea(array("intro", "cols" => 70, "rows" => 10)) ?>
</p>
<p>
    <?php echo $this->tag->submitbutton('添加'); ?>
</p>
</div>
<script>
    $(function () {
        'use strict';

        $('#imgUpload').fileupload({
            url: '/file/imgupload',
            dataType: 'json',
            acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
            autoUpload: true,
            sequentialUploads: true,
            done: function (e, data) {
                $.each(data.result.files, function (index, file) {
                    ("#img-list").html('<li class="thumb-item"><img src="' + file.thumbnailUrl + '"></li>');
                    $('input[name="imgids"]').val(file.imgId);
                });
                
            }
        });

    });
</script>
