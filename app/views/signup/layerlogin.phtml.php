<?php echo $this->tag->javascriptinclude('js/jquery-1.9.0.js'); ?>
<div>
    <p>
        <label for="name">登录名（用户名或邮箱）：</label>
        <br>
        <?php echo $this->tag->textField("name") ?>
        <span class="error"><?php echo isset($nameError)?$nameError:'';?></span>
    </p>
    
    <p>
        <label for="password">密 码：</label>
        <br>
        <?php echo $this->tag->passwordField("password") ?>
        <span class="error"><?php echo isset($passwordError)?$passwordError:'';?></span>
    </p>

    <p>
        <label for="validate_code">验证码：</label>
        <img id="code" class="validate_code"  src="/validatecode/flush" onclick="this.src='/validatecode/flush?'+Math.random()"/>
        <br>
        <?php echo $this->tag->textField("validate_code") ?>
        <span class="error"><?php echo isset($validate_codeError)?$validate_codeError:'';?></span>
    </p>
    <p>
        <button onclick="layerlogin()">登 录</button>
        <a href="/signup/register">注 册</a>
    </p>

</form>
</div>
<script>
    function layerlogin(){
        $.ajax({
            url:'/signup/layerlogin',
            type:'post',
            data:{
                name:$('input[name="name"]').val(),
                password:$('input[name="password"]').val(),
                password_confirm:$('input[name="password_confirm"]').val(),
                validate_code:$('input[name="validate_code"]').val()
            },
            dataType:'json',
            success:function(re){
                if(re.status === 200){
                    parent.history.go(0);
                }else{
                    parent.layer.alert(re.message);
                }
            }
        });
    }
</script>

