<?php $this->partial("shared/banner"); ?>
<?php echo $this->tag->javascriptinclude('js/jquery.js'); ?>
<div class="container">
<h1><?php echo $userinfo['name']; ?>的主页</h1>
    <a href="/team/add">
        创建战队
    </a> 

<div>
    <a href="/user/followers?id=<?php echo $userinfo['userId']; ?>">followers(<?php echo $followers; ?>)</a> |
    <a href="/user/followings?id=<?php echo $userinfo['userId']; ?>">followings(<?php echo $followings; ?>)</a>
</div>


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
</div>
<?php $this->partial("shared/footer"); ?>

