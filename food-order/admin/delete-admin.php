<?php 

//Include constants.php file here
include('../config/constants.php');

//1.get id of admin to be deleted
$id = $_GET['id'];

//2.create sql Query to delete admin
$sql = "DELETE FROM tbl_admin WHERE id = $id";

//Execute the Query

$res = mysqli_query($conn, $sql);

//check weather query executed successfully or not 

if($res==true)
{
    //Query executed successfully
    //echo "Admin Deleted";
    //create session variable to display message
    $_SESSION['delete'] = "<div class  ='success'> Admin Deleted Successfully</div>";
    //Redirect to manage admin page
    header('location:'.SITEURL.'admin/manage-admin.php');
}
else
{
    //failed to delete admin
    //echo "Failed to delete admin";
    //create session variable to display message
    $_SESSION['delete'] = "<div class = 'error>Failed To Delete Admin</div>";
    //Redirect to manage admin page
    header('location:'.SITEURL.'admin/manage-admin.php');
}
//3.redirect to manage admin page with message (success / error)



?>