
<?php
include("PDO.php");

if (!isset($_SESSION["user"])) {
    $_SESSION["not_login"] = "You Must Login To Access Admin Manage";
    header("location:" . $GLOBALS["base_URL"] . "/admin/Login.php");
} else {
    $id = $_GET["id"];
    $sql = "DELETE FROM `tbl_admin` WHERE `tbl_admin`.`id` = $id";
    $stmt = $db->prepare($sql);
    $stmt->execute();

    if ($stmt == true) {
        header("location:" . $GLOBALS["base_URL"] . "/admin/manage-admin.php");
        $_SESSION["drop"] = "Drop Admin Succefully";
    } else {
        header("location:" . $GLOBALS["base_URL"] . "/admin/manage-admin.php");
        $_SESSION["drop"] = "Faile To Drop Admin";
    }
}



?>
