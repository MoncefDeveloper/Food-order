<?php include("partials-front/menu-front.php") ?>
<?php
if (isset($_GET["id"])) {
    $id2 = $_GET["id"];
    if (is_numeric($id2)) {
        $id = $id2;
        $sql = "SELECT * FROM `tbl_category` WHERE `tbl_category`.`id` =$id ";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $row2 = $stmt->fetchAll();
        if (count($row2) == 1) {
            foreach ($row2 as $row) {
                $id = $row["id"];
                $title = $row["title"];
                if ($row['image_name'] == "" or $row['image_name'] == null) {
                    $image_name = "images/category-image/no-image.webp";
                } else {
                    $image_name = "images/category-image/" . $row['image_name'];
                    if (file_exists($image_name)) {
                        $image_name = $image_name;
                    } else {
                        $image_name = "images/category-image/no-image.webp";
                    }
                }
            }
        } else {
            header("location:" . $GLOBALS["base_URL"] . "/categories.php");
        }
    } else {
        header("location:" . $GLOBALS["base_URL"] . "/categories.php");
    }
} else {
    header("location:" . $GLOBALS["base_URL"] . "/categories.php");
}
?>
<!-- fOOD sEARCH Section Starts Here -->



<div class=" categories-big-img" style="background: url('<?php echo $image_name ?>') no-repeat center ;background-size: cover;">
</div>
<div class="categories-search">
    <div class="categories-content">
        <div class="title-one">
            <h2><?php echo $title ?></h2>
        </div>
        <div class="border-search">

            <?php
            $sql2 = "SELECT * from tbl_food where active='Yes' and category_id='$id'";
            $stmt2 = $db->prepare($sql2);
            $stmt2->execute();
            $row4 = $stmt2->fetchAll();
            if (count($row4) > 0) {
                foreach ($row4 as $row3) {
                    $food_id = $row3["id"];
                    $title = $row3["title"];
                    $price = $row3["price"];
                    $description = $row3["description"];

                    if ($row3['image_name'] == "" or $row3['image_name'] == null) {
                        $image_name = "images/food-image/no-image.webp";
                    } else {
                        $image_name = "images/food-image/" . $row3['image_name'];
                        if (file_exists($image_name)) {
                            $image_name = $image_name;
                        } else {
                            $image_name = "images/food-image/no-image.webp";
                        }
                    }
            ?>
                    <div class="card2 tran1">
                        <img src="<?php echo $image_name; ?>">
                        <div class="space-2">

                        </div>
                        <div class="content2">
                            <h1><?php echo $title; ?></h1>
                            <h3><?php echo $price; ?></h3>

                            <p><?php echo $description; ?></p>
                            <a href="order.php?id=<?php echo $food_id; ?>">ORDER NOW</a>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo '
                            <div class="nope">
                                Nothing for Today
                            </div>
                        ';
            }
            ?>

        </div>
    </div>

</div>

<?php include("partials-front/footer-front.php") ?>