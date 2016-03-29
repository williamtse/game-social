<?php echo $this->partial('admin/devision_header'); ?>
<div class="leftList">
    <h3>游戏列表  <a href="javascript:void(0)" onclick="history.go(0)">刷新列表</a></h3>
    <p><a href="/admin/gamesadd" target="main">添加游戏</a></p>
    <?php if (!empty($games)) { ?>
        <ul>
            <?php foreach ($games as $game) { ?>
                <li>
                    <?php echo $game['gameName']; ?>
                    <a href="/admin/gamesedit?id=<?php echo $game['gameId'] ?>" target="main">编辑</a>
                </li>
            <?php } ?>
        </ul>
    <?php } ?>
</div>
