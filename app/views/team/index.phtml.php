<div class="top"><?php $this->partial("shared/banner"); ?></div>
<?php echo $this->tag->javascriptInclude("js/jquery.raty.js")?>
<div class="container">
    <?php if(!empty($teams)) foreach ($teams as $team){?>
    <div class="game-item">
        <img src="/public/img/<?php echo $team['img']?>" class="item-image">
        <p><a href="/team/detail?id=<?php echo $team['id']?>"><?php echo $team['teamName']?></a></p>
    </div>
    <?php }?>
    <div class="clearBoth"></div>
</div>
<div class="top"><?php $this->partial("shared/copyright"); ?></div>
