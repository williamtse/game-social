<div class="top"><?php $this->partial("shared/banner"); ?></div>
<?php echo $this->tag->javascriptinclude('js/ueditor/ueditor.config.js'); ?>
<?php echo $this->tag->javascriptinclude('js/ueditor/ueditor.all.js'); ?>
<?php echo $this->tag->stylesheetLink("css/default.css")?>
<?php echo $this->tag->javascriptInclude("js/jquery-1.9.0.js")?>
<?php echo $this->tag->javascriptInclude("js/jQuery-File-Upload-9.12.1/js/vendor/jquery.ui.widget.js")?>
<?php echo $this->tag->javascriptInclude("js/jQuery-File-Upload-9.12.1/js/tmpl.min.js")?>
<?php echo $this->tag->javascriptInclude("js/jQuery-File-Upload-9.12.1/js/load-image.all.min.js")?>
<?php echo $this->tag->javascriptInclude("js/jQuery-File-Upload-9.12.1/js/canvas-to-blob.min.js")?>
<?php echo $this->tag->javascriptInclude("js/jQuery-File-Upload-9.12.1/js/bootstrap.min.js")?>
<?php echo $this->tag->javascriptInclude("js/jQuery-File-Upload-9.12.1/js/jquery.blueimp-gallery.min.js")?>
<?php echo $this->tag->javascriptInclude("js/jQuery-File-Upload-9.12.1/js/jquery.iframe-transport.js")?>
<?php echo $this->tag->javascriptInclude("js/jQuery-File-Upload-9.12.1/js/jquery.fileupload.js")?>
<?php echo $this->tag->javascriptInclude("js/jQuery-File-Upload-9.12.1/js/jquery.fileupload-process.js")?>
<?php echo $this->tag->javascriptInclude("js/jQuery-File-Upload-9.12.1/js/jquery.fileupload-image.js")?>
<?php echo $this->tag->javascriptInclude("js/jQuery-File-Upload-9.12.1/js/jquery.fileupload-audio.js")?>
<?php echo $this->tag->javascriptInclude("js/jQuery-File-Upload-9.12.1/js/jquery.fileupload-video.js")?>
<?php echo $this->tag->javascriptInclude("js/jQuery-File-Upload-9.12.1/js/jquery.fileupload-validate.js")?>
<div class="container">
    <p><label for="teamName">战队名称：</label></p>
    <p><?php echo $this->tag->textfield('teamName'); ?></p>
    <p><label for="intro">战队简介：</label></p>
    <textarea name="intro" id="intro"></textarea>
    <p>战队Logo:<input type="file" name="imgs[]" id="logo"></p>
    <?php echo $this->tag->hiddenfield('logo'); ?>
    <div id="team-logo">
        
    </div>
    
    <div class="clearBoth"></div>
    <p><button onclick="addTeam()">创建</button><span class="error" id="error"></span><span class="success" id="success"></span></p>
</div>
<script>
    var ue = UE.getEditor('intro', {
                    toolbars: [
                        [
                            'undo', 'redo'
                        ]
                    ]
                });
    $('#logo').fileupload({
        url:'/file/imgupload',
        dataType: 'json',
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        autoUpload:true,
        sequentialUploads: true ,
        done: function (e, data) {
            var imgIds = [];
            $("#team-logo").html();
            $.each(data.result.files, function (index, file) {
                $('<li class="thumb-item"><img src="'+file.thumbnailUrl+'"></li>').appendTo("#team-logo");
                imgIds.push(file.imgId);
            });
            $('input[name="logo"]').val(imgIds.join(','));
        }
    });
    
    function addTeam(){
        $.ajax({
            url:'/team/add',
            type:'post',
            data:{
                teamName:$('input[name="teamName"]').val(),
                intro:$('#intro').val(),
                logo:$('input[name="logo"]').val()
            },
            dataType:'json',
            success:function(re){
                if(re.status==500)
                    $('#error').html(re.message);
                else
                    $('#success').html(re.message);
            }
        });
    }
</script>
<div class="top"><?php $this->partial("shared/copyright"); ?></div>
