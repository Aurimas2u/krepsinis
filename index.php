<?php
include_once 'functions.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kašis vasara</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet/less" type="text/css" href="styles.less" />
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<style>
    .cena {
        width: 75px;
        height: 50px;
    }
</style>
<div class="navigation">
    <nav class="navbar navbar-light bg-light fixed-top">
        <div class="container-fluid">
            <button
                    class="navbar-toggler fas fa-bars m-5"
                    type="button"
                    data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasNavbar"
                    aria-controls="offcanvasNavbar"
            >
                <span class="navbar-toggler-icon"></span>
            </button>
            <div
                    class="offcanvas offcanvas-end"
                    tabindex="-1"
                    id="offcanvasNavbar"
                    aria-labelledby="offcanvasNavbarLabel"
            >
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">
                        Kašis vasara
                    </h5>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                            <?php if(isLogged()){ ?>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="?page=standings">Standings</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="?page=game_history">Game History</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="?page=tournament_table">Tournament Table</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="?page=logout">Logout</a>
                        </li>
                        <?php if($_SESSION['name'] === 'aras'){ ?>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="?page=edit">Edit</a>
                            </li>
                        <?php }} ?>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</div>
<?php
if ($page === null) {
    include 'pages/login.php';
}
if (isLogged()){
 if ($page === 'edit') {
    include 'pages/edit.php';
} elseif ($page === 'standings') {
    include 'pages/standings.php';
} elseif ($page === 'game_history') {
    include 'pages/game_history.php';
} elseif ($page === 'tournament_table') {
    include 'pages/tournament_table.php';
} elseif ($page === 'logout') {
    session_destroy();
    header('Location: index.php');
}}
?>
<br/><br/>
<hr>
<footer>Copyright ©Kašis vasara</footer>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/less@4" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>