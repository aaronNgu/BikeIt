<?php
require_once("./db.php");
$db = new DB();
$sql_getUser = "SELECT * FROM UserOne";
$userone_result = $db->query($sql_getUser);

if (isset($_POST['modify'])) {
    if (isset($_POST['user'])) {
        header("Location:modify.php?id=".$_POST['user']);
    }
}
?>

<!DOCTYPE html>
<html>

<body>
    <h2>Modify a user</h2>
    <form action="modifyuser.php" method="post"> 
    <?php
        while ($user = mysqli_fetch_object($userone_result)) {
            $sql_name = "SELECT Name FROM UserTwo WHERE Email=\"".$user->Email."\"";
            $usertwo_result = $db->query($sql_name);
            $username = mysqli_fetch_row($usertwo_result)[0];

            echo "<input type=radio name=user value=" . $user->ID . ">";
            echo "<label>" . $user->Email . "</label> ";
            echo "&nbsp&nbsp";
            echo "<label>". $username. "</label>";
            echo "<br>";
        }
        ?>
        <input type=submit value=modify name=modify>
    </form>
</body>
</html>