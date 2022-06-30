<b>Pridėti žaidėją</b>

<form method="post">
    <input name="name" placeholder="Vardas pavardė"><br>
    <button type="submit">Create</button>
</form>

<?php
if (strlen($_POST['name'] ?? null)) {
    echo "Žaidėjas pridėtas";
//    mysqli_query($database, 'insert into employees (name, last_name, is_multitasker) values ("' . $_POST['name'] . '", "' . $_POST['last_name'] . '", "' . $multitasker . '")');
}
?>