<?php $this->partial("shared/banner"); ?>
<div class="container">
<h1><?php echo $userinfo['name']; ?>的主页</h1>
<button onclick="addFriend(<?php echo $userinfo['userId']; ?>)">加好友</button>
</div>
<script>
    function addFriend(userId){
        $.ajax({
            url:'/user/addfriend',
            type:'post',
            data:{friendId:userId},
            dataType:'json',
            success:function(re){
                if(re.status==500)
                    alert(re.message);
            }
            
        });
    }
    </script>
<?php $this->partial("shared/copyright"); ?>

