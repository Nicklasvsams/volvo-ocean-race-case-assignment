<?php
    // Sørger for at den individuelle session fortsat kører
    session_start();

    // Sørger for at der kan tilgås klasser og funktioner fra index.inc.php
    require('../includes/index.inc.php');
    
    // Tjekker hvorvidt admin er logget ind
    if(isset($_SESSION['username'])){
        if($_SESSION['username'] == "admin"){
            // Tjekker om en POST handling der matcher er foretaget
            if(isset($_POST['submit-admin'])){

                // Database forespørgsel der opdaterer et holds points
                $query = "UPDATE `boatscore` 
                SET `point` = ? 
                WHERE `holdnavn` = ?";

                // Initialiserer et statement
                $stmt = mysqli_stmt_init($db_connection);

                // Tjekker hvorvidt forespørgslen er gyldig
                if(!mysqli_stmt_prepare($stmt, $query)){
                    // Klient sendes til index hvis det ikke er
                    header("Location: ../index.php?error=sqlerror");
                    exit();
                }
                else{
                    // Binder parametre til statement og udfører forespørgslen for hvert hold
                    for ($i=0; $i < 5; $i++) { 
                        mysqli_stmt_bind_param($stmt, "ss", $_POST["boat".$i], $boats[$i]->name);

                        mysqli_stmt_execute($stmt);
                    }

                    // Klienten sendes til index
                    header("Location: ../index.php?success=tableupdated");
                    exit();
                }
            }
        }
    }
    else{
        // Klient sendes til index hvis de ikke er logget ind som admin
        header("Location: ../index.php?error=notadmin");
    }
?>