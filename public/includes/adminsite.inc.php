<?php
    session_start();
    require('../includes/index.inc.php');
    
    if(isset($_SESSION['username'])){
        if($_SESSION['username'] == "admin"){
            if(isset($_POST['submit-admin'])){
                $query = "UPDATE `boatscore` SET `point` = ? WHERE `holdnavn` = ?";
                $stmt = mysqli_stmt_init($db_connection);

                if(!mysqli_stmt_prepare($stmt, $query)){
                    header("Location: ../index.php?error=sqlerror");
                    exit();
                }
                else{
                    for ($i=0; $i < 5; $i++) { 
                        mysqli_stmt_bind_param($stmt, "ss", $_POST["boat".$i], $boats[$i]->name);

                        mysqli_stmt_execute($stmt);
                    }

                    header("Location: ../index.php?success=tableupdated");
                    exit();
                }
            }
        }
    }
    else{
        header("Location: ../index.php?error=notadmin");
    }
?>