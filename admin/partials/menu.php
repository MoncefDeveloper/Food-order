<?php include("../admin/PDO.php"); ?>
<?php
if (!isset($_SESSION["user"])) {
    $_SESSION["not_login"] = "You Must Login To Access Admin Manage";
    header("location:" . $GLOBALS["base_URL"] . "/admin/Login.php");
}

?>
<!DOCTYPE html <html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Food Order Website - Home Page</title>
</head>

<body>
    <div class="menu">
        <div class="wrapper">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="manage-admin.php">Admin</a></li>
                <li><a href="category-manage.php">Category</a></li>
                <li><a href="food-mange.php">Food</a></li>
                <li><a href="orderd-manage.php">Orders</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>

    </div>