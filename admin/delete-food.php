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

            $sql = "SELECT * FROM `tbl_food` WHERE `tbl_food`.`id` =$id ";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $row2 = $stmt->fetchAll();
            if (count($row2) == 1) {
                foreach ($row2 as $row) {
                    $image_name = $row["image_name"];
                }
                if ($row['image_name'] == "" or $row['image_name'] == null) {
                } else {
                    $image_name = "../images/food-image/" . $image_name;
                    if (file_exists($image_name)) {
                        $remove = unlink($image_name);
                        if ($remove == false) {
                            $_SESSION["drop-image"] = "Faile To Drop Image";
                            die();
                        }
                    }
                }
                $sql2 = "DELETE FROM `tbl_food` WHERE `tbl_food`.`id` = $id";
                $stmt2 = $db->prepare($sql2);
                $stmt2->execute();

                if ($stmt2 == true) {

                    header("location:" . $GLOBALS["base_URL"] . "/admin/food-mange.php");
                    $_SESSION["drop-food"] = "Drop Food Succefully";
                } else {
                    header("location:" . $GLOBALS["base_URL"] . "/admin/food-mange.php");
                    $_SESSION["drop-food"] = "Faile To Drop Food";
                }
            } else {
                header("location:" . $GLOBALS["base_URL"] . "/admin/food-mange.php");
                $_SESSION["delete-error-food"] = "Error To Pass The Value";
            }
        } else {
            header("location:" . $GLOBALS["base_URL"] . "/admin/food-mange.php");
            $_SESSION["delete-error-food"] = "Error To Pass The Value";
        }
    } else {
        header("location:" . $GLOBALS["base_URL"] . "/admin/food-mange.php");
        $_SESSION["delete-error-food"] = "Error To Pass The Value";
    }
}
