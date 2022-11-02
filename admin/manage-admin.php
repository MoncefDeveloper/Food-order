<?php include("partials/menu.php"); ?>
    <!------------------------------------------------------->
    <div class="main-content">
        <div class="left">
            <h2>Manage Admin</h2>
            <h1 style="margin:0 auto;color:red;">
            <?php 
                if(isset($_SESSION["add"])){
                    echo $_SESSION["add"];
                    unset($_SESSION["add"]);
                }
                if(isset($_SESSION["drop"])){
                    echo $_SESSION["drop"];
                    unset($_SESSION["drop"]);
                }
                if(isset($_SESSION["update"])){
                    echo $_SESSION["update"];
                    unset($_SESSION["update"]);
                }
                if(isset($_SESSION["update_password"])){
                    echo $_SESSION["update_password"];
                    unset($_SESSION["update_password"]);
                }
                if(isset($_SESSION["not-found"])){
                    echo $_SESSION["not-found"];
                    unset($_SESSION["not-found"]);
                }
                if(isset($_SESSION["user-not_found"])){
                    echo $_SESSION["user-not_found"];
                    unset($_SESSION["user-not_found"]);
                }
                
            ?>
            </h1>

            <a href="add-admin.php" class="btn-primary">Add Admin</a>
            <table class="tbl-full">
                <tr>
                    <th>S.N</th>
                    <th>Full Name</th>
                    <th>UserName</th>
                    <th>Actions</th>
                </tr>

           

                <?php 
                    $X=1;
                    $sql="SELECT * FROM `tbl_admin` ORDER BY id ";
                    $stmt = $db->query($sql);
                    if($stmt==true){
                        foreach ($stmt as $row ) {
                            $id=$row['id'];
                            $username=$row['username'];
                            $full_name=$row['full_name'];
                            echo "
                            <tr>
                                <td>". $X++ .'.'."</td>
                                <td>$full_name</td>
                                <td>$username</td>
                                <td>
                                    <a href='Change-Password.php?id=". $id ."' class='btn-primary'>Change Password</a>
                                    <a href='Update-Admin.php?id=". $id ."' class='btn-secondary'>Update Admin</a>
                                    <a href='Delete-Admin.php?id=". $id ."' class='btn-danger'>Delete Admin</a>
                                </td>
                            </tr>
                            ";
                        }
                        
                        
                    }
                ?>

            </table>
        </div>
    </div>
    <!------------------------------------------------------->
<?php include("partials/footer.php") ?>

