<?php include("partials/menu.php"); ?>
<!------------------------------------------------------->
<div class="main-content">
    <div class="left-spe">
        <h2 style="margin:1% 0;">Add Category</h2>
        <h1 style="margin:0 auto;color:red;">
            <?php
            if (isset($_SESSION["add-category"])) {
                echo $_SESSION["add-category"];
                unset($_SESSION["add-category"]);
            }
            if (isset($_SESSION["upload"])) {
                echo $_SESSION["upload"];
                unset($_SESSION["upload"]);
            }


            ?>
        </h1>
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-60">
                <tr>
                    <td>Title: </td>
                    <td><input maxlength="50" type="text" name="title" placeholder="Category Title"></td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td><input type="file" name="image"></td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input checked type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input checked type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary ">
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
    $title = $_POST["title"];
    if (isset($_POST["title"]) and $_POST["title"] != "") {
        $title = $_POST["title"];
    } else {
        $title = "Category X";
    }
    if (isset($_POST["featured"])) {
        $featured = $_POST["featured"];
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
            $ext = end(explode('.', $image_name));
            $image_name = "Food_Category_" . rand(0000, 9999) . '.' . $ext;
            $image = "../images/category-image/" . $image_name;
            $upload = move_uploaded_file($image_path, $image);
            if ($upload == false) {
                $_SESSION['upload'] = "Failed To Upload Image";
                header("location:" . $GLOBALS["base_URL"] . "/admin/add-category.php");
                die();
            }
        }

        //$image_size1=$_FILES["image"]["size"]; / $image_size=round($image_size1/(1024*1024),2) ." Mo";
    } else {
        $image_name = "";
    }

    $sql = "INSERT INTO `tbl_category` (`id`,`title`,`image_name`, `featured`, `active`) VALUES (Null, '$title','$image_name', '$featured', '$active');";

    $stmt = $db->prepare($sql);
    $stmt->execute();

    if ($stmt == true) {
        $_SESSION["add-category"] = "Category Add Succefully";
        header("location:" . $GLOBALS["base_URL"] . "/admin/category-manage.php");
    } else {
        $_SESSION["add-category"] = "Faile To Add Category";
        header("location:" . $GLOBALS["base_URL"] . "/admin/add-category.php");
    }
}
?>