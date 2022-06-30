<?php
$history = mysqli_fetch_all(mysqli_query($database,"select * from matches"), MYSQLI_ASSOC);
?>

<div>
    <table>
        <tr>
        <th>ID</th>
        <th>Player 1</th>
        <th>Result</th>
            <th>Player 2</th>
        <th>Date</th>
        </tr>
        <?php
        foreach ($history as $match){ ?>
        <tr>
            <td><?php echo $match['id']?></td>
            <td <?php if ($match['player1_name'] === $match['winner_name']){ ?>style="color: green" <?php } else { ?> style="color: red" <?php } ?>><?php echo $match['player1_name']?></td>
            <td><?php echo $match['player1_score'] . ' - ' . $match['player2_score']?></td>
            <td <?php if ($match['player2_name'] === $match['winner_name']){ ?>style="color: green" <?php } else { ?> style="color: red" <?php } ?>><?php echo $match['player2_name']?></td>
            <td><?php echo $match['date_played']?></td>
        </tr>
        <?php } ?>
    </table>
</div>
