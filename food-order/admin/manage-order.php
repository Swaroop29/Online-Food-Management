<?php include("partials/menu.php")?>

<div class="main-content">
    <div class="wrapper">
    <h1>Manage Order</h1>

<br /><br/><br/>

<?php

    if(isset($_SESSION['update']))
    {
        echo $_SESSION['update'];
        unset($_SESSION['update']);   
    }

?>
<br><br>

<table width=100% >
    <tr>
        <th>S.N.</th>
        <th>Food</th>
        <th>Price</th>
        <th>Qty</th>
        <th>Total</th>
        <th>Order Date</th>
        <th >Status</th>
        <th>Customer Name</th>
        <th>Contact</th>
        <th>Email</th>
        <th>Address</th>
        <th>Actions</th>
    </tr>


    <?php 

        //get all orders from database
        $sql = "SELECT * FROM tbl_order ORDER BY id DESC";
        //execute query
        $res = mysqli_query($conn, $sql);
        //count rows
        $count = mysqli_num_rows($res);

        $sn = 1;
//create a serial number and set its initial value as 1
        if($count>0)
        {
            //order available
            while($row=mysqli_fetch_assoc($res))
            {
                //get all order details
                $id = $row['id'];
                $food = $row['food'];
                $price = $row['price'];
                $qty = $row['qry'];
                $total = $row['total'];
                $order_date = $row['order_date'];
                $status = $row['status'];
                $customer_name = $row['customer_name'];
                $customer_contact = $row['customer_contact'];
                $customer_email = $row['customer_email'];
                $customer_address = $row['customer_address'];

                ?>
                    <tr>
                        <td><?php echo $sn++; ?>. </td>
                        <td width=7%><?php echo $food; ?></td>
                        <td width=7%><?php echo $price; ?></td>
                        <td width=3%><?php echo $qty; ?></td>
                        <td width=7%><?php echo $total; ?></td>
                        <td width=10%><?php echo $order_date; ?></td>

                        <td width=8%>
                            <?php 
                                //Ordered, On Delivery, Delivered, Cancelled
                                if($status=="Ordered")
                                {
                                    echo "<label >$status</label>";
                                }
                               
                                else if($status=="On Delivery")
                                {
                                    echo "<label style = 'color: orange;'>$status</label>";
                                }
                               
                                else if($status=="Delivered")
                                {
                                    echo "<label style = 'color: green;'>$status</label>";
                                }
                               
                                else
                                {
                                    echo "<label style = 'color: red;'>$status</label>";
                                }
                            
                            ?>
                    </td>

                        <td width=12%><?php echo $customer_name; ?></td>
                        <td width=10%><?php echo $customer_contact; ?></td>
                        <td width=12%><?php echo $customer_email; ?></td>
                        <td width=10%><?php echo $customer_address; ?></td>
                        <td width=75%>
                            <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-secondary">Update Order</a>
                        </td>
                    </tr> 
                <?php

            }
        }
        else
        {
            //order not available
            echo "<tr><td colspan='12' class='error>Orders Not Available</td></tr>";
        }


    ?>

   


</table>
    </div>
</div>

<?php include("partials/footer.php")?>