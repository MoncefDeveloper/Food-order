<?php include("partials/menu.php") ?>
<!------------------------------------------------------->
<div class="main-content">
    <div class="left-spe">
        <h2 style="margin:1% 0;">Add Admin</h2>
        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td><input type="text" maxlength="50" name="full-name" placeholder="Enter Your Name"></td>
                </tr>

                <tr>
                    <td>UserName: </td>
                    <td><input type="text" maxlength="50" name="username" placeholder="Your UserName"></td>
                </tr>

                <tr>
                    <td>Password: </td>
                    <td><input type="password" name="password" placeholder="Your Password"></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" style="cursor:pointer;" name="submit" value="Add Admin" class="btn-secondary ">
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
    $password = sha1($_POST["password"]);
    $sql = "INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) VALUES (Null, '$full_name', '$userName', '$password');";
    echo $sql;

    include("PDO.php");


    $stmt = $db->prepare($sql);
    $stmt->execute();

    if ($stmt == true) {
        $_SESSION["add"] = "Admin Add Succefully";
        header("location:" . $GLOBALS["base_URL"] . "/admin/manage-admin.php");
        echo "DATA INSERTED";
    } else {
        $_SESSION["add"] = "Faile To Add Admin";
        header("location:" . $GLOBALS["base_URL"] . "/admin/add-admin.php");
        echo "DATA INSERTED";
        echo "Errer";
    }
}


?>