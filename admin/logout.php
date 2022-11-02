<?php
include("../admin/PDO.php");

session_destroy();
header("location:" . $GLOBALS["base_URL"] . "/admin/login.php");
