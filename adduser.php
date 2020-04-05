<?php
require_once("./db.php");
$db = new DB();
$success = false;

if (isset($_POST['add'])) {

    $sql_insert = "INSERT INTO UserOne(Email) VALUES (\"" . $_POST['Email'] . "\")";
    if ($db->query($sql_insert)) {
        if (isset($_POST['Name'])) {
            $sql_insert = "INSERT INTO UserTwo(Email, Name) VALUES (\"" . $_POST['Email'] . "\",\"" . $_POST['Name'] . "\")";
            if (!$db->query($sql_insert)) {
                echo ("Failed to add user's name into the database");
            };
            $success = true;
        } else {
            $success = true;
        }
    } else {
        echo ("Failed to add user into the database");
    };
}
?>
<!DOCTYPE html>
<html>

<body>
    <div>
        <form action='adduser.php' method='post'>
            <h3>Add a user here </h3>
            <table>
                <tr>
                    <td>Email</td>
                    <td>
                        <input name="Email" type="email" required="required">
                    </td>
                </tr>
                <tr>
                    <td>Name</td>
                    <td>
                        <input name="Name" type="text">
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php
                        if (isset($_POST['add']) and $success) {
                            echo "User successfully added";
                        }
                        ?>
                    </td>
                </tr>
            </table>
            <input type="submit" name="add" value="add">
        </form>
    </div>
</body>

</html>