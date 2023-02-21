<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>
            Add Food
        </h1>

        <br><br><br>
        <?php
        if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        
        ?>
        <form action="" method="POST" enctype="multipart/form-data" >

        <table class="tbl-30">
            <tr>
                <td>Title: </td>
                <td>
                    <input type="text" name="title" placeholder="Title of the food">
                </td>
            </tr>
            <tr>
                <td>Description: </td>
                <td>
                    <textarea name="description"  cols="30" rows="5" placeholder="Description of the food."></textarea>
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
                        //1. Create sql query to get all active categories
                        $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                        //Execute Query
                        $res = mysqli_query($conn, $sql);

                        //count rows to check whether we have categories or not
                        $count = mysqli_num_rows($res);

                        //IF count is greater than 0, we have categories else we dont have categories
                        if($count>0){
                            //we have categories
                            while($row=mysqli_fetch_assoc($res)){
                                //get the details of categories
                                $id = $row['id'];
                                $title = $row['title'];
                                ?>
                                <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                <?php 
                            }
                        }
                        else{
                            //we donot have category
                            ?>
                            <option value="0">No Categories Found</option>
                            <?php
                        }



                        //2. Display on dropdown


                        ?>
                       

                    </select>
                </td>
            </tr>
            <tr>
                <td>Featured: </td>
                <td>
                    <input type="radio" name="featured" value="Yes">Yes
                    <input type="radio" name="featured" value="No">No

                </td>
            </tr>
            <tr>
                <td>Active: </td>
                <td>
                    <input type="radio" name="active" value="Yes">Yes
                    <input type="radio" name="active" value="No">No

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

            //check whether the button is clicked or not
            if(isset($_POST['submit'])){
                //Add the Food in Database
                // echo "Clicked";

                //1. Get the data from form
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];

                //check whether radio button for featured and active are checked or not

                if(isset($_POST['featured'])){
                    $featured = $_POST['featured'];
                }
                else{
                    $featured = "No"; //setting the default value

                }
                if(isset($_POST['active'])){
                    $active = $_POST['active'];
                }
                else{
                    $active= "No"; //setting the default value
                    
                }

                //2. upload the image if selected
                // check whether the select image is clicked ot not and upload the image only if the image is selected
                if(isset($_FILES['image']['name'])){

                    //get the details of the selected image
                    $image_name = $_FILES['image']['name'];

                    //Check Whether the image is selected or not and upload image only if selected
                    if($image_name!=""){
                        //Image is selected
                        //A. remane the image
                        //Get the extension of selected iamge (jpg, png, gif, etc.)
                        $ext = end(explode('.',$image_name));

                        //Create new name for iamge
                        $image_name = "Food_Name_".rand(000,999).'.'.$ext;

                        // $ext = end(explode('.',$image_name));

                        // //Rename the image
                        // $image_name = "Food_Category_".rand(000, 999).'.'.$ext; 

                        //B. Upload the Image

                        //Get the source path and destination patg

                        //source path is the current location of the image
                        $src = $_FILES['image']['tmp_name'];

                        //Destination Path for the image to be uploaded
                        $dst = "../images/food/".$image_name;

                        //Finally upload the food iamge

                        $upload = move_uploaded_file($src, $dst);

                        //Check whether image uploaded or not
                        if($upload==false){
                            //failed to upload
                            //Redirect to add food page with error message
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                            header('location:'.SITEURL.'admin/add-food.php');
                            //stop the process
                            die();

                        }
                    }

                }
                else{
                    $image_name = ""; // setting default value as blank
                }

                //3. insert into database

                //create a sql query to save or add food
                // for numerical value we do not need to pass value inside quotes '' but for string value it is compulsory to add quotes ''
                $sql2 = "INSERT INTO tbl_food SET
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = $category,
                    featured = '$featured',
                    active = '$active'
                ";

                //Execute the query
                $res2 = mysqli_query($conn, $sql2);
                //Check whether data inserted or not
                //4. redirect with message to manage food page


                if($res2 == true){
                    //data inserted successfully
                    $_SESSION['add'] = "<div class='success'>Food Added Successfully.</div>";
                    header('loaction:'.SITEURL.'admin/manage-food.php');

                }
                else{
                    $_SESSION['add'] = "<div class='error'>Failed to Add Food.</div>";
                    header('loaction:'.SITEURL.'admin/manage-food.php');
                }



            }
        
        
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>
