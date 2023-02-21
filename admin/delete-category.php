<?php 
    //include constants file
    include('../config/constants.php');


   // echo "Delete Page";
   //check whether the id and image_name value is set or not
   if(isset($_GET['id']) AND isset($_GET['image_name'])){

    //Get the value and Delete
    //echo "Get Value and Delete";
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    //Remove the Physical Image file is available 
    if($image_name != ""){
        //Image is available. so remove it
        $path = "../images/category/".$image_name;
        //Remove the image
        $remove = unlink($path);

        //if failed tp remove image then add an error message and stop the process 
        if($remove==false){
            //set the session message
            $_SESSION['remove'] = "<div class='error'>Failed to Remove Category Image.</div>";
            //redirect to manage category page
            header('location:'.SITEURL.'admin/manage-category.php');
            //stop the process
            die();
        }
    }

    //Delete data from database
    //SQL Query to Delete Data from Database
    $sql = "DELETE FROM tbl_category WHERE id=$id";

    //Execute the Query
    $res = mysqli_query($conn, $sql);

    //Check whether the data is delete from database or not
    if($res==true){
        //Set Success Message and Redirect
        $_SESSION['delete'] ="<div class='success'>Category Deleted Successfully.</div>";
        //Redirect to Manage Category
        header('location:'.SITEURL.'admin/manage-category.php');

    }
    else{
        //Set Fail Message and Redirect
        
        $_SESSION['delete'] ="<div class='error'>Failed to Delete Category.</div>";
        //Redirect to Manage Category
        header('location:'.SITEURL.'admin/manage-category.php');
    }

    //Redirect to Manage Category page with message



   }
   else{
        //redirect to manage category page
        header('location:'.SITEURL.'admin/manage-category.php');
   }
?>