
<?php include('partials/menu.php');?>

<?php
ob_start();
    //check wheather id isset or not
    if(isset($_GET['id']))
    {
        //get all details
        $id = $_GET['id'];

        //SQL Query to get the selected folder
        $sql2 = "SELECT * FROM tbl_food WHERE id = $id";
        //execute Query
        $res2 = mysqli_query($conn, $sql2);

        //get the value based on query executed
        $row2 = mysqli_fetch_assoc($res2);

        //get individual values from selected food
        $title = $row2['title'];
        $description = $row2['description'];
        $price = $row2['price'];
        $current_image = $row2['image_name'];
        $current_category = $row2['category_id'];
        $featured = $row2['featured'];
        $active = $row2['active'];
    }
    else
    {
        //redirect to manage food
        header('location:'.SITEURL.'admin/manage-food.php');
    }
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br<br>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">

            <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>" placeholder="Title Of The Food">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" id=""  cols="30" rows="5" placeholder="Description Of The Food"><?php echo $description; ?> </textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                            if($current_image == "")
                            {
                                //image not available
                                echo "<div class='error'>Image Not Available</div>";
                            }
                            else
                            {
                                //image available
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width="150px">
                                <?php
                            }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>Select New Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category" >

                            <?php 
                                //Create php code to display categories from database
                                //1. Cereate SQL Query to get all active categories from database
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                                $res = mysqli_query($conn, $sql);
                                
                                //count rows to check wheather we have category or not
                                $count = mysqli_num_rows($res);

                                //if count>0 we have categories else we do not have category
                                if($count>0)
                                {
                                    //we have categories
                                    while($row = mysqli_fetch_assoc($res))
                                    {
                                        //get the details of category
                                         $category_title = $row['title'];
                                         $category_id = $row['id'];
                                       

                                        ?>

                                            <option <?php if($current_category==$category_id) {echo "selected";}?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>

                                        <?php
                                    }
                                }
                                else
                                {
                                    //we do not have categories
                                    ?>
                                    <option value="0">No Categories Found</option>
                                    <?php
                                }


                                
                            ?>

                            
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if($featured=="Yes") {echo "checked";}?> type="radio" name="featured" value="Yes"> Yes

                        <input <?php if($featured=="No") {echo "checked";}?> type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                    <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes"> Yes

                    <input <?php if($active=="No"){echo "Checked";} ?> type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2"> 
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                       
                        <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>
        <?php
            if(isset($_POST['submit']))
            {
                //echo "clicked";
                
                //1.Get the details from form
                $id = $_POST['id'];
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $current_image = $_POST['current_image'];
                $category = $_POST['category'];

                $featured = $_POST['featured'];
                $active = $_POST['active'];
            
                //2.upload image if selected

                //check whether upload button is clicked or not
                if(isset($_FILES['image']['name']))
                {
                    //upload button clicked
                    $image_name = $_FILES['image']['name']; //new image name

                    //check wheather file is available or not
                    if($image_name!="")
                    {
                        //image available
                        //A.upload a new image

                        //rename image
                        $ext = end(explode('.', $image_name)); //gets extension of image

                        $image_name = "Food-Name-".rand(0000, 9999).'.'.$ext; //this will be renamed image

                        //get the source path and destination path
                        $src_path = $_FILES['image']['tmp_name'];
                        $dest_path = "../images/food/".$image_name;

                        //upload the image
                        $upload = move_uploaded_file($src_path,$dest_path);

                        //check wheather image is uploaded or not
                        if($upload==false)
                        {
                            //failed to upload
                            $_SESSION['upload'] = "<div class='error>Failed to upload new image</div>";
                            //redirect to manage food
                            header('location:'.SITEURL.'admin/manage-food.php'); 
                            //stop the process
                            die();
                        }

                        //3.remove image if new image is uploaded and current image exist
                        //B.remove current image if available
                        if($current_image!="")
                        {
                            //current image available
                            //remove the image
                            $remove_path = "../images/food/".$current_image;

                            $remove = unlink($remove_path);

                            //check wheathr image is removed or not
                            if($remove==false)
                            {
                                //failed to remove current image
                                $_SESSION['failed-remove'] = "<div class='error>Failed to remove current image</div>";
                                //redirect to manage food
                                header('location:'.SITEURL.'admin/manage-food.php');
                                //stop the process
                                die();
                            }
                        }
                    }
                    else
                {
                    $image_name = $current_image;
                } 
                }
                else
                {
                    $image_name = $current_image;
                }


                //4. update the food in database
                $sql3 = "UPDATE tbl_food SET
                        title = '$title',
                        description = '$description',
                        price = $price,
                        image_name = '$image_name',
                        category_id = '$category',
                        featured = '$featured',
                        active = '$active'
                        WHERE id = $id
                ";

                //execute query
                $res3 = mysqli_query($conn, $sql3);

                //check wheather query is executed or not
                if($res3 == true)
                {
                    //query is executed
                    $_SESSION['update'] = "<div class='success'>Food Updated Successfully</div>";
                    header('location: '.SITEURL.'admin/manage-food.php');
                }
                else
                {
                    //failed to update food 
                    $_SESSION['update'] = "<div class='error'>Failed To Updated Food</div>";
                    header('location: '.SITEURL.'admin/manage-food.php');
                }

                //5.redirect to manage food with session message
            }
        ?>

    </div>
</div>





<?php include('partials/footer.php');?>