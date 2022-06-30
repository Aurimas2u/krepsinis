<?php
include_once 'functions.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kašis vasara</title>
</head>
<body>
<style>
body{
    width: 760px;
    margin: 0 auto;
}
div{
    width: fit-content;
    margin: 0 auto;
}
</style>
<div>
    <a href="?page=standings">Standings</a>
    <a href="?page=game_history">Game History</a>
    <a href="?page=edit">Edit</a>
</div>
<hr>
<?php
if ($page === null) {
    include 'pages/standings.php';
} elseif ($page === 'edit') {
    include 'pages/edit.php';
} elseif ($page === 'standings') {
    include 'pages/standings.php';
} elseif ($page === 'game_history') {
    include 'pages/game_history.php';
}
?>
<br/><br/>
<hr>
<footer>Copyright ©Kašis vasara</footer>
</body>
</html>