<?php include("partials-front/menu-front.php") ?>

    <!-- fOOD sEARCH Section Starts Here -->

        <div class="blur-food">

        <div class="all-foods">
            <div class="title-all-food title-all-food-1">
                <h2>ALL FOODS</h2>
            </div>

            <section class="food-search ">
                <div class="container2">
                    <form action="food-search" method="GET">
                        <input type="search" name="search_input" placeholder="Search for Food.." required>
                        <input type="submit" name="submit" value="searsh" class="btn-primary">
                    </form>
        
                </div>
            </section>
            <div class="all-foods2">
                <div class="title-all-food">
                    <h2>EXPLORE FOOD</h2>
                </div>
                <div class="border-foods">
                <?php
                    $sql2="SELECT * from tbl_food where tbl_food.active='Yes'";
                    $stmt2=$db->prepare($sql2);
                    $stmt2->execute();
                    $row4=$stmt2->fetchAll();
                    
                    if (count($row4)>0) {
                        foreach ($row4 as $row3 ) {
                            $food_id=$row3["id"];
                            $title=$row3["title"];
                            $price=$row3["price"];
                            $description=$row3["description"];

                            if ($row3['image_name']=="" or $row3['image_name']==null ) {
                                $image_name="images/food-image/no-image.webp";
                            }
                            else {
                                $image_name="images/food-image/".$row3['image_name'];
                                if (file_exists($image_name)) {
                                    $image_name=$image_name;
                                }
                                else {
                                    $image_name="images/food-image/no-image.webp";
                                }
                            }

                            echo '
                                <div class="card2 tran1">
                                    <img src="'.$image_name.'" >
                                    <div class="space-2">
                                    
                                    </div>
                                    <div class="content2">
                                        <h1>'.$title.'</h1>
                                        <h3>'.$price.' DA</h3>
                                        <p>'.$description.'</p>
                                        <a href="order.php?id='.$food_id.'">ORDER NOW</a>
                                    </div>
                                </div>
                            ';
                            
                        }

                    }
                    else {
                        echo '
                            <div class="nope">
                                Nothing
                            </div>
                        ';
                    }

                ?>
                    

                </div>
            </div>
            
        </div>
        </div>

<?php include("partials-front/footer-front.php") ?>
