<b>New Employee</b>

<form method="post">
    <input name="name" placeholder="First Name"><br>
    <input name="last_name" placeholder="Last Name"><br>
    Can
    work on multiple assignments at once<input type="checkbox" name="is_multitasker" value="1"><br>
    <button type="submit">Create</button>
</form>

<?php
$multitasker = $_POST['is_multitasker'] ?? null;
if (strlen($_POST['name'] ?? null) >= 3 && strlen($_POST['last_name']) >= 3) {
    echo "New Employee created successfully!";
    mysqli_query($database, 'insert into employees (name, last_name, is_multitasker) values ("' . $_POST['name'] . '", "' . $_POST['last_name'] . '", "' . $multitasker . '")');
}
?>