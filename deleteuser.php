<?php
require_once("./db.php");
$db = new DB();
$sql_getUser = "SELECT * FROM UserOne";
$userone_result = $db->query($sql_getUser);

if (isset($_POST['delete'])) {
    if (isset($_POST['user'])) {
        $user_email = $_POST['user'];
        $sql_delete = "DELETE FROM UserOne WHERE Email=\"" . $user_email . "\"";
        if ($db->query($sql_delete)) {
            header("Refresh:0");
        } else {
            echo ("Failed to delete user");
        }
    }
}
?>

<!DOCTYPE html>
<html>

<body>
    <h2>Delete a user </h2>
    <form action="deleteuser.php" method="post">

        <?php
        while ($user = mysqli_fetch_object($userone_result)) {
            echo "<input type=radio name=user value=" . $user->Email . ">";
            echo "<label>" . $user->Email . "</label>";
            echo "<br>";
        }
        ?>
        <input type=submit value=delete name=delete>;
    </form>
</body>

</html>