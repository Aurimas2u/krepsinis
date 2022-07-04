<h1>Login</h1>
<form method="post">
    <table>
        <tr>
            <td>
                username:
            </td>
            <td>
                <input type="text" name="username">
            </td>
        </tr>
        <tr>
            <td>
                password:
            </td>
            <td>
                <input type="password" name="password">
            </td>
        </tr>
    </table>
    <br/><br/>
    <button type="submit">Hoop in</button>
</form>

<?php
$logins = mysqli_fetch_all(mysqli_query($database, 'select name, username, password from players'), MYSQLI_ASSOC);
if (isset($_POST['username'])) {
    if (isset($_POST['password'])){
        foreach ($logins as $login) {
            if ($login['username'] === $_POST['username'] && $login['password'] === md5($_POST['password'])) {
                $_SESSION['name'] = $login['name'];
                header('Location: index.php?page=standings');
            }
        }
    }
}

?>