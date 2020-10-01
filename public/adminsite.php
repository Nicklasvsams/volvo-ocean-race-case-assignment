<?php
    require('header.php');
?>

<main>
    <div class="container pt-4">
        <div class="row">
            <div class="col-sm d-flex justify-content-center">
                <h3>Administrer <span class="red">hold</span></h3>
            </div>
        </div>
    </div>

    <div class="container mt-3">
        <div class="row d-flex justify-content-center">
            <div class="col-sm-6">
                <form action='includes/adminsite.inc.php' method="post">
    <?php
    if(isset($_SESSION['username'])){
        if($_SESSION['username'] == "admin"){
            require_once("../dbconnect.php");

            $query = "SELECT * FROM (boatscore) ORDER BY (point) desc";
            $stmt = mysqli_stmt_init($db_connection);
    
            if(!mysqli_stmt_prepare($stmt, $query)){
                header("Location: ../public/index.php?error=sqlerror");
                exit();
            }
            else{
                mysqli_stmt_execute($stmt);
    
                $result = mysqli_stmt_get_result($stmt);
                $id = 0;
                while($row = $result->fetch_assoc()){
                    echo 
                    "<div class='form-group pt-3'>
                        <div class='row d-flex justify-content-center'>
                            <div class='col-sm-1 boatimgcol'>
                                <img class='adminboat' src='" . $row['imgpath'] . "' alt='brunel boat'>
                            </div>
                            <div class='col-sm-11'>
                                <label for='boatvalue1'>" . $row['holdnavn'] . "</label>
                                <input type='number' min='1' max='75' name='boat" . $id . "' class='form-control' value='" . $row['point'] . "'>
                            </div>
                        </div> 
                    </div>";

                    $id = $id + 1;
                }
            }
        }
    }
    else{
        header("Location: ../public/index.php?error=notadmin");
        exit();
    }
    ?> 
                    <button type="submit" name='submit-admin' class="btn btn-danger">Submit</button>
                </form>
            </div>
        </div>
    </div>
</main>

<?php
    require('footer.php');
?>