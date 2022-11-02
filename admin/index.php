
<?php include("partials/menu.php"); ?>
    <!------------------------------------------------------->
    <div class="main-content">
        <div class="wrapper ">
            <h2 style="margin:10px auto;color:red;">
            <?php 
                if(isset($_SESSION["login"])){
                    echo $_SESSION["login"];
                    unset($_SESSION["login"]);
                }

            ?>
            </h2>
            <h1>DASHBOARD</h1>
            <div class="row">
                <div class="col-4">
                    <h1>
                        <?php 
                            $sql="SELECT * from tbl_category";
                            $stmt=$db->prepare($sql);
                            $stmt->execute();
                            $row=$stmt->fetchAll();
                            if (count($row)=="") {
                                echo "0";
                            }
                            else {
                                echo count($row);
                            }
                        ?>
                    </h1>
                    <p>Categories</p>
                </div>
                <div class="col-4">
                    <h1>
                        <?php 
                            $sql2="SELECT * from tbl_food ";
                            $stmt2=$db->prepare($sql2);
                            $stmt2->execute();
                            $row2=$stmt2->fetchAll();
                            if (count($row2)=="") {
                                echo "0";
                            }
                            else {
                                echo count($row2);
                            }
                        ?>
                    </h1>
                    <p>Foods</p>
                </div>
                <div class="col-4">
                    <h1>
                        <?php 
                            $sql3="SELECT * from tbl_order where tbl_order.status='ordered' ";
                            $stmt3=$db->prepare($sql3);
                            $stmt3->execute();
                            $row3=$stmt3->fetchAll();
                            if (count($row3)=="") {
                                echo "0";
                            }
                            else {
                                echo count($row3);
                            }
                        ?>
                    </h1>
                    <p>Total Orders</p>
                </div>
                <div class="col-4">
                    <h1>
                        <?php 
                            $sql4="SELECT sum(total) as Total from tbl_order where  tbl_order.status='delivered'";
                            $stmt4=$db->prepare($sql4);
                            $stmt4->execute();
                            $row4=$stmt4->fetchAll();
                            foreach ($row4 as $row5 ) {
                                $total=$row5["Total"];
                            }
                            if ($total=="") {
                                echo "0";
                            }
                            else {
                                echo $total;
                            }
                        ?>
                        DA
                    </h1>
                    <p>Revenue Generated</p>
                </div>
            </div>
            
        </div>
    </div>
    <!------------------------------------------------------->
<?php include("partials/footer.php"); ?>
    
