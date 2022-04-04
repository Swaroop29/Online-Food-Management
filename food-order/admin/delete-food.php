<?php
    //Include constant page
    include('../config/constants.php');

    //echo "delete food page";

    if(isset($_GET['id']) && isset($_GET['image_name']))
    {
        //process to delete
        //echo "Process To Delete";

        //1.Get ID and Image name
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //2.remove the image if available
        //check wheather image is available and delete if available
        if($image_name!= "")
        {
            //it has image
            //get the path
            $path = "../images/food/".$image_name;

            //remove image file from folder
            $remove = unlink($path);
            
            //check wheather image is removed or not
            if($remove==false)
            {
                //failed to remove image
                $_SESSION['upload'] = "<div class='error'>Failed To Remove Image File</div";
                //redirect to Manage food
                header('location:'.SITEURL.'admin/manage-food.php');
                //stop the process of deleting food
                die();
            }
        }

        //3.Delete Food from database
        $sql = "DELETE FROM tbl_food WHERE id=$id";
        //execute Query
        $res = mysqli_query($conn, $sql);

        //check wheather query executed or not and set the session message respectively
         //4.redirect to manage food with session message
        if($res==true)
        {
            //food deleted
            $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        else
        {
            //failed to delete
            $_SESSION['delete'] = "<div class='error'>Failed To Deleted Food</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
       
    }
    else
    {
        //redirect to manage
        //echo "Redirect";
        $_SESSION['unauthorize'] = "<div class = 'error'>Unauthorised Access</div>";
        header('location:'.SITEURL.'admi/manage-food.php');
    }
?>