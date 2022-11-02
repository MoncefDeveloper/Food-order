<?php
include("PDO.php");
if (!isset($_SESSION["user"])) {
    $_SESSION["not_login"] = "You Must Login To Access Admin Manage";
    header("location:" . $GLOBALS["base_URL"] . "/admin/Login.php");
} else {
    if (isset($_GET["id"])) {
        $id2 = $_GET["id"];
        if (is_numeric($id2)) {
            $id = $id2;

            $sql = "SELECT * FROM `tbl_order` WHERE `tbl_order`.`id` =$id ";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $row2 = $stmt->fetchAll();
            if (count($row2) == 1) {

                $sql2 = "DELETE FROM `tbl_order` WHERE `tbl_order`.`id` = $id";
                $stmt2 = $db->prepare($sql2);
                $stmt2->execute();

                if ($stmt2 == true) {

                    header("location:" . $GLOBALS["base_URL"] . "/admin/orderd-manage.php");
                    $_SESSION["drop-order"] = "Drop Order Succefully";
                } else {
                    header("location:" . $GLOBALS["base_URL"] . "/admin/orderd-manage.php");
                    $_SESSION["drop-order"] = "Faile To Drop Order";
                }
            } else {
                header("location:" . $GLOBALS["base_URL"] . "/admin/orderd-manage.php");
                $_SESSION["delete-error-order"] = "Error To Pass The Value";
            }
        } else {
            header("location:" . $GLOBALS["base_URL"] . "/admin/orderd-manage.php");
            $_SESSION["delete-error-order"] = "Error To Pass The Value";
        }
    } else {
        header("location:" . $GLOBALS["base_URL"] . "/admin/orderd-manage.php");
        $_SESSION["delete-error-order"] = "Error To Pass The Value";
    }
}
