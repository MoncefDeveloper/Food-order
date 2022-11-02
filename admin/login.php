<?php
include("../admin/PDO.php");
if (isset($_SESSION["user"])) {
    header("location:" . $GLOBALS["base_URL"] . "/admin/index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin.css">
    <title>Login</title>
</head>

<body>
    <div class="login">
        <div class="in-login">
            <div class="login-box">
                <h1>LOGIN</h1>
                <h4 style="margin:10px auto;color:red;">
                    <?php
                    if (isset($_SESSION["login"])) {
                        echo $_SESSION["login"];
                        unset($_SESSION["login"]);
                    }
                    if (isset($_SESSION["not_login"])) {
                        echo $_SESSION["not_login"];
                        unset($_SESSION["not_login"]);
                    }


                    ?>
                </h4>
                <!-----Form-Post----------->
                <form action="" method="post">
                    <p>UserName:</p>
                    <input type="text" name="username" placeholder="Enter Your UserName">
                    <br>
                    <p>Password:</p>
                    <input type="password" name="password" placeholder="Enter Your Password">
                    <br>
                    <input type="submit" name="submit" value="Login" class="btn-primary btn-new ">
                </form>
                <!---------------->
                <p>Created By - <a href="#">LM</a></p>
            </div>
        </div>
    </div>
</body>

</html>

<?php

if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $password = sha1($_POST["password"]);

    $sql = "SELECT * from tbl_admin where tbl_admin.username='$username' and tbl_admin.password='$password' ";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $row2 = $stmt->fetchAll();

    if (count($row2) == 1) {
        $_SESSION["login"] = "Login Successful";
        $_SESSION["user"] = $username; // to chek if user is logged or not

        header("location:" . $GLOBALS["base_URL"] . "/admin/index.php");
    } else {
        $_SESSION["login"] = "Username Or Password Not Match  ";
        header("location:" . $GLOBALS["base_URL"] . "/admin/login.php");
    }
}
?>