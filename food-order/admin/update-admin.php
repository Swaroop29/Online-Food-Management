<?php include('partials/menu.php');?>

<div class='main-content'>
    <div class='wrapper'>
        <h1>Update Admin</h1>

        <br><br>

        <?php
            //1. get the id of selected admin
            $id = $_GET['id'];

            //2. create sql Query to get the details
            $sql="SELECT * FROM tbl_admin WHERE id=$id";

            //Execute the Query
            $res = mysqli_query($conn, $sql);

            //check weather the query is executed or not
            if($res==TRUE)
            {
                //check weather data is available or not
                $count = mysqli_num_rows($res);
                //check weather we have admin data or not
                if($count==1)
                {
                    //get the details
                    //echo "Admin Available";
                    $row = mysqli_fetch_assoc($res);

                    $full_name = $row['full_name'];
                    $user_name = $row['user_name'];
                }
                else
                {
                    //redirect to manage admin page
                    header('location: '.SITEURL.'admin/manage-admin.php');
                }
            }
        ?>

        <form action="" method="POST">

        <table class="tbl-30">
            <tr>
                <td>FULL NAME: </td>
                <td>
                    <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                </td>
            </tr>

            <tr>
                <td>USER NAME: </td>
                <td>
                    <input type="text" name="user_name" value="<?php echo $user_name; ?>">
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                </td>
            </tr>
        </table>
        </form>
    </div>
</div>

<?php

            //check weather the submit button is clicked or not
            if(isset( $_POST['submit']))
            {
                //echo "button clicked";
                //get all the values from form to update
                 $id = $_POST['id'];
                 $full_name = $_POST['full_name'];
                 $username = $_POST['user_name'];

                 //create SQL Query to update Admin
                 $sql = "UPDATE tbl_admin SET
                 full_name = '$full_name',
                 user_name = '$user_name'
                 WHERE id = '$id'
                 ";

                 //execute query
                 $res = mysqli_query($conn, $sql);

                 //check weather the query is executed successfully or not
                if($res==true)
                {
                    //query executed and query updated
                    $_SESSION['update'] = "<div class = 'success'>Admin Updated Successfully</div>";
                    //redirect to manage admin page
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
                else
                {
                    //failed to update
                    $_SESSION['update'] = "<div class = 'error'>Failed to delete</div>";
                    //redirect to manage admin page
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }
?>


<?php include('partials/footer.php');?>