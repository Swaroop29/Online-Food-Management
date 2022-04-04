<?php include('partials/menu.php');?>

<div class="main-content">
<div class="wrapper">
    <h1>Add Category</h1>

    <br><br>

    <?php

    if(isset($_SESSION['add']))
    {
        echo $_SESSION['add'];
        unset ($_SESSION['add']);
    }

    if(isset($_SESSION['upload']))
    {
        echo $_SESSION['upload'];
        unset ($_SESSION['upload']);
    }

    ?>
    <br><br>
 
    <!--Add Category Form Starts-->  
    <form action="" method="POST" enctype="multipart/form-data">

    <table class="tbl-30">
        <tr>
            <td>Title: </td>
            <td>
                <input type="text" name="title" placeholder="Category Title">
            </td>
        </tr>

        <tr>
            <td>Select Image</td>
            <td>
                <input type="file" name = "image">  
                
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
                <input type="submit" name="submit" value="Add Category" class="btn-secondary">
            </td>
        </tr>
    </table>
    </form>
    <!--Add Category Form Ends-->  


    <?php 
    
    //check wheather submit button is clicked or not
    if(isset($_POST['submit']))
    {
       // echo"clicked";

       //1. Get value from our form
       $title = $_POST['title'];

       //For radio input type we need to check wheather button is selected or not
        if(isset($_POST['featured']))
        {
            // if button is selected get value from form 
            $featured = $_POST['featured'];
        }
        else
        {
            //set default value
            $featured = "No";
        }

        if(isset($_POST['active']))
        {
            $active = $_POST['active'];
        }
        else
        {
            $active = "No";
        }

        //check wheather image is selected or not and set a value for image name accordingly
        //print_r($_FILES['image']);

        //die();//break the code here

        if(isset($_FILES['image']['name']))
        {
            //Upload image
            //To upload image we need image name , source path and destination path
            $image_name = $_FILES['image']['name'];

            //upload image only if image is selected
            if($image_name!='')
            {


                //Auto rename our image
                //Get the extension of our image(jpg, png, gif) eg "food1.jpg"
                $ext = end(explode('.', $image_name));

                //rename image
                $image_name = "food_category_".rand(000, 999).'.'.$ext;

                $source_path = $_FILES['image']['tmp_name'];

                $destination_path = "../images/category/".$image_name;

                // Finally upload image
                $upload = move_uploaded_file($source_path, $destination_path);

                //check wheather image is uploaded or not
                //if image is not uploaded then we will stop the process and redirect with error message
                if($upload==false)
                {
                    //set message
                    $_SESSION['upload'] = "<div class = 'error'>Failed To Upload Image</div>";
                    //Redirect to add category page
                    header('location:'.SITEURL.'admin/add-category.php');
                    //stop the process
                    die();
                }

            }
        }
        else
        {
            //Don't upload image and set image name value as blank
            $image_name = "";
        }

        //2.Create SQL Query to Insert Category into Database
        $sql = "INSERT INTO tbl_category SET
                title = '$title',
                image_name = '$image_name',
                featured = '$featured',
                active = '$active'
                ";

                //3. Execute Query and save in database
                $res = mysqli_query($conn, $sql);

                //4.Check wheather Query executed and Data is added or not
                if($res==true)
                {
                    //Query executed and category added
                    $_SESSION['add'] = "<div class='success'>Category Added Successfully</div>";
                    //REdirect to Manage Category Page
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else
                {
                    //Failed to Add Category
                    $_SESSION['add'] = "<div class='error'>Failed To Add Category</div>";
                    //REdirect to Manage Category Page
                    header('location:'.SITEURL.'admin/add-category.php');
                }



    }

    ?>
</div>
</div>

<?php include('partials/footer.php');?>
