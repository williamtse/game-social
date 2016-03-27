<?php $this->partial("shared/banner"); ?>
<div id="login-form">
    <h2>Sign up using this form</h2>
    <?php echo $this->tag->form("signup/register"); ?>

    <p>
        <label for="name">Name</label>
        <?php echo $this->tag->textField("name") ?>
        <span class="error"><?php echo isset($nameError)?$nameError:'';?></span>
    </p>

    <p>
        <label for="email">E-Mail</label>
        <?php echo $this->tag->textField("email") ?>
        <span class="error"><?php echo isset($emailError)?$emailError:'';?></span>
    </p>
    
    <p>
        <label for="password">password</label>
        <?php echo $this->tag->passwordField("password") ?>
        <span class="error"><?php echo isset($passwordError)?$passwordError:'';?></span>
    </p>

    <p>
        <label for="password_confirm">Password-Confirm</label>
        <?php echo $this->tag->passwordField("password_confirm") ?>
        <span class="error"><?php echo isset($password_confirmError)?$password_confirmError:'';?></span>
    </p>
    <p>
        <label for="validate_code">Validate-Code</label>
        <img id="code" class="validate_code"  src="/validatecode/flush" onclick="this.src='/validatecode/flush?'+Math.random()"/>
        <?php echo $this->tag->textField("validate_code") ?>
        <span class="error"><?php echo isset($validate_codeError)?$validate_codeError:'';?></span>
    </p>
    <p>
        <?php echo $this->tag->submitButton("Register") ?>
        <a href="/signup/login">登 录</a>
    </p>

</form>
</div>

<?php $this->partial("shared/copyright"); ?>

