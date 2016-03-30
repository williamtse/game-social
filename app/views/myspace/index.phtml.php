<?php $this->partial("shared/banner"); ?>
<?php echo $this->tag->javascriptinclude('js/jquery.js'); ?>
<div class="container">
<h1><?php echo $userinfo['name']; ?>的主页</h1>
<div class="space-left">
    <a href="/team/add">
        创建战队
    </a> 
    <div>
        <a href="/user/followers?id=<?php echo $userinfo['userId']; ?>">粉丝(<?php echo count($followers)?>)</a> |
        <a href="/user/followings?id=<?php echo $userinfo['userId']; ?>">关注(<?php echo count($followings)?>)</a>
    </div>
    
    <h3>我的战队</h3>
    <?php if ($myteams) { ?>
    <ul>
      <?php foreach ($myteams as $team) { ?>
      <li>
          <a href="/team/detail?id=<?php echo $team['id']; ?>" target="_blank">
              <img src="/public/img/thumb_<?php echo $team['img']; ?>" height="50">
          <br>
        <?php echo $team['teamName']; ?></a>
      </li>
      <?php } ?>
    </ul>
    <?php } ?>
    
    <h3>我的好友</h3>
    <?php if ($myfs) { ?>
    <ul>
      <?php foreach ($myfs as $f) { ?>
      <li>
        <a href="/user/detail?name=<?php echo $f['name']; ?>" target="_blank"><?php echo $f['name']; ?></a>
        <button onclick="unfollow(<?php echo $f['userId']; ?>)">取消关注</button>
      </li>
      <?php } ?>
    </ul>
    <?php } ?>
    
    <h3>粉丝</h3>
    <?php if ($followers) { ?>
    <ul>
      <?php foreach ($followers as $follower) { ?>
      <li>
        <a href="/user/detail?name=<?php echo $follower['name']; ?>" target="_blank"><?php echo $follower['name']; ?></a>
      </li>
      <?php } ?>
    </ul>
    <?php } ?>
    
    <h3>关注</h3>
    <?php if ($followings) { ?>
    <ul>
      <?php foreach ($followings as $following) { ?>
      <li>
        <a href="/user/detail?name=<?php echo $following['name']; ?>" target="_blank"><?php echo $following['name']; ?></a>
        <button onclick="unfollow(<?php echo $following['userId']; ?>)">取消关注</button>
      </li>
      <?php } ?>
    </ul>
    <?php } ?>
</div>
<div class="space-main">
    
</div>
</div>
<div class="clearBoth"></div>
<?php $this->partial("shared/footer"); ?>

