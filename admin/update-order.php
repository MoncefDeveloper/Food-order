<?php include("partials/menu.php") ?>
<?php
if (isset($_GET["id"])) {
    $id1 = $_GET["id"];
    if (is_numeric($id1)) {
        $id2 = $id1;
        $sql = "SELECT * from tbl_order where tbl_order.id=$id2";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $row2 = $stmt->fetchAll();
        if (count($row2) == 1) {
            foreach ($row2 as $row) {
                $id = $row["id"];
                $title = $row["food"];
                $price = $row["price"];
                $qty = $row["qty"];
                $status = $row["status"];
                $customer_name = $row["customer_name"];
                $custome_contact = $row["custome_contact"];
                $customer_email = $row["customer_email"];
                $customer_adress = $row["customer_adress"];
            }
        } else {
            header("location:" . $GLOBALS["base_URL"] . "/admin/food-mange.php");
        }
    } else {
        header("location:" . $GLOBALS["base_URL"] . "/admin/food-mange.php");
    }
} else {
    header("location:" . $GLOBALS["base_URL"] . "/admin/food-mange.php");
}
?>
<!------------------------------------------------------->
<div class="main-content">
    <div class="left-spe">
        <h2 style="margin:1% 0;">Update Food <?php echo "ID = " . $_GET["id"]; ?></h2>
        <h1 style="margin:0 auto;color:red;">
            <?php
            if (isset($_SESSION["upload-update-food"])) {
                echo $_SESSION["upload-update-food"];
                unset($_SESSION["upload-update-food"]);
            }


            ?>
        </h1>
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-60 ">

                <tr class="hr-td">
                    <td>Title: </td>
                    <td style="color:red;font-weight:bold;font-size:22px;">
                        "<?php echo $title; ?>"
                    </td>
                </tr>

                <!--------------------------------------------------------------------------------->

                <tr class="hr-td">
                    <td>Price: </td>
                    <td style="color:red;font-weight:bold;font-size:22px;">
                        "<?php echo $price . " DA"; ?>"
                    </td>
                </tr>

                <!--------------------------------------------------------------------------------->

                <tr>
                    <td>(Before) QTY: </td>
                    <td style="color:red;font-weight:bold;font-size:22px;">
                        "<?php echo $qty; ?>"
                    </td>
                </tr>

                <tr class="hr-td">
                    <td>The new Quantite : </td>
                    <td><input type="number" name="qty" placeholder="Update The QTY"></td>
                </tr>

                <!--------------------------------------------------------------------------------->

                <tr>
                    <td>(Before) Status: </td>
                    <td style="color:red;font-weight:bold;font-size:22px;">"<?php echo $status ?>"</td>
                </tr>

                <tr class="hr-td">
                    <td>The New Status: </td>
                    <td>
                        <select name="status">
                            <option <?php if ($status == "ordered") {
                                        echo "selected";
                                    } ?> value="ordered">Ordered</option>
                            <option <?php if ($status == "on delivery") {
                                        echo "selected";
                                    } ?> value="on delivery">On Delivery</option>
                            <option <?php if ($status == "delivered") {
                                        echo "selected";
                                    } ?> value="delivered">Delivered</option>
                            <option <?php if ($status == "cancelled") {
                                        echo "selected";
                                    } ?> value="cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>

                <!--------------------------------------------------------------------------------->

                <tr>
                    <td>(Before) Name: </td>
                    <td style="color:red;font-weight:bold;font-size:22px;">"<?php echo $customer_name ?>"</td>
                </tr>

                <tr class="hr-td">
                    <td>The New Name: </td>
                    <td>
                        <input type="text" name="name" placeholder="Update The Name">
                    </td>
                </tr>

                <!--------------------------------------------------------------------------------->

                <tr>
                    <td>(Before) Number: </td>
                    <td style="color:red;font-weight:bold;font-size:22px;">"<?php echo $custome_contact ?>"</td>
                </tr>

                <tr class="hr-td">
                    <td>The New Number: </td>
                    <td>
                        <input type="number" name="number" placeholder="Update The Number">
                    </td>
                </tr>


                <!--------------------------------------------------------------------------------->
                <tr>
                    <td>(Before) Email: </td>
                    <td style="color:red;font-weight:bold;font-size:22px;">"<?php echo $customer_email ?>"</td>
                </tr>

                <tr class="hr-td">
                    <td>The New Email: </td>
                    <td>
                        <input type="email" name="email" placeholder="Update The Email">
                    </td>
                </tr>


                <!--------------------------------------------------------------------------------->
                <tr>
                    <td>(Before) Adress: </td>
                    <td style="color:red;font-weight:bold;font-size:22px;">"<?php echo $customer_adress ?>"</td>
                </tr>

                <tr class="hr-td">
                    <td>The New Adress: </td>
                    <td><textarea name="adress" cols="23" rows="4" placeholder="Update The Adress "></textarea></td>
                </tr>


                <!--------------------------------------------------------------------------------->

                <tr>
                    <td colspan="2">
                        <input type="submit" style="cursor:pointer;padding:1% 4%;" name="submit" value="Update Food" class="btn-secondary ">
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

    $title;
    /*--------------------------------------*/

    $price;
    /*--------------------------------------*/

    if ($_POST["qty"] == "" && $_POST["qty"] == null) {
        $qty_after = $qty;
    } else {
        $qty_after = $_POST["qty"];
    }
    /*--------------------------------------*/

    $status_after = $_POST["status"];
    /*--------------------------------------*/

    if ($_POST["name"] == "" && $_POST["name"] == null) {
        $name_after = $customer_name;
    } else {
        $name_after = $_POST["name"];
    }
    /*--------------------------------------*/

    if ($_POST["number"] == "" && $_POST["number"] == null) {
        $number_after = $custome_contact;
    } else {
        $number_after = $_POST["number"];
    }
    /*--------------------------------------*/

    if ($_POST["email"] == "" && $_POST["email"] == null) {
        $email_after = $customer_email;
    } else {
        $email_after = $_POST["email"];
    }
    /*--------------------------------------*/

    if ($_POST["adress"] == "" && $_POST["adress"] == null) {
        $adress_after = $customer_adress;
    } else {
        $adress_after = $_POST["adress"];
    }
    /*--------------------------------------*/

    $total = $qty_after * $price;

    /*
        echo $title."<br>";
        echo $price."<br>";
        echo $qty_after."<br>";
        echo $total."<br>";
        echo $status."<br>";
        echo $name_after."<br>";
        echo $number_after."<br>";
        echo $email_after."<br>";
        echo $adress_after."<br>";
        */

    $sql4 = "UPDATE tbl_order SET 
        qty = '$qty_after',
        total='$total',
        `status`='$status_after',
        customer_name = '$name_after',
        custome_contact	='$number_after',
        customer_email ='$email_after' ,
        customer_adress	 ='$adress_after'
        WHERE tbl_order.id = $id";

    $stmt4 = $db->prepare($sql4);
    $stmt4->execute();

    if ($stmt4 == true) {
        $_SESSION["update-order"] = "Order Update Succefully";
        echo "
            <script> 
                window.location='" . $GLOBALS["base_URL"] . "/admin/orderd-manage.php';
            </script>
            ";
    } else {
        $_SESSION["update-order"] = "Faile To Update Order";
        echo "
            <script> 
                window.location='" . $GLOBALS["base_URL"] . "/admin/orderd-manage.php';
            </script>
            ";
    }
}

?>