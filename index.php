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

</style>
<div>
    <a href="index.php?page=standings">Standings</a>
    <a href="index.php?page=edit">Edit</a>
</div>
<hr>
<?php
if ($page === null) {
    include 'pages/standings.php';
} elseif ($page === 'edit') {
    include 'pages/edit.php';
}
?>
<br/><br/>
<hr>
<footer>Date: <?php echo date('Y-m-d h:i:s');?></footer>
</body>
</html>