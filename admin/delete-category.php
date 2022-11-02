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
        } else {
            header("location:" . $GLOBALS["base_URL"] . "/admin/category-manage.php");
            $_SESSION["delete-error"] = "Error To Pass The Value";
        }
    } else {
        header("location:" . $GLOBALS["base_URL"] . "/admin/category-manage.php");
        $_SESSION["delete-error"] = "Error To Pass The Value";
    }

    $sql = "SELECT * FROM `tbl_category` WHERE `tbl_category`.`id` =$id ";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $row2 = $stmt->fetchAll();
    if (count($row2) == 1) {
        foreach ($row2 as $row) {
            $image_name = $row["image_name"];
        }
        if ($row['image_name'] == "" or $row['image_name'] == null) {
        } else {
            $image_name = "../images/category-image/" . $image_name;
            if (file_exists($image_name)) {
                $remove = unlink($image_name);
                if ($remove == false) {
                    $_SESSION["drop-image"] = "Faile To Drop Image";
                    die();
                }
            }
        }
        $sql2 = "DELETE FROM `tbl_category` WHERE `tbl_category`.`id` = $id";
        $stmt2 = $db->prepare($sql2);
        $stmt2->execute();

        if ($stmt2 == true) {

            header("location:" . $GLOBALS["base_URL"] . "/admin/category-manage.php");
            $_SESSION["drop-category"] = "Drop Category Succefully";
        } else {
            header("location:" . $GLOBALS["base_URL"] . "/admin/category-manage.php");
            $_SESSION["drop-category"] = "Faile To Drop Category";
        }
    } else {
        header("location:" . $GLOBALS["base_URL"] . "/admin/category-manage.php");
        $_SESSION["delete-error"] = "Error To Pass The Value";
    }
}
