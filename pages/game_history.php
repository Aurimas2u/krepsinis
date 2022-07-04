<?php
$history = mysqli_fetch_all(mysqli_query($database,"select * from matches"), MYSQLI_ASSOC);
?>
    <table class="table table-dark table-striped">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Player 1</th>
            <th scope="col">Result</th>
            <th scope="col">Player 2</th>
            <th scope="col">Date</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($history as $match){ ?>
            <tr>
            <th scope="row"><?php $count++; echo $count?></th>
            <td <?php if ($match['player1_name'] === $match['winner_name']){ ?>style="color: green"<?php } else { ?> style="color: red" <?php } ?>><?php echo $match['player1_name']?></td>
            <td><?php echo $match['player1_score'] . ' - ' . $match['player2_score']?></td>
            <td <?php if ($match['player2_name'] === $match['winner_name']){ ?>style="color: green" <?php } else { ?> style="color: red" <?php } ?>><?php echo $match['player2_name']?></td>
            <td><?php echo $match['date_played']?>
                </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php
