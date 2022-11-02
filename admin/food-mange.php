<?php include("partials/menu.php");?>
    <!----------------------------------->
    <div class="main-content">
        <div class="left ">
            <h2>Manage Food</h2>
            <h1 style="margin:0 auto;color:red;">
            <?php 
                if(isset($_SESSION["add-food"])){
                    echo $_SESSION["add-food"];
                    unset($_SESSION["add-food"]);
                }
                if(isset($_SESSION["delete-error-food"])){
                    echo $_SESSION["delete-error-food"];
                    unset($_SESSION["delete-error-food"]);
                }
                if(isset($_SESSION["drop-food"])){
                    echo $_SESSION["drop-food"];
                    unset($_SESSION["drop-food"]);
                }
                if(isset($_SESSION["update-food"])){
                    echo $_SESSION["update-food"];
                    unset($_SESSION["update-food"]);
                }

            ?>
            </h1>
            <a href="add-food.php" class="btn-primary">Add Food</a>
            <table class="tbl-full hr-td">
                <tr>
                    <th>S.N</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>featured</th>
                    <th>Active</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>

              

                <?php 
                    $X=1;
                    $sql="SELECT * FROM `tbl_food` ORDER BY id asc";
                    $stmt = $db->prepare($sql);
                    $stmt->execute();
                    $row2=$stmt->fetchAll();

                    if(count($row2)>0){
                        foreach ($row2 as $row ) {
                            $id=$row['id'];
                            $title=$row['title'];


                            $category_id=$row['category_id'];
                            $sql2="SELECT * from tbl_category where tbl_category.id=$category_id ORDER BY id desc ";
                            $stmt2 = $db->prepare($sql2);
                            $stmt2->execute();
                            $row4=$stmt2->fetchAll();
                            if(count($row4)==1){
                                foreach ($row4 as $row3) {
                                    $category_name=$row3["title"];
                                }
                            }
                            else {
                                $category_name="Category X";
                            }


                            if ($row['image_name']=="" or $row['image_name']==null ) {
                                $image_name="../images/category-image/no-image.webp";
                            }
                            else {
                                $image_name="../images/food-image/".$row['image_name'];
                                if (file_exists($image_name)) {
                                    $image_name=$image_name;
                                }
                                else {
                                    $image_name="../images/food-image/no-image.webp";
                                }
                            }


                            $price=$row['price'];
                            $description=$row['description'];
                            $featured=$row['featured'];
                            $active=$row['active'];
                            echo "
                            <tr>
                                <td>". $X++ .'.' ."</td>
                                <td>$title</td>
                                <td style='width:90px' ><img src='$image_name' width='100%' class='picture-circle'  ></td>

                                <td style='max-width:120px;max-height:90px;overflow-y:auto;'>$description</td>
                                <td>$category_name</td>
                                <td>$featured</td>
                                <td>$active</td>
                                <td>$price DA</td>
                                <td>    
                                <a href='update-food.php?id=". $id ."' class='btn-secondary'>Update Food</a><br><br>
                                <a href='delete-food.php?id=". $id ."' class='btn-danger'>Delete Food</a>
                                </td>
                                
                            </tr>
                            ";
                        }
                    }
                ?>


            </table>
        </div>
    </div>
    <!----------------------------------->
<?php include("partials/footer.php");?>