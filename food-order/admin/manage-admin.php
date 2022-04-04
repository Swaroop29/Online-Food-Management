<?php include("partials/menu.php"); ?>
       <!--Main Content Section Starts-->
       <div class="main-content">
        <div class="wrapper">
            <h1>Manage Admin</h1>
            
            <br/>


            <?php
                if(isset($_SESSION['add']))
                {
                        echo $_SESSION['add']; //Displaying session message
                        unset($_SESSION['add']); //Removing session message
                }

                if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete'];
                    unset ($_SESSION['delete']);
                }

                 if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }

                if(isset($_SESSION['user-not-found']))
                {
                    echo $_SESSION['user-not-found'];
                    unset($_SESSION['user-not-found']);
                }

                if(isset($_SESSION['pwd-not-match']))
                {
                    echo $_SESSION['pwd-not-match'];
                    unset($_SESSION['pwd-not-match']);
                }

                if(isset($_SESSION['change-pwd']))
                {
                    echo $_SESSION['change-pwd'];
                    unset($_SESSION['change-pwd']);
                }
            ?>
            <br/><br/><br/>

            <!--Button to Add Admin -->
            <a href="add-admin.php" class="btn-primary">Add Admin</a>

            <br /><br/><br/>

            <table width=100%>
                <tr>
                    <th>S.N.</th>
                    <th>FULL NAME</th>
                    <th>USER NAME</th>
                    <th>ACTIONS</th>
                </tr>


                <?php 
                    //Query to set all Admin
                    $sql="SELECT * FROM tbl_admin";
                    //Execute the Query
                    $res = mysqli_query($conn, $sql);

                    //checking weather a Query is executed or not
                    if($res==TRUE)
                    {
                        //Count Rows to check weather we have data in database or not
                        $rows = mysqli_num_rows($res);//Function to get all the rows in th database
                        
                        $sn = 1; //create avriable and asign 1
                        //check number of rows
                        if($rows>0)
                        {
                            //We have data in database
                            while($rows=mysqli_fetch_assoc(($res)))
                            {
                                //using while loop to get all the datab from database
                                //it will run as long as we have data in database

                                //get invalid data
                                $id=$rows['id'];
                                $full_name=$rows['full_name'];
                                $username=$rows['user_name'];

                                //display the values in our table
                                ?>

                                <tr>
                                    <td><?php echo $sn++;?> </td>
                                    <td><?php echo  $full_name;?></td>
                                    <td><?php echo $username;?></td>
                                    <td>               
                                    <a href="<?php echo SITEURL;?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">CHANGE PASSWORD</a>                                         
                                        <a href="<?php echo SITEURL;?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">UPDATE ADMIN</a>
                                        <a href="<?php echo SITEURL;?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">DELETE ADMIN</a>
                                    </td> 
                                 </tr>

                                <?php
                            }
                        }
                        else
                        {
                            //we dont have data in database
                        }


                    }
                ?>
               

            </table>
        </div>
    </div>

    <!--Main Content Section Ends-->

    <?php include("partials/footer.php"); ?>