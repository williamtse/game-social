<?php $this->partial("shared/banner"); ?>
<?php echo $this->tag->javascriptInclude("js/jquery.raty.js")?>
<div class="container">
    <?php if(!empty($teams)) foreach ($teams as $team){?>
    <div class="game-item">
        <a href="/team/detail?id=<?php echo $team['id']?>" target="_blank">
            <img src="/public/img/<?php echo $team['img']?>" class="item-image">
        </a>
        <p>
            <a href="/team/detail?id=<?php echo $team['id']?>" target="_blank">
                <?php echo $team['teamName']?>
            </a>
        </p>
    </div>
    <?php }?>
    <div class="clearBoth"></div>

<?php $this->partial("shared/copyright"); ?>
</div>