<b>Pridėti žaidėją</b>

<form method="post">
    <input name="name" placeholder="Vardas pavardė"><br>
    <button type="submit">Create</button>
</form>
<?php
$players = mysqli_fetch_all(mysqli_query($database, 'select name from players'), MYSQLI_ASSOC);
    if (strlen($_POST['name'] ?? null)) {
        foreach ($players as $player){
            if ($player['name'] === $_POST['name']){
                $error = 'Zaidejas tokiu vardu jau uzregistruotas';
            }
        }
        if(!isset($error)) {
            mysqli_query($database, 'insert into players (name) value ("' . $_POST['name'] . '")');
            echo "Žaidėjas pridėtas";
        } else {
            echo $error;
        }
}
?>
</br>
<b>Pridėti match'a</b>

<form method="post" action="index.php?page=edit&create=new">
    <select name="player1_name">
        <?php foreach ($players as $player){ ?>
        <option value="<?php echo $player['name'] ?>"><?php echo $player['name'] ?></option>
       <?php } ?>
    </select>
    <input name="player1_score" placeholder="Score" type="number"><br>
    <select name="player2_name">
        <?php foreach ($players as $player){ ?>
            <option value="<?php echo $player['name'] ?>"><?php echo $player['name'] ?></option>
        <?php } ?>
    </select>
    <input name="player2_score" placeholder="Score" type="number"><br>
    <input type="date" name="date_played"><br>
    <button type="submit">Create</button>
</form>

<?php

if (isset($_GET['create'])){
    $player1 = $_POST['player1_name'] ?? null;
    $player2 = $_POST['player2_name'] ?? null;
    $player1_score = $_POST['player1_score'] ?? null;
    $player2_score = $_POST['player2_score'] ?? null;
    $date = $_POST['date_played'];
    if(isset($player1, $player2, $player1_score, $player2_score, $date) && $date > 0){
    if ($player1_score > $player2_score){
        $winner_name = $player1;
        $loser_name = $player2;
    } else {
        $winner_name = $player2;
        $loser_name = $player1;
    }
    $query1 = "insert into matches
    (player1_name, player2_name, player1_score, player2_score, winner_name, date_played)
     values
            ('$player1', '$player2', '$player1_score', '$player2_score', '$winner_name', '$date');";
    $query2 = "update players
set wins = wins+1
where name = '$winner_name'";
        $query3 = "update players
set loses = loses+1
where name = '$loser_name'";
    mysqli_query($database, $query1);
    mysqli_query($database, $query2);
    mysqli_query($database, $query3);
        echo "Matchas pridetas";
}else{
        echo "kazkas neivesta";
    }}
?>