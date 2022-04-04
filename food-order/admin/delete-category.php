<?php 

    //Include Constraints file
    include('../config/constants.php');

    //echo "delete page"; 
    //check wheather id and image_name value is set or not
    if(isset($_GET['id']) && isset($_GET['image_name']))
    {
        //get value and delete
        //echo "get value and delete"; 
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //remove the physical image file if available 
        if($image_name != "")
        {
            //image is available. remove it
            $path = "../images/category/".$image_name;
            //remove the image
            $remove = unlink($path);
            //if faild to remove image then add an error message and stop process
            if($remove == false)
            {
                //set session message
                $_SESSION['remove'] = "<div class='error'> Failed To Remove Cartegory Image </div>";
                //redirect to manage category page
                header('location: '.SITEURL.'admin/manage-category.php');
                //stop process
                die();
            }
        }
        //delete data from database
        //SQL Query delete datafrom database

        $sql = "DELETE FROM tbl_category WHERE id=$id";
        //Execute the Query
        $res = mysqli_query($conn, $sql);
        //check wheather data is deleted or not
        if($res==true)
        {
            //set success message and redirect
            $_SESSION['delete'] = "<div class = 'success'>Category Deleted Successfully</div> ";
            //redirect to Manage category
            header('location: '.SITEURL.'admin/manage-category.php');
        }
        else
        {
            //set failure message and redirect
            $_SESSION['delete'] = "<div class = 'errpr'>Failed To Delete Category</div> ";
            //redirect to Manage category
            header('location: '.SITEURL.'admin/manage-category.php');
        }

    }    
    else
    {
        //redirect to manage category page
        header('location: '.SITEURL.'admin/manage-category.php');
    }
?>
