<?php include("partials/menu.php");?>
    <!----------------------------------->
    <div class="main-content">
        <div class="left">
            <h2>Manage Category</h2>
            <h1 style="margin:0 auto;color:red;">
            <?php 
                if(isset($_SESSION["add-category"])){
                    echo $_SESSION["add-category"];
                    unset($_SESSION["add-category"]);
                }
                if(isset($_SESSION["drop-category"])){
                    echo $_SESSION["drop-category"];
                    unset($_SESSION["drop-category"]);
                }
                if(isset($_SESSION["drop-image"])){
                    echo $_SESSION["drop-image"];
                    unset($_SESSION["drop-image"]);
                }
                if(isset($_SESSION["drop-image-category"])){
                    echo $_SESSION["drop-image-category"];
                    unset($_SESSION["drop-image-category"]);
                }
                if(isset($_SESSION["delete-error"])){
                    echo $_SESSION["delete-error"];
                    unset($_SESSION["delete-error"]);
                }
                if(isset($_SESSION["update"])){
                    echo $_SESSION["update"];
                    unset($_SESSION["update"]);
                }

            ?>
            </h1>
            <a href="add-category.php" class="btn-primary">Add Category</a>
            
            <table class="tbl-full hr-td">
                <tr>
                    <th>S.N</th>
                    <th>Title</th>
                    <th style="white-space: nowrap;">Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                    
                </tr>

            

                <?php 
                    $X=1;
                    $sql="SELECT * FROM `tbl_category` order by id desc";
                    $stmt = $db->prepare($sql);
                    $stmt->execute();
                    $row2=$stmt->fetchAll();

                    if($row2>0){
                        foreach ($row2 as $row ) {
                            $id=$row['id'];
                            $title=$row['title'];
                            if ($row['image_name']=="" or $row['image_name']==null ) {
                                $image_name="../images/category-image/no-image.webp";
                            }
                            else {
                                $image_name="../images/category-image/".$row['image_name'];
                                if (file_exists($image_name)) {
                                    $image_name=$image_name;
                                }
                                else {
                                    $image_name="../images/category-image/no-image.webp";
                                }
                            }
                            $featured=$row['featured'];
                            $active=$row['active'];
                            echo "
                            <tr>
                                <td>". $X++ .'.' ."</td>
                                <td>$title</td>
                                <td style='width:90px' ><img src='$image_name' width='100%' class='picture-circle'  ></td>
                                <td>$featured</td>
                                <td>$active</td>
                                <td>    
                                <a href='update-category.php?id=". $id ."' class='btn-secondary'>Update Category</a>
                                <a href='delete-category.php?id=". $id ."' class='btn-danger'>Delete Category</a>
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