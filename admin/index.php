<?php
include('partials/menu.php');

?>




     <!-- main content section starts -->
        <div class="main-content">
        <div class="wrapper">

                   <h1>DASHBOARD</h1>
                   <br><br>
                   <?php 
                        if(isset($_SESSION['login'])){
                            echo $_SESSION['login'];
                            unset($_SESSION['login']);
        }
                     ?>
                     <br><br>

                    <div class="col-4 text-center">
                        <h1>4</h1>
                        <br>
                        Admin
                    </div>

                    <div class="col-4 text-center">
                        <h1>6</h1>
                        <br>
                        Categories
                    </div>

                    <div class="col-4 text-center">
                        <h1>11</h1>
                        <br>
                        Foods
                    </div>

                    <div class="col-4 text-center">
                        <h1>0</h1>
                        <br>
                        Orders
                    </div>

                    <div class="clearfix"></div>

                    
            </div>
        </div>
    <!-- main content section end -->

    <?php 
        include('partials/footer.php');
    
    ?>