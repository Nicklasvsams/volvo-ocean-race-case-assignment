<?php
    require("header.php");
?>

<main>
    <br>
    
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <?php
                    if(isset($_SESSION['username'])){
                        if($_SESSION['username'] == "admin"){
                            $user = $_SESSION['username'];
                            echo "<h3>$user <span class='red'>logged in</span></h3>";
                            echo "</div>";
                            echo "<br>";
                            echo "<div class='col-12 d-flex justify-content-center'>";
                            echo "<form action='includes/adminlogout.inc.php' method='post'>";
                            echo "<button class='btn btn-danger' type='submit' name='logout-submit'>Log out</button>";
                            echo "</form>";
                            echo "</div>"; 
                        }
                    }
                    else{
                        echo "<h3>Admin <span class='red'>login</span></h3>";
                        echo "</div>";
                        echo "</div>";
                        echo "<br>";
                        echo "<div class='row'>";
                        echo "<div class='col-12 d-flex justify-content-center'>";
                        echo "<br>";
                        echo "<div>";
                        echo "<form action='includes/adminlogin.inc.php' method='post' class='form-inline my-2 my-lg-0'>";
                        echo "<input class='form-control mr-sm-2' type='text' name='username' placeholder='Username...'>";
                        echo "<input class='form-control mr-sm-2' type='password' name='password' placeholder='Password...'>";
                        echo "<button class='btn btn-dark my-2 my-sm-0' name='submit-login' type='submit'>Login</button>";
                        echo "</form>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    };
                ?>
            
    </div>
</main>

<?php
    require("footer.php");
?>