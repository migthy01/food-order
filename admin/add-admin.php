<?php 
    include('partials/menu.php');
    
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br/>
        <br/>

        <?php 
            if(isset($_SESSION['add'])){  //Checking whether the session is set or not
                echo $_SESSION['add']; // display the session message if set
                unset($_SESSION['add']); // remove session message
            }
        
        ?>



        <form action="" method="POST">

        <table class="tbl-30">

        <tr>
            <td>
                Full Name : 
            </td>
            <td><input type="text" name="full_name" placeholder="e.g. Priyanshu Dekate"></td>
        </tr>
        <tr>
            <td>
                Username : 
            </td>
            <td>
                <input type="text" name="username" placeholder="Your Username">
            </td>
        </tr>
        <tr>
            <td>Password :</td>
            <td><input type="password" name="password" placeholder="Your Password"></td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
            </td>
        </tr>
        </table>
        </form>
    </div>
</div>
<?php 
    include('partials/footer.php');
    
?>
<?php  
    //process the value from form and save it in databas
    //check whether the submit button is clicked or not
    if(isset($_POST['submit'])){
        // button clicked
       // echo "Button Clicked";
       
       //1. get the data fron the form
       $full_name = $_POST['full_name'];
       $username = $_POST['username'];
        $password = md5($_POST['password']); //password encrypted using md5

        //2. sql query to save data into database
        $sql = "INSERT INTO tbl_admin SET 
        full_name='$full_name',
        username='$username',
        password='$password'
        ";

        // echo $sql;
        // //3. execute query and save  data in database
        // $conn = mysqli_connect('localhost','root','') or die(mysqli_error());  //database connection
        // $db_select = mysqli_select_db($conn, 'food-order') or die(mysqli_errno()); //selecting database

        //3. executing query and saving data into database
       $res = mysqli_query($conn,$sql) or die(mysqli_query());

       //4. check whether the data(query is executed)is inserted or  not and display appropriate message
       if($res==TRUE){
         //Data inserted
         //echo "Data Inserted";
            //create a session variable to display messeage
            $_SESSION['add'] = "<div class='success'>Admin Added Successfully.</div>";
            //redirect page ro Manage Admin
            header("location:".SITEURL.'admin/manage-admin.php');
       }
       else{
            //failed to insert data
            //echo "failed to insert data";
                        //create a session variable to display messeage
                        $_SESSION['add'] = "<div class='error'>Failed to Add Admin.</div>";
                        //redirect page to Add Admin
                        header("location:".SITEURL.'admin/add-admin.php');
       }
    }
   
?>