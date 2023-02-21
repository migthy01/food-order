<?php 

    //include constants.php file here
    include('../config/constants.php');



    //1. get the ID of admin to be deleted 
   $id = $_GET['id'];

    //2. Create SQl Query to Delete 
    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    //execute the query 
    $res = mysqli_query($conn,$sql);

    //check whether the query executed successfully or not
    

    if($res==true){
        //Query executed successfully and admin deleted
        //echo "Admin Deleted";
        //Create Session Variable to Display Msg
        $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully.</div>";
        //Redirect to Manage Admin Page
        header('location:'.SITEURL.'admin/manage-admin.php');
        
    }
    else{
        //failed to delete admin
        //echo "Failed to Delete Admin";
        $_SESSION['delete'] = "<div class='error'>Failed to Delete Admin. Try Again Later.</div>";

        header('location:'.SITEURL.'admin/manage-admin.php');

    }


    //3. Redirect to Manage Admin Page with message (success/error)
?>