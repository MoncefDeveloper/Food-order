<?php include("partials/menu.php");?>
    <!----------------------------------->
    <div class="main-content">
        <h1 >Manage Order</h1>
        <h1 style="color:red;">
            <?php 
                if(isset($_SESSION["delete-error-order"])){
                    echo $_SESSION["delete-error-order"];
                    unset($_SESSION["delete-error-order"]);
                }
                if(isset($_SESSION["drop-order"])){
                    echo $_SESSION["drop-order"];
                    unset($_SESSION["drop-order"]);
                }
                if(isset($_SESSION["update-order"])){
                    echo $_SESSION["update-order"];
                    unset($_SESSION["update-order"]);
                }

            ?>
        </h1>
        <div class="box1">

            <?php
                $x=1;
                $sql="SELECT * From tbl_order ORDER by order_date  ";
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $row2=$stmt->fetchAll();
                if (count($row2)>0) {
                    foreach ($row2 as $row ) {
                        $id=$row["id"];
                        $food=$row["food"];
                        $price=$row["price"];
                        $qty=$row["qty"];
                        $order_date=$row["order_date"];
                        $total=$row["total"];
                        $status=$row["status"];
                        $name=$row["customer_name"];
                        $number=$row["custome_contact"];
                        $email=$row["customer_email"];
                        $adress=$row["customer_adress"];
                        echo '
                            <div class="box2">
                                <h1>Number '.$x++.'</h1>
                                <div class="box3">
                                    <span class="bold">Food</span> : '.$food.'
                                </div>
                                <div class="box3">
                                    <span class="bold">Order Date</span> : '.$order_date.'
                                </div>
                                <div class="box3">
                                    <span class="bold">Status</span> : '.$status.'
                                </div>
                                <div class="box3">
                                    <span class="bold">Price</span> : '.$price.' DA
                                </div>
                                <div class="box3">
                                    <span class="bold">QTY</span> : '.$qty.'
                                </div>
                                <div class="box3">
                                    <span class="bold">Name</span> : '.$name.'
                                </div>
                                <div class="box3">
                                    <span class="bold">Number</span> : '.$number.'
                                </div>
                                <div class="box3">
                                    <span class="bold">Email</span> : '.$email.'
                                </div>
                                <div class="box3">
                                    <span class="bold">Adress</span> : '.$adress.'
                                </div>
                                <div class="box3 auto" >
                                    <span class="bold" >Total</span> : '.$total.' DA
                                </div>
                                <div class="action">
                                    
                                    <div class="btn-secondary2" >
                                        <a href="update-order.php?id='.$id.'"><span style="color:#fff;" >Update</a>
                                    </div>
                                    <div class="btn-danger2" >
                                        <a href="delete-order.php?id='.$id.'"><span style="color:#fff;" >Delete</a>
                                    </div>
                                </div>
                            </div>
                        ';
                    }
                }
                else {
                    echo '
                        <div class="nope">
                            Nothing Yet
                        </div>
                    ';
                }
            ?>
            
            
        </div>
    </div>
    <!----------------------------------->
<?php include("partials/footer.php");?>