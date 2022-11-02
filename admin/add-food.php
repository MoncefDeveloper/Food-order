<?php include("partials/menu.php"); ?>
<!------------------------------------------------------->
<div class="main-content">
    <div class="left-spe">
        <h2 style="margin:1% 0;">Add Food</h2>
        <h1 style="margin:0 auto;color:red;">
            <?php
            if (isset($_SESSION["upload-food"])) {
                echo $_SESSION["upload-food"];
                unset($_SESSION["upload-food"]);
            }

            ?>
        </h1>
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-60">
                <tr>
                    <td>Title: </td>
                    <td><input maxlength="50" type="text" name="title" placeholder="Food Title"></td>
                </tr>

                <!--------------------------------------------------------------------------------->

                <tr>
                    <td>price: </td>
                    <td>
                        <input maxlength="9" type="number" name="price" placeholder="The Price">
                    </td>
                    <th class="error">
                        <?php
                        if (isset($_SESSION["no-price"])) {
                            echo $_SESSION["no-price"];
                            unset($_SESSION["no-price"]);
                        }
                        ?>
                    </th>
                </tr>

                <!--------------------------------------------------------------------------------->

                <tr>
                    <td>Description: </td>
                    <td><textarea name="description" cols="23" rows="4" placeholder="Description Or Comment "></textarea></td>
                    <th class="error">
                        <?php
                        if (isset($_SESSION["no-description"])) {
                            echo $_SESSION["no-description"];
                            unset($_SESSION["no-description"]);
                        }
                        ?>
                    </th>
                </tr>

                <!--------------------------------------------------------------------------------->

                <tr>
                    <td>Image: </td>
                    <td><input type="file" name="image"></td>
                </tr>

                <!--------------------------------------------------------------------------------->

                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category" value="category">
                            <?php
                            $sql = 'SELECT * FROM `tbl_category`';
                            $stmt = $db->prepare($sql);
                            $stmt->execute();
                            $row2 = $stmt->fetchAll();

                            if ($row2 > 0) {
                                foreach ($row2 as $row) {
                                    $name = $row["title"] . "-" . $row["id"];
                                    echo '
                                            <option value="' . $row["id"] . '">' . $name . '</option>
                                        ';
                                }
                            } else {
                                echo '
                                            <option value="0">Emty</option>
                                        ';
                            }
                            ?>
                        </select>
                    </td>
                </tr>

                <!--------------------------------------------------------------------------------->

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input checked type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <!--------------------------------------------------------------------------------->

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input checked type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <!--------------------------------------------------------------------------------->

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary ">
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
    if (isset($_POST["price"]) and $_POST["price"] != "" and is_numeric($_POST["price"])) {
        $price = $_POST["price"];

        if (isset($_POST["description"]) and $_POST["description"] != "") {
            $description = $_POST["description"];

            if (isset($_POST["title"]) and $_POST["title"] != "") {
                $title = $_POST["title"];
            } else {
                $title = "Food X";
            }

            $category = $_POST["category"];

            if (isset($_POST["active"])) {
                $featured = $_POST["active"];
            } else {
                $featured = "No";
            }

            if (isset($_POST["active"])) {
                $active = $_POST["active"];
            } else {
                $active = "No";
            }

            if (isset($_FILES["image"]["name"])) {
                $image_path = $_FILES["image"]["tmp_name"];
                $image_name = $_FILES["image"]["name"];

                if ($image_name == "" || $image_name == null) {
                    $image_name = "";
                } else {
                    @$ext = end(explode('.', $image_name));
                    $image_name = "Food_" . rand(0000, 9999) . '.' . $ext;
                    $image = "../images/food-image/" . $image_name;
                    $upload = move_uploaded_file($image_path, $image);
                    if ($upload == false) {
                        $_SESSION['upload-food'] = "Failed To Upload Image";
                        echo "
                                <script> 
                                    window.location='" . $GLOBALS["base_URL"] . "/admin/add-food.php';
                                </script>
                            ";
                        die();
                    }
                }
            } else {
                $image_name = "";
            }
            echo $title . "<br>";
            echo $price . "<br>";
            echo $description . "<br>";
            echo $category . "<br>";
            echo $image_name . "<br>";
            echo $active . "<br>";
            echo $featured . "<br>";

            $sql = "INSERT INTO `tbl_food` (`id`,`title`,`description`,`price`,`image_name`,`category_id`,`featured`,`active`) VALUES (Null, '$title','$description','$price','$image_name','$category','$featured','$active');";

            $stmt = $db->prepare($sql);
            $stmt->execute();

            if ($stmt == true) {
                $_SESSION["add-food"] = "Food Add Succefully";
                echo "
                    <script> 
                        window.location='" . $GLOBALS["base_URL"] . "/admin/food-mange.php';
                    </script>
                ";
            } else {
                $_SESSION["add-food"] = "Faile To Add Food";
                echo "
                    <script> 
                        window.location='" . $GLOBALS["base_URL"] . "/admin/food-mange.php';
                    </script>
                ";
            }
        } else {
            echo "
                    <script> 
                        window.location='" . $GLOBALS["base_URL"] . "/admin/add-food.php';
                    </script>
                ";
            $_SESSION["no-description"] = "Must Enter The Description";
        }
    } else {
        echo "
                <script> 
                    window.location='" . $GLOBALS["base_URL"] . "/admin/add-food.php';
                </script>
            ";
        $_SESSION["no-price"] = "Must Enter The Price Correctly";
    }

    /*
        

        */
}
?>