<?php $this->partial("shared/banner"); ?>
<div class="container">
<h1><?php echo $userinfo['name']; ?>的主页</h1>
<h3>好友申请</h3>
<?php if ($fapplys) { ?>
<ul>
  <?php foreach ($fapplys as $apply) { ?>
  <li><a href="/user/detail?name=<?php echo $apply['userName']; ?>" target="_blank"><?php echo $apply['userName']; ?></a><button onclick="passApply(<?php echo $apply['id']; ?>)">通过</button></li>
  <?php } ?>
</ul>
<?php } ?>
</div>

<h3>我的好友</h3>
<?php if ($myfs) { ?>
<ul>
  <?php foreach ($myfs as $f) { ?>
  <li><a href="/user/detail?name=<?php echo $f['userName']; ?>" target="_blank"><?php echo $f['userName']; ?></a></li>
  <?php } ?>
</ul>
<?php } ?>
</div>
<script>
    function passApply(rid){
       $.ajax({
            url:'/user/passfriend',
            type:'post',
            data:{id:rid},
            dataType:'json',
            success:function(re){
                if(re.status==500)
                    alert(re.message);
            }
            
        }); 
    }
    function addFriend(userId){
        $.ajax({
            url:'/user/addfriend',
            type:'post',
            data:{friendId:userId},
            dataType:'json',
            success:function(re){
                if(re.status==500)
                    alert(re.message);
                else
                    history.go(0);
            }
            
        });
    }
</script>
<?php $this->partial("shared/copyright"); ?>

