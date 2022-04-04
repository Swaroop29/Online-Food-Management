<?php 
    include('partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>

        <br><br>

        <?php
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['uplaod']);
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">

                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Title Of The Food">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" id="" cols="30" rows="5" placeholder="Description Of The Food"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
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
                                        $id = $row['id'];
                                        $title = $row['title'];

                                        ?>

                                            <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

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


                                //2.Display On Dropdown
                            ?>

                            
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>
            </table>


        </form>

        <?php

                //check wheather button is clicked or not
                if(isset($_POST['submit']))
                {
                    //Add food in database
                    //echo "clicked";

                    //1.Get the data from form 
                    $title = $_POST['title'];
                    $description = $_POST['description'];
                    $price = $_POST['price'];
                    $category = $_POST['category'];

                    //check wheather radio button for featured and active are checked or not
                    if(isset($_POST['featured']))
                    {
                        $featured = $_POST['featured'];
                    }
                    else
                    {
                        $featured = "No"; //setting default value
                    }

                    if(isset($_POST['active']))
                    {
                        $active = $_POST['active'];
                    }
                    else
                    {
                        $active = "No"; //setting default value
                    }

                    //2.Upload the image if selected
                    //check wheather select image is clicked or not and upload image if selected
                    if(isset($_FILES['image']['name']))
                    {
                        //get the details of the selected image
                        $image_name = $_FILES['image']['name'];

                        //check wheather image is selected or not and upload image only if selected
                        if($image_name!="")
                        {
                            //image is selected
                            //A. Rename the image
                            //get the extension of selected image

                            $ext = end(explode('.', $image_name));

                            //create new name for image
                            $image_name = "Food-Name-".rand(0000,9999).".".$ext; //create new image name 

                            //B. Upload the image
                            //get the source path and destination path

                            //source path is the current location of the image 
                            $src = $_FILES['image']['tmp_name'];

                            //Destination path for the image to be uploaded
                            $dest = "../images/food/".$image_name;

                            //finally upload food image
                            $upload = move_uploaded_file($src, $dest);

                            //check wheather image uploaded or not
                            if($upload==false)
                            {
                                //failed to upload image
                                //redirect to add food page with drop message
                                $_SESSION['upload'] = "<div class='error'>Failed To Upload Image</div>";
                                header('location'.SITEURL.'admin/add-food.php');

                                //Stop the process
                                die();
                            }
                        }
                    }
                    else
                    {
                        $image_name = ""; //Setting default value as blank
                    }
                    //3. Insert into Database

                    //create a SQL Query to save or add food

                    $sql2 = "INSERT INTO tbl_food SET
                             title = '$title',
                             description = '$description',
                             price = $price,
                             image_name = '$image_name',
                             category_id = '$category',
                             featured = '$featured',
                             active = '$active'
                             ";

                    //execute the query
                    $res2 = mysqli_query($conn, $sql2);
                    
                    //check wheather data inserted or not
                    //4.redirect with message to manage food page

                    if($res2 == true)
                    {
                        //data inserted successfully
                        $_SESSION['add'] = "<div class='success'>Added Successfully</div>";
                        header('location: '.SITEURL.'admin/manage-food.php');
                    }
                    else
                    {
                        //failed to insert data
                        $_SESSION['add'] = "<div class='error'>Failed To Added Food</div>";
                        header('location: '.SITEURL.'admin/manage-food.php');
                    }
                    

                }
        ?>


    </div>
</div>

<?php 
    include('partials/footer.php');
?>