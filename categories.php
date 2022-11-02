<?php include("partials-front/menu-front.php") ?>

    <!-- CAtegories Section Starts Here -->

    <div class="blur-food">
        
        <div class="all-foods" >
            <div class="title-all-food">
                <h2>CATEGORIES</h2>
            </div>

            
            <div class="all-foods2">

                <div class="border-foods background-none" style="padding:0;border: none">

                <?php
                    $sql="SELECT * from tbl_category where tbl_category.active='Yes' ";
                    $stmt=$db->prepare($sql);
                    $stmt->execute();
                    $row2=$stmt->fetchAll();
                    
                    if (count($row2)>0) {
                        foreach ($row2 as $row ) {
                            $title=$row["title"];
                            $id=$row["id"];
                            if ($row['image_name']=="" or $row['image_name']==null ) {
                                $image_name="images/category-image/no-image.webp";
                            }
                            else {
                                $image_name="images/category-image/".$row['image_name'];
                                if (file_exists($image_name)) {
                                    $image_name=$image_name;
                                }
                                else {
                                    $image_name="images/category-image/no-image.webp";
                                }
                            }

                            echo '

                                <div class="box1-Categories space-box1-Categories" style="background-image: url('.$image_name.');">
                                    <div class="border-categories border-categories-all">
                                        <h2>'.$title.'</h2>
                                        <a href="category-foods?id='.$id.'" class="btn">
                                            CHEK CATEGORIES
                                        </a>
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
