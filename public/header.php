<?php
    // Sørger for at session bliver bibeholdt
    session_start();

    // Tillader forbindelse til database
    require("../dbconnect.php");

    // Opretter et unikt cookie ID
    $cookie_name = uniqid();

    // Hvis klienten ikke har nogen cookies relaterede til denne side, oprettes en cookie
    if(count($_COOKIE) === 0){
        // Opretter en cookie for den givne klient
        setcookie($cookie_name, "value", time()+(34000+30), "/");

        // Database forespørgsel til at opdatere tæller
        $query_addcount = "UPDATE `counter` 
        SET `visits`= visits + 1
        WHERE visits = visits";

        // Initialiserer et database statement
        $stmt_addcount = mysqli_stmt_init($db_connection);

        // Tjekker hvorvidt forespørgslen er gyldig
        if(!mysqli_stmt_prepare($stmt_addcount, $query_addcount)){
            // Sender klienten til index hvis der er en fejl med databasen
            header("Location: index.php?error=sqlerror");
            exit();
        }
        else{
            // Eksekverer forespørgslen
            mysqli_stmt_execute($stmt_addcount);
        }

        // Sørger for at tidligere brugte statement bliver kasseret
        mysqli_stmt_close($stmt_addcount);
    };
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>The Ocean Race</title>
</head>
<body>

<header id="header">
    <nav class="navbar navbar-expand-lg navbar-dark d-flex justify-content-between">
        <a class="navbar-brand" href="index.php">
            <img id="logo" src="media/site-logo.png" alt="logo">
        </a>
        <?php
        // Viser et link til admin siden hvis admin er logget ind
        if(isset($_SESSION['username'])){
            if($_SESSION['username'] == "admin"){
                echo 
                '<a class="navbar-brand" href="adminsite.php">
                    Administrer <span class="red">hold</span>
                </a>';
            }
        }
        
            // Database forespørgsel
            $query = "SELECT visits FROM (counter)";

            // Initialiserer et database statement
            $stmt = mysqli_stmt_init($db_connection);

            // Tjekker hvorvidt forespørgslen er gyldig
            if(!mysqli_stmt_prepare($stmt, $query)){
                // Sender klienten til index hvis der er en fejl med databasen
                header("Location: index.php?error=sqlerror");
                exit();
            }
            else{
                // Eksekverer forespørgslent
                mysqli_stmt_execute($stmt);

                // Gemmer resultatet i en variabel
                $result = mysqli_stmt_get_result($stmt);

                if($row = mysqli_fetch_assoc($result)){
                    // Gemmer resultatet i en variabel og viser en tæller for unikke besøgende
                    $visitcount = (string)$row['visits'];
                    echo "<h2>Unikke besøgende: <span class='red'>$visitcount</span></h2>";
                }
            }

            // Sørger for at tidligere brugte statement bliver kasseret
            mysqli_stmt_close($stmt);
        ?>
    </nav>
</header> 