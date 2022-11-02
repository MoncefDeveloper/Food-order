<?php include("partials-front/menu-front.php") ?>
<?php
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
                $id = $row["id"];
                $title = $row["title"];
                $price = $row["price"];
                if ($row['image_name'] == "" or $row['image_name'] == null) {
                    $image_name = "images/food-image/no-image.webp";
                } else {
                    $image_name = "images/food-image/" . $row['image_name'];
                    if (file_exists($image_name)) {
                        $image_name = $image_name;
                    } else {
                        $image_name = "images/food-image/no-image.webp";
                    }
                }
            }
        } else {
            header("location:" . $GLOBALS["base_URL"] . "/index.php");
        }
    } else {
        header("location:" . $GLOBALS["base_URL"] . "/index.php");
    }
} else {
    header("location:" . $GLOBALS["base_URL"] . "/index.php");
}
?>
<!-- fOOD sEARCH Section Starts Here -->

<div class="order-title" style="background:transparent; height: 140px;">
    <h2>FILL THIS FORM TO CONFIRM YOUR ORDER</h2>
</div>

<div class="order-food">
</div>

<div class="order-search">
    <div class="container">
        <form action="" class="order" method="post">
            <fieldset>
                <legend>SELECTED FOOD</legend>

                <div class="row">
                    <div class="food-menu-img">
                        <img src="<?php echo $image_name ?>" class="img-curve">
                    </div>

                    <div class="food-menu-desc">
                        <h3><?php echo $title ?></h3>
                        <p> <?php echo $price ?></p>

                        <div class="order-label">Quantity:</div>
                        <input type="number" name="qty" class="input-responsive counter" value="1" required>

                    </div>
                </div>

            </fieldset>

            <fieldset>
                <legend>DELIVERY DETAILS</legend>
                <div class="order-label">Full Name</div>
                <input type="text" name="full-name" placeholder="E.g. Moncef Lakehal" class="input-responsive input-margin" required>

                <div class="order-label">Phone Number</div>
                <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive input-margin" required>

                <div class="order-label">Email</div>
                <input type="email" name="email" placeholder="E.g. LM@Lakeal.com" class="input-responsive input-margin" required>

                <div class="order-label">Address</div>
                <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class=" input-margin" required></textarea>

                <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
            </fieldset>

        </form>
        <?php
        if (isset($_POST["submit"])) {

            $title;
            $price;
            $qty = $_POST["qty"];
            $total = $price * $_POST["qty"];
            echo $order_date = date("Y-m-d h:i:s");
            $status = "ordered";
            $customer_name = $_POST["full-name"];
            $custome_contact = $_POST["contact"];
            $customer_email = $_POST["email"];
            $customer_adress = $_POST["address"];



            $sql2 = "INSERT into tbl_order set
                            food='$title',
                            price='$price',
                            qty='$qty',
                            total='$total',
                            order_date='$order_date',
                            `status`='$status', 
                            customer_name='$customer_name',
                            custome_contact='$custome_contact',
                            customer_email='$customer_email',
                            customer_adress='$customer_adress'
                        ";
            $stmt2 = $db->prepare($sql2);
            $stmt2->execute();
            if ($stmt2 = true) {
                $_SESSION["order"] = "Food Ordered Succefully";
                echo "
                            <script> 
                                window.location='" . $GLOBALS["base_URL"] . "/index.php';
                            </script>
                            ";
            } else {
                $_SESSION["order"] = "Try Again";
                echo "
                            <script> 
                                window.location='" . $GLOBALS["base_URL"] . "/index.php';
                            </script>
                            ";
            }
        }
        ?>
    </div>
</div>
<?php include("partials-front/footer-front.php") ?>