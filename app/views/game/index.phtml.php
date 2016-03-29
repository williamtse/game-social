<?php $this->partial("shared/banner"); ?>
<?php echo $this->tag->javascriptInclude("js/jquery.raty.js")?>
<div class="container">
    <?php foreach ($games as $game){?>
    <div class="game-item">
        <a target="_blank" href="/game/detail?id=<?php echo $game['gameId']?>">
            <img src="/public/img/<?php echo $game['img'];?>" class="game-item-image">
        </a>
        <p><a target="_blank" href="/game/detail?id=<?php echo $game['gameId']?>"><?php echo $game['gameName']?></a></p>
        <div data-path="/public/js/img" id="star-<?php echo $game['gameId']?>"></div>
        <script>
            $('#star-<?php echo $game['gameId']?>').raty({
                path:'/public/js/img/',
                readOnly:  true,
                start: <?php echo $game['score']; ?>
            });
        </script>
    </div>
    <?php }?>
    <div class="clearBoth"></div>

<?php $this->partial("shared/copyright"); ?>
</div>