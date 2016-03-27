<html>
    <head>
        <title>Game SNS</title>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <?php echo $this->tag->stylesheetLink("css/default.css"); ?>
            <?php echo $this->tag->javascriptInclude("js/jquery.js"); ?>
    </head>
    <body>
        <h1>Game SNS!</h1>
        <p><?php if(!$this->session->get('user-name')){ ?>
            <a href="/signup/register">注册</a> | <a href="/signup/login">登录</a>
            <?php }else{?>
            <a href="/myspace"><?php echo $userName; ?></a>  <a href="/signup/logout">退出</a>
            <?php }?>
        </p>
        <div class="nav">
            <ul>
                <li <?php if ($controllerName == 'index') { ?> class="curr" <?php } ?>><a href="/index">首页</a></li>
                <li <?php if ($controllerName == 'game') { ?> class="curr" <?php } ?>><a href="/game/index">游戏</a></li> 
                <li <?php if ($controllerName == 'team') { ?> class="curr" <?php } ?>><a href="/team/index">战队</a></li>
            </ul>
        </div>
        <div class="clearBoth"></div>