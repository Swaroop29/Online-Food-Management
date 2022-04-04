<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>CHANGE PASSWORD</h1>
        <br><br>

        <?php
            if(isset($_GET['id']))
            {
                $id=$_GET['id'];
            }
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Current Password: </td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current Password">
                    </td>
                </tr>

                <tr>
                    <td>New Password: </td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Password">
                    </td>
                </tr>

                <tr>
                    <td>Confirm Password: </td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>

<?php 
        //check wheather submit button is clicked or not
        if(isset($_POST['submit']))
        {
            //echo "Clicked;

            //1. Get the DATA from form
            $id=$_POST['id'];
            $current_password = md5($_POST['current_password']);
            $new_password = md5($_POST['new_password']);
            $confirm_password = md5($_POST['confirm_password']);


            //2. Check wheather user with current ID and current Password Exist or not
            $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password ='$current_password'";

            //Execute the Query
            $res = mysqli_query($conn, $sql);

            if($res==true)
            {
                //Check wheather data is available or not
                $count=mysqli_num_rows($res);

                if($count==1)
                {
                    //USER EXIST AND PASSWORD CAN BE CHANGED
                    // echo "User Found";

                    //check weather new password and confirm password match
                    if($new_password==$confirm_password)
                    {
                        //update password
                        $sql2 = "UPDATE tbl_admin SET
                            password = '$new_password'
                            WHERE id='$id'
                            ";

                            //Execute the Query
                            $res2 = mysqli_query($conn, $sql2);

                            //Check weather the query executed or not
                            if($res2==true)
                           {
                               //Display Success Message
                               //redirect to manage admin page with success message
                                $_SESSION['change-pwd'] = "<div class='success'>Password Changed Successfully </div>";
                                //Redirect user
                                header('location:'.SITEURL.'admin/manage-admin.php');
                           }
                           else
                           {
                                //Display Error Message
                                //redirect to manage admin page with error message
                                $_SESSION['change-pwd'] = "<div class='error'>Failed To Change Password </div>";
                                //Redirect user
                                header('location:'.SITEURL.'admin/manage-admin.php');
                           }
                    }
                    else
                    {
                        //redirect to manage admin page with error message
                        $_SESSION['pwd-not-match'] = "<div class='error'>Password Did Not Match </div>";
                        //Redirect user
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                }  
                else
                {
                    //user does not exist message and redirect
                    $_SESSION['user-not-found'] = "<div class='error'>User Not Found </div>";
                    //Redirect user
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }
            //3. Check weather the New Password and Confirm Password Match or not
            
            //4. Change Password if all above is true

        } 
?>
<?php include('partials/footer.php'); ?>