<?php include("partials-front/menu-front.php") ?>
<?php
    if (isset($_GET["search"] )) {
        if ($_GET["search"]!="") {
            $search=$_GET["search"];
        }
        else {
            $search="Nothing";
        }
    }
    else {
        $search="Nothing";
    }
    
?>
    <!-- fOOD sEARCH Section Starts Here -->
    
        <div class="blur-food">
            <div class="all-foods">
                <div class="title-all-food">
                </div>
    
                <section class="food-search ">
                    <div class="container2">
                        
                        <form action="" method="POST">
                            <h1>FOODS ON YOUR SEARSH <h1 class="your-search"> "<?php echo $search?>"</h1> </h1>
                        </form>
            
                    </div>
                </section>
                <div class="all-foods2">
                    <div class="title-all-food">
                        <h2>RESULT</h2>
                    </div>
                    <div class="border-foods">
                    <?php
                        $sql="SELECT * from tbl_food where title like '%$search%' or `description` like '%$search%'" ;
                        $stmt=$db->prepare($sql);
                        $stmt->execute();
                        $row2=$stmt->fetchAll();
                        if (count($row2)>0) {
                            foreach ($row2 as $row ) {
                                $food_id=$row["id"];
                                $title=$row["title"];
                                $price=$row["price"];
                                $description=$row["description"];

                                if ($row['image_name']=="" or $row['image_name']==null ) {
                                    $image_name="images/food-image/no-image.webp";
                                }
                                else {
                                    $image_name="images/food-image/".$row['image_name'];
                                    if (file_exists($image_name)) {
                                        $image_name=$image_name;
                                    }
                                    else {
                                        $image_name="images/food-image/no-image.webp";
                                    }
                                }
                                ?>
                                
                                    <div class="card2 tran1">
                                        <img src="<?php echo $image_name; ?>" >
                                        <div class="space">
                                            
                                        </div>
                                        <div class="content2">
                                            <h1><?php echo $title;?></h1>
                                            <h3><?php echo $price;?></h3>
                    
                                            <p><?php echo $description;?></p>
                                            <a href="order.php?id=<?php echo $food_id;?>">ORDER NOW</a>
                                        </div>
                                    </div>
                                <?php
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
