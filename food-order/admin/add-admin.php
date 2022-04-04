<?php include("partials/menu.php"); ?>
 
<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>

        <br><br> 

        <?php 
            if(isset($SESSION['add'])) //Checking weather the session is set or not
            {
                echo $_SESSION['add'];//Displaying the session is set
                unset ($_SESSION['add']);//Remove session message
            }
        ?>
        <form action="" method="POST">

        <table class="tbl-30">
            <tr>
                <td>FULL NAME: </td>
                <td><input type="text" name="full_name" placeholder="Enter your name">
                </td>
            </tr>

            <tr>
                <td>USER NAME: </td>
                <td>
                    <input type="text" name='user_name' placeholder="Your Username">
                </td>
            </tr>

            <tr>
                <td>PASSWORD : </td>
                <td>
                    <input type="password" name='password' placeholder="Your Password">
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                </td>
            </tr>
        </table>
        </form>
    </div>
</div>

<?php include("partials/footer.php") ?>


<?php
    //process the value from Form and save it in Database

    //Check weather button is clicked otr not 

    if(isset($_POST['submit']))
    {
        // Button Clickeed
        //echo "Button Clicked";

        //1.Get data from form
        $full_name = $_POST['full_name'];
        $username = $_POST['user_name'];
        $password = md5($_POST['password']);

        //2.SQL Query to save data to database
        $sql = "INSERT INTO tbl_admin SET 
            full_name ='$full_name',
            user_name = '$username',
            password = '$password'
        "; 

       
        //3. Executing Query and saving data into database
        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

        //4.Check weather the data is inserted or not
        if($res==TRUE)
        {
            //data inserted
           // echo "Data inserted";  
           //create a session variable to display message
           $_SESSION['add'] = "<div class='success'>Admin Added Successfully</div>";
           //Redirect Page to Manage Admin
           header("location:".SITEURL.'admin/manage-admin.php ');
        }
        else
        {
            //failed to insert data
           // echo "failed to insert data";
            //create a session variable to display message
            $_SESSION['add'] = "<div class='error'>Failed To Add Admin</div>";
            //Redirect Page to Add Admin
            header("location:".SITEURL.'admin/add-admin.php ');
        }
    }

?>