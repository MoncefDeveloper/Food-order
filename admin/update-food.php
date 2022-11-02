<?php include("partials/menu.php") ?>
<?php
if (isset($_GET["id"])) {
    $id1 = $_GET["id"];
    if (is_numeric($id1)) {
        $id2 = $id1;
        $sql = "SELECT * from tbl_food where tbl_food.id=$id2";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $row2 = $stmt->fetchAll();
        if (count($row2) == 1) {
            foreach ($row2 as $row) {
                $id = $row["id"];
                $title_before = $row["title"];
                $description_before = $row["description"];
                $price_before = $row["price"];
                $featured_before = $row["featured"];
                $active_before = $row["active"];
                $category_id = $row["category_id"];

                $sql2 = "SELECT * from tbl_category where tbl_category.id=$category_id";
                $stmt2 = $db->prepare($sql2);
                $stmt2->execute();
                $row4 = $stmt2->fetchAll();
                if (count($row4) == 1) {
                    foreach ($row4 as $row3) {
                        $category_name_before = $row3["title"];
                    }
                } else {
                    $category_name_before = "Category X";
                }

                if ($row['image_name'] == "" or $row['image_name'] == null) {
                    $image_name = "../images/food-image/no-image.webp";
                } else {
                    $image_name = "../images/food-image/" . $row['image_name'];
                    if (file_exists($image_name)) {
                        $image_name = $image_name;
                    } else {
                        $image_name = "../images/food-image/no-image.webp";
                    }
                }
                //---------------------
                $image_name99 = $row["image_name"];
                //---------------------
                /*
                echo $id."<br>";
                echo $title_before."<br>";
                echo $description_before."<br>";
                echo $category_name_before."<br>";
                echo $price_before."<br>";
                echo $image_name99."<br>";
                echo $featured_before."<br>";
                echo $active_before."<br>";
                */
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

                <tr>
                    <td>(Before) Title: </td>
                    <td style="color:red;font-weight:bold;font-size:22px;">
                        "<?php echo $title_before; ?>"
                    </td>
                </tr>

                <tr class="hr-td">
                    <td>The New Title: </td>
                    <td> <input type="text" name="title" placeholder="Update The Title"></td>
                </tr>

                <!--------------------------------------------------------------------------------->

                <tr>
                    <td>(Before) Price: </td>
                    <td style="color:red;font-weight:bold;font-size:22px;">
                        "<?php echo $price_before . " DA" ?>"
                    </td>
                </tr>

                <tr class="hr-td">
                    <td>The New Price: </td>
                    <td> <input type="text" name="price" placeholder="Update Price"></td>
                </tr>

                <!--------------------------------------------------------------------------------->

                <tr>
                    <td>(Before) Description: </td>
                    <td style="color:red;font-weight:bold;font-size:22px;">
                        "<?php echo $description_before; ?>"
                    </td>
                </tr>

                <tr class="hr-td">
                    <td>The new Description: </td>
                    <td><textarea name="description" cols="23" rows="4" placeholder="Description Or Comment "></textarea></td>
                </tr>

                <!--------------------------------------------------------------------------------->

                <tr>
                    <td>(Before) Category: </td>
                    <td style="color:red;font-weight:bold;font-size:22px;">
                        "<?php echo $category_name_before ?>"
                    </td>
                </tr>

                <tr class="hr-td">
                    <td>The New Category: </td>
                    <td>
                        <select name="category" value="category">
                            <?php
                            $sql3 = 'SELECT * FROM `tbl_category` order by id desc';
                            $stmt3 = $db->prepare($sql3);
                            $stmt3->execute();
                            $row6 = $stmt3->fetchAll();

                            if ($row6 > 0) {
                                foreach ($row6 as $row5) {
                                    $name = $row5["title"] . "-" . $row5["id"];
                                    if ($category_name_before == $row5["title"]) {
                                        echo '
                                            <option selected value="' . $row5["id"] . '">' . $name . '</option>
                                        ';
                                    } else {
                                        echo '
                                            <option value="' . $row5["id"] . '">' . $name . '</option>
                                            ';
                                    }
                                }
                            } else {
                                echo '
                                    <option value="0">Empty</option>
                                    ';
                            }
                            ?>
                        </select>
                    </td>
                </tr>

                <!--------------------------------------------------------------------------------->

                <tr>
                    <td>(Before) Featured: </td>
                    <td style="color:red;font-weight:bold;font-size:22px;">"<?php echo $featured_before ?>"</td>
                </tr>

                <tr class="hr-td">
                    <td>The New Featured: </td>
                    <td>
                        <input <?php if ($featured_before == "Yes") {
                                    echo "checked";
                                } ?> type="radio" name="featured" value="Yes"> Yes
                        <input <?php if ($featured_before == "No") {
                                    echo "checked";
                                } ?> type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <!--------------------------------------------------------------------------------->
                <tr>
                    <td>(Before) Active: </td>
                    <td style="color:red;font-weight:bold;font-size:22px;">"<?php echo $active_before ?>"</td>
                </tr>

                <tr class="hr-td">
                    <td>The New Active: </td>
                    <td>
                        <input <?php if ($active_before == "Yes") {
                                    echo "checked";
                                } ?> type="radio" name="active" value="Yes"> Yes
                        <input <?php if ($active_before == "No") {
                                    echo "checked";
                                } ?> type="radio" name="active" value="No">No
                    </td>
                </tr>

                <!--------------------------------------------------------------------------------->

                <tr>
                    <td>(Before)Image</td>
                    <td><img src="<?php echo $image_name ?>" class="picture-circle"></td>
                </tr>

                <tr class="hr-td">
                    <td>Select The New Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
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

    if ($_POST["title"] == "" and $_POST["title"] == null) {
        $title_after = $title_before;
    } else {
        $title_after = $_POST["title"];
    }

    /*--------------------------------------*/

    if ($_POST["price"] == "" and $_POST["price"] == null) {
        $price_after = $price_before;
    } else {
        if (is_numeric($_POST["price"])) {
            $price_after = $_POST["price"];
        } else {
            $price_after = $price_before;
        }
    }

    /*--------------------------------------*/

    if ($_POST["description"] == "" and $_POST["description"] == null) {
        $description_after = $description_before;
    } else {
        $description_after = $_POST["description"];
    }

    /*--------------------------------------*/

    $category_id_after = $_POST["category"];

    /*--------------------------------------*/

    if (isset($_POST["featured"])) {
        $featured_after = $_POST["featured"];
    } else {
        $featured_after = $featured_before;
    }

    /*--------------------------------------*/

    if (isset($_POST["active"])) {
        $active_after = $_POST["active"];
    } else {
        $active_after = $active_before;
    }

    /*--------------------------------------*/

    if (isset($_FILES["image"]["name"])) {
        $image_path = $_FILES["image"]["tmp_name"];
        $image_name3 = $_FILES["image"]["name"];
        if ($image_name3 == "" || $image_name3 == null) {
            $image_name2 = $image_name99;
        } else {
            @$ext = end(explode('.', $image_name3));
            $image_name2 = "Food_" . rand(0000, 9999) . '.' . $ext;
            $image = "../images/food-image/" . $image_name2;
            $upload = move_uploaded_file($image_path, $image);
            if ($upload == false) {
                $_SESSION['upload-update-food'] = "Failed To Upload Image";
                echo "
                    <script> 
                        window.location='" . $GLOBALS["base_URL"] . "/admin/update-food.php?id=$id';
                    </script>
                    ";

                die();
            } else {
                $image_name100 = "../images/food-image/" . $image_name99;
                if (file_exists($image_name100)) {
                    $remove = unlink($image_name100);
                    if ($remove == false) {
                        $_SESSION["drop-image-food"] = "Faile To Drop Image";
                        die();
                    }
                }
            }
        }
        //$image_size1=$_FILES["image"]["size"]; / $image_size=round($image_size1/(1024*1024),2) ." Mo";
    } else {
        $image_name2 = $image_name99;
    }
    /*
        echo $title_after."<br>";
        echo $description_after."<br>";
        echo $price_after."<br>";
        echo $featured_after."<br>";
        echo $active_after."<br>";
        */

    $sql4 = "UPDATE tbl_food SET 
        title = '$title_after',
        `description`='$description_after',
        price='$price_after',
        image_name = '$image_name2',
        category_id='$category_id_after',
        featured ='$featured_after' ,
        active ='$active_after'
        WHERE tbl_food.id = $id";

    $stmt4 = $db->prepare($sql4);
    $stmt4->execute();

    if ($stmt4 == true) {
        $_SESSION["update-food"] = "Food Update Succefully";
        echo "
            <script> 
                window.location='" . $GLOBALS["base_URL"] . "/admin/food-mange.php';
            </script>
            ";
    } else {
        $_SESSION["update-food"] = "Faile To Update Category";
        echo "
            <script> 
                window.location='" . $GLOBALS["base_URL"] . "/admin/food-mange.php';
            </script>
            ";
    }
}

?>