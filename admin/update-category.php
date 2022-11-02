<?php include("partials/menu.php") ?>
<?php
if (isset($_GET["id"])) {
    $id1 = $_GET["id"];
    if (is_numeric($id1)) {
        $id2 = $id1;
        $sql = "SELECT * from tbl_category where tbl_category.id=$id2";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $row2 = $stmt->fetchAll();
        if (count($row2) == 1) {
            foreach ($row2 as $row) {
                $id = $row["id"];
                $title_before = $row["title"];
                $image_name = $row["image_name"];
                if ($row['image_name'] == "" or $row['image_name'] == null) {
                    $image_name = "../images/category-image/no-image.webp";
                } else {
                    $image_name = "../images/category-image/" . $row['image_name'];
                    if (file_exists($image_name)) {
                        $image_name = $image_name;
                    } else {
                        $image_name = "../images/category-image/no-image.webp";
                    }
                }
                //---------------------
                $image_name99 = $row["image_name"];
                //---------------------
                $featured_before = $row["featured"];
                $active_before = $row["active"];
            }
        } else {
            header("location:" . $GLOBALS["base_URL"] . "/admin/category-manage.php");
            $_SESSION["delete-error"] = "Error To Pass The Value-3";
        }
    } else {
        header("location:" . $GLOBALS["base_URL"] . "/admin/category-manage.php");
        $_SESSION["delete-error"] = "Error To Pass The Value-2";
    }
} else {
    header("location:" . $GLOBALS["base_URL"] . "/admin/category-manage.php");
    $_SESSION["delete-error"] = "Error To Pass The Value-1";
}
?>
<!------------------------------------------------------->
<div class="main-content">
    <div class="left-spe">

        <h2 style="margin:1% 0;">Add Category "<?php echo "=> $title_before" ?></h2>


        <h1 style="margin:0 auto;color:red;">
            <?php
            if (isset($_SESSION["upload-update"])) {
                echo $_SESSION["upload-update"];
                unset($_SESSION["upload-update"]);
            }
            ?>
        </h1>

        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-60">

                <tr>
                    <td>(Before) Title: </td>
                    <td style="color:red;font-weight:bold;font-size:22px;">"<?php echo $title_before ?>"</td>
                </tr>

                <tr class="hr-td">
                    <td>The New Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Update The Title">
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
                    <td colspan="2"><input type="submit" style="cursor:pointer;padding:1% 4%;" name="submit" value="Update Admin" class="btn-secondary "></td>
                </tr>
            </table>
        </form>
    </div>
</div>
<!------------------------------------------------------->
<?php include("partials/footer.php") ?>
<?php

if (isset($_POST["submit"])) {

    if (isset($_POST["title"]) and $_POST["title"] != "") {
        $title_after = $_POST["title"];
    } else {
        $title_after = $title_before;
    }

    if (isset($_POST["featured"])) {
        $featured_after = $_POST["featured"];
    } else {
        $featured_after = $featured_before;
    }

    if (isset($_POST["active"])) {
        $active_after = $_POST["active"];
    } else {
        $active_after = $active_before;
    }


    if (isset($_FILES["image"]["name"])) {
        $image_path = $_FILES["image"]["tmp_name"];
        $image_name3 = $_FILES["image"]["name"];
        if ($image_name3 == "" || $image_name3 == null) {
            $image_name2 = $image_name99;
        } else {
            @$ext = end(explode('.', $image_name3));
            $image_name2 = "Food_Category_" . rand(0000, 9999) . '.' . $ext;
            $image = "../images/category-image/" . $image_name2;
            $upload = move_uploaded_file($image_path, $image);
            if ($upload == false) {
                $_SESSION['upload-update'] = "Failed To Upload Image";
                echo "
                        <script> 
                            window.location='" . $GLOBALS["base_URL"] . "/admin/update-category.php?id=$id';
                        </script>
                        ";
                die();
            } else {
                $image_name100 = "../images/category-image/" . $image_name99;
                if (file_exists($image_name100)) {
                    $remove = unlink($image_name100);
                    if ($remove == false) {
                        $_SESSION["drop-image-category"] = "Faile To Drop Image";
                        die();
                    }
                }
            }
        }
        //$image_size1=$_FILES["image"]["size"]; / $image_size=round($image_size1/(1024*1024),2) ." Mo";
    } else {
        $image_name2 = $image_name99;
    }


    $sql = "UPDATE `tbl_category` SET `title` = '$title_after', `image_name` = '$image_name2',`featured` ='$featured_after' ,`active` ='$active_after' WHERE `tbl_category`.`id` = $id";


    $stmt = $db->prepare($sql);
    $stmt->execute();
    if ($stmt == true) {
        $_SESSION["update"] = "Category Update Succefully";
        echo "
            <script> 
                window.location='" . $GLOBALS["base_URL"] . "/admin/category-manage.php';
            </script>
            ";
    } else {
        $_SESSION["update"] = "Faile To Update Category";
        echo "
            <script> 
                window.location='" . $GLOBALS["base_URL"] . "/admin/category-manage.php';
            </script>
            ";
    }
}


?>