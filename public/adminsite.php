<?php
    // Henter header.php for at vise header elementet
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

    // Tjekker hvorvidt admin er logget ind
    if(isset($_SESSION['username'])){
        if($_SESSION['username'] == "admin"){

            // Tillader forbindelse til database
            require_once("../dbconnect.php");

            // Database forespørgsel (Henter alle rækker fra "boatscore" tabellen, sorteret efter point)
            $query = "SELECT * 
            FROM (boatscore) 
            ORDER BY (point) desc";

            // Initialiserer et database statement
            $stmt = mysqli_stmt_init($db_connection);
    
            // Tjekker hvorvidt forespørgslen er gyldig
            if(!mysqli_stmt_prepare($stmt, $query)){
                // Sender klienten til index hvis der er en fejl med databasen
                header("Location: index.php?error=sqlerror");
                exit();
            }
            else{
                // Eksekverer forespørgslen
                mysqli_stmt_execute($stmt);
    
                // Gemmer resultat i en variabel
                $result = mysqli_stmt_get_result($stmt);

                // Variabel bundet til "name" attribut i input element
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

                    // Tilføjer +1 for hvert loop
                    $id = $id + 1;
                }
            }
        }
    }
    else{
        // Sender klienten til index hvis de ikke er logget ind som admin
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
    // Henter footer.php for at vise footer elementet
    require('footer.php');
?>