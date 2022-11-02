<?php include("partials/menu.php") ?>
<?php
$id2 = $_GET["id"];
if (is_numeric($id2)) {
    $id = $id2;
} else {
    $id = 0;
}
echo $id;
$sql = "SELECT * FROM `tbl_admin` WHERE `tbl_admin`.`id` =$id ";
$stmt = $db->prepare($sql);
$stmt->execute();
$row2 = $stmt->fetchAll();
if (count($row2) == 1) {
    foreach ($row2 as $row) {
        $username_before = $row['username'];
        $full_name_before = $row['full_name'];
    }
}


?>
<!------------------------------------------------------->
<div class="main-content">
    <div class="left-spe">
        <h2 style="margin:1% 0;">Update Admin <?php echo "ID = " . $_GET["id"]; ?></h2>
        <h1 style="margin:0 auto;color:red;">
            <?php
            if (isset($_SESSION["error"])) {
                echo $_SESSION["error"];
                unset($_SESSION["error"]);
            }


            ?>
        </h1>
        <form action="" method="post">
            <table class="tbl-60 ">

                <tr>
                    <td>(Before) Full Name: </td>
                    <td style="color:red;font-weight:bold;font-size:22px;">
                        "<?php if (isset($full_name_before)) {
                                echo $full_name_before;
                            } else {
                                echo "User Not Found";
                            }
                            ?>"
                    </td>
                </tr>

                <tr>
                    <td>The New Full Name: </td>
                    <td> <input type="text" name="full-name" placeholder="Update The Full-Name"></td>
                </tr>

                <tr>
                    <td>(Before) Username: </td>
                    <td style="color:red;font-weight:bold;font-size:22px;">
                        "<?php if (isset($username_before)) {
                                echo $username_before;
                            } else {
                                echo "User Not Found";
                            }
                            ?>"
                    </td>
                </tr>

                <tr>


                    <td>The New Username: </td>
                    <td> <input type="text" name="username" placeholder="Update The UserName"></td>
                </tr>


                <tr>
                    <td colspan="2">
                        <input type="submit" style="cursor:pointer;padding:1% 4%;" name="submit" value="Update Admin" class="btn-secondary ">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<!------------------------------------------------------->

<?php include("partials/footer.php") ?>

<?php

if (isset($_POST["submit"])) {
    $full_name = $_POST["full-name"];
    $userName = $_POST["username"];
    $sql = "UPDATE `tbl_admin` SET `full_name` = '$full_name', `username` = '$userName' WHERE `tbl_admin`.`id` = $id";

    if ($full_name == "" || $userName == "") {
        $_SESSION["error"] = "Faile To Update Admin";
        header("location:" . $GLOBALS["base_URL"] . "/admin/Update-Admin.php?id=$id");
    } else {
        $stmt = $db->prepare($sql);
        $stmt->execute();
        if ($stmt == true) {
            $_SESSION["update"] = "Admin Update Succefully";
            header("location:" . $GLOBALS["base_URL"] . "/admin/manage-admin.php");
        } else {
            $_SESSION["update"] = "Faile To Update Admin";
            header("location:" . $GLOBALS["base_URL"] . "/admin/add-admin.php");
        }
    }
}


?>