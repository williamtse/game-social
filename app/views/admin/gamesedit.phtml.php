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
    <h3>编辑游戏  <span class="success"><?php if(isset($sucessMessage)){echo $sucessMessage;} ?></span></h3>
    <?php echo $this->tag->form("admin/gamesedit?id=".$gameinfo['gameId']); ?>
    <?php echo $this->tag->setDefaults($gameinfo);?>
    <p>
        <label for="gameBigCategoryId">游戏分类：</label>
        <?php echo $this->tag->selectStatic("gameBigCategoryId", $gameBigCategorys) ?>   
        <label for="gameCategoryId">游戏类型：</label>
        <?php echo $this->tag->selectStatic("gameCategoryId", $gameCategorys) ?>
        <label for="gameCategoryId">游戏题材：</label>
        <?php echo $this->tag->selectStatic("gameStyleId", $gameStyles) ?>
    </p>
    <p>
        <label for="gameName">游戏名称：</label>
        <?php echo $this->tag->textField(array("gameName", "size" => 30)) ?>
        <span class="error"><?php echo isset($gameNameError) ? $gameNameError : ''; ?></span>
    </p>
    <p>
        <label for="preCharacter">游戏名称-拼音头字母：</label>
        <?php echo $this->tag->textField("preCharacter") ?>
        <span class="error"><?php echo isset($preCharacterError) ? $preCharacterError : ''; ?></span>
    </p>
    <p>
        <label for="developCompany">开发公司：</label>
        <?php echo $this->tag->textField('developCompany') ?>
        <span class="error"><?php echo isset($developCompanyError) ? $developCompanyError : ''; ?></span>
    </p>
    <p>
        <label for="preCharacter">游戏图片：</label>
        <?php echo $this->tag->fileField(array("name"=>"imgs[]","id"=>"fileupload"));?>
        <input type="hidden" name="imgIds" value="<?php echo $gameinfo['img']; ?>">
        <span class="error"><?php //echo isset($preCharacterError) ? $preCharacterError : ''; ?></span>
        <br><img id="img" src="/public/img/<?php echo $gameinfo['img']; ?>">
    </p>
    <p>
        <label for="preCharacter">游戏视频：</label>
        <?php echo $this->tag->textField(array('video','size'=>100,'value'=> $gameinfo['video'])) ?>
        <span class="error"></span>
    </p>
    <p>
        <label for="startRunTime">开始运营时间：</label>
        <?php echo $this->tag->dateField(array("startRunTime")) ?>
    </p>
    <p>
        <label for="whichD">游戏画面：</label>
        <?php echo $this->tag->selectStatic("whichD", array("2D" => "2D", "2.5D" => "2.5D", "3D" => "3D")) ?>
    </p>
    <p>
        <label for="intro">游戏介绍：</label><span class="error"><?php echo isset($introError) ? $introError : ''; ?></span>
        <br>
        <?php echo $this->tag->textArea(array("intro", "cols" => 70, "rows" => 10)); ?>
    </p>
    <p>
        <?php echo $this->tag->submitButton("保存") ?>
    </p>
</div>
<script>
$(function () {
    'use strict';
    
    $('#fileupload').fileupload({
        url:'/file/imgupload',
        dataType: 'json',
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        autoUpload:true,
        sequentialUploads: true ,
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
                $('#img').attr('src',file.url);
                $('input[name="imgIds"]').val(file.imgId);
            });
            
        }
    });

});
</script>
