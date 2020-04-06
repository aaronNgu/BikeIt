<?php
require_once("./db.php");
$db = new DB();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql_user = "SELECT * FROM UserOne WHERE ID=" . $id;
    if (!$result = $db->query($sql_user)) {
        echo ("Fail to get user");
    }
    $user = mysqli_fetch_object($result);
    $user->Email;

    $sql_name = "SELECT Name FROM UserTwo WHERE Email=\"" . $user->Email . "\"";
    if (!$result = $db->query($sql_name)) {
        echo ("Fail to get name");
    }
    $username = mysqli_fetch_object($result);
} else if (isset($_POST['modify'])) {
    
    if (!empty($_POST['email'])) {
        $sql_update = "UPDATE UserOne SET Email=\"".$_POST['email']."\" WHERE ID=\"".$_POST['id']."\"";
        if ($db->query($sql_update)) {
            echo "Failed to update";
        }
    }

    $sql_email = "SELECT Email FROM UserOne WHERE ID=\"".$_POST['id']."\"";
    if(!$row = $db->query($sql_email)) {
        echo ("fail to get result");
    }
    $email = mysqli_fetch_object($row)->Email;
    if (!empty($_POST['name'])) {
        $sql_update = "UPDATE UserTwo SET Name=\"".$_POST['name']."\" WHERE Email=\"".$email."\"";
        if (!$db->query($sql_update)) {
            echo "Failed to update";
        }
    }
    
    header("Location:modifyuser.php");
} else {
    header("Location:modifyuser.php");
}
?>
<!DOCTYPE html>
<html>

<body>
    <?php echo ("<h2> Modifying user " . $username->Name . " with Email " . $user->Email . "</h2>"); ?>
    <?php echo "<form action=\"modify.php\" method=\"post\">";?>
        <input type="email" name="email" placeholder="Please enter an Email"></input>
        <input type="text" name="name" placeholder="Please enter a name"></input>
        <?php echo "<input type=\"hidden\" name=\"id\" value=$id></input>"?>
        <input type="submit" name="modify" value="modify"></input>
        <input type="submit" name="cancel" value="cancel"> </input>
    </form>

</body>

</html>