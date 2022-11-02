<?php include("partials-front/menu-front.php") ?>

<div class="intro" style="background:url('images/Rest-images/simple2.webp') center no-repeat;height:100vh;background-size: cover;justify-content:center">
    <div class="symbol">
        <img src="images/1618672896262.png">
        <h2>LM & STORE</h2>
    </div>
</div>

<div class="Categories">
    <div class="title-Categories">
        <h2>EXPLORE CATEGORIES</h2>
    </div>
    <div class="big-box-Categories">
        <?php
        $sql = "SELECT * from tbl_category where tbl_category.active='Yes' and tbl_category.featured='Yes'  limit 2";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $row2 = $stmt->fetchAll();

        if (count($row2) > 0) {
            foreach ($row2 as $row) {
                $title = $row["title"];
                $id = $row["id"];
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

                echo '
                            <div class="box1-Categories" style="background-image: url(' . $image_name . ');">
                                <div class="border-categories">
                                    <h2>' . $title . '</h2>
                                    <a href="category-foods.php?id=' . $id . '" class="btn">
                                        CHEK CATEGORIES
                                    </a>
                                </div>
                            </div>
                    ';
            }
        } else {
            echo '
                        <div class="nope" style="width:100%;">
                            Nothing
                        </div>
                ';
        }

        ?>

    </div>

</div>

<div class="title-categories">
    <h2><a href="categories.php">SEE ALL CATEGORIES</a></h2>
</div>

<div class="title-foods">
    <h2>EXPLORE FOODS</h2>
</div>

<section>
    <div class="swiper-container">
        <div class="swiper-wrapper">

            <?php
            $sql2 = "SELECT * from tbl_food where tbl_food.active='Yes' and tbl_food.featured='Yes'  limit 6";
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

                    echo '
                                    <div class="swiper-slide" >
                                        <div class="card">
                                            <div class="face face1">
                                                <div class="content">
                                                    <img src="' . $image_name . '" >
                                                    <h3>' . $title . '</h3>
                                                </div>
                                            </div>
                                            <div class="face22 face2">
                                                <div class="content">
                                                    <h3>' . $price . ' DA</h3>
                                                    <p>
                                                       ' . $description . '
                                                    </p>
                                                    <a href="order.php?id=' . $food_id . '">ORDER NOW</a>
                                                </div>
                                            </div>
                                        </div>   
                                    </div>
                                    
                                    
                        ';
                }
            } else {
                echo '
                                <div class="nope">
                                    Nothing
                                </div>
                    ';
            }

            ?>




        </div>
        <div class="more">
            <a href="foods.php">
                <h2>SEE ALL FOOD </h2>
            </a>
        </div>
    </div>
</section>


<?php include("partials-front/footer-front.php") ?>