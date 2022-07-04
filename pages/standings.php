<?php
$players = mysqli_fetch_all(mysqli_query($database, 'select name, wins, loses, hidden, wins-loses
from players
order by wins-loses DESC;'), MYSQLI_ASSOC);

//send to db hidden
$show = $_GET['show'] ?? null;
if (isset($_GET['hidden'])) {
    if (!$show) {
        mysqli_query($database, 'update players set hidden = 1 where name = "' . $_GET['hidden'] . '"');
    } elseif ($show) {
        mysqli_query($database, 'update players set hidden = 0 where name = "' . $_GET['hidden'] . '"');
    }
    header('Location: index.php?page=standings');
}

?>
    <table class="table table-dark table-striped">
        <thead>
        <tr>
            <th scope="col">Rank</th>
            <th scope="col">Name</th>
            <th scope="col">Win</th>
            <th scope="col">Loss</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($players as $player){ ?>
        <tr>
            <th scope="row"><?php $count++; echo $count?></th>
            <td><?php
                if ($player['hidden']){ ?>
                    <img class="cena" src="/img/cena.jpg">
                <?php } else{
                echo $player['name'];}
                ?></td>
            <td><?php
                if ($player['hidden']){ ?>
                    <img class="cena" src="/img/cena.jpg">
                <?php } else{
                echo $player['wins'];}
                ?></td>
            <td><?php
                if ($player['hidden']){ ?>
                    <img class="cena" src="/img/cena.jpg">
                <?php } else{
                echo $player['loses'];}
                ?></td>
            <td><?php
                if($player['name'] === $_SESSION['name']) {
                    if(!$player['hidden']){?>
                    <a class="btn btn-primary" href="index.php?page=standings&hidden=<?php echo $player['name']; ?>" role="button">Hide me</a>
                <?php } elseif ($player['hidden']){?>
                        <a class="btn btn-primary" href="index.php?page=standings&hidden=<?php echo $player['name']; ?>&show=true" role="button">Show me</a>
                    <?php }} ?>
                 <?php
                if($player['name'] != $_SESSION['name']) { ?>
                    <a class="btn btn-warning" href="index.php?page=standings&challenge=<?php echo $player['name']; ?>" role="button">Challenge</a>
                <?php } ?>
                </td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
