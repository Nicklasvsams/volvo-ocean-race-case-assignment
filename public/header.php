<?php
    session_start();
    require("/opt/lampp/htdocs/Nicklas/dbconnect.php");
    $cookie_name = uniqid();

    if(count($_COOKIE) === 0){
        setcookie($cookie_name, "value", time()+(34000+30), "/");

        
        $query_addcount = "UPDATE `counter` 
        SET `visits`= visits + 1
        WHERE visits = visits";

        $stmt_addcount = mysqli_stmt_init($db_connection);

        if(!mysqli_stmt_prepare($stmt_addcount, $query_addcount)){
            echo 'Fejl';
        }
        else{
            mysqli_stmt_execute($stmt_addcount);
        }

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
        if(isset($_SESSION['username'])){
            if($_SESSION['username'] == "admin"){
                echo 
                '<a class="navbar-brand" href="adminsite.php">
                    Administrer <span class="red">hold</span>
                </a>';
            }
        }
        
            $query = "SELECT visits FROM (counter)";
            $stmt = mysqli_stmt_init($db_connection);

            if(!mysqli_stmt_prepare($stmt, $query)){
                echo 'Fejl';
            }
            else{
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                if($row = mysqli_fetch_assoc($result)){
                    $visitcount = (string)$row['visits'];
                    echo "<h2>Unikke besøgende: <span class='red'>$visitcount</span></h2>";
                }
            }

            mysqli_stmt_close($stmt);
        ?>
    </nav>
</header> 