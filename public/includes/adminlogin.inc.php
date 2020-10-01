<?php
// Tjekker hvorvidt at der er blevet sendt en "POST" forespørgsel
if (isset($_POST['submit-login'])){
    
    // Sørger for at der kan oprettes forbindelse til databasen
    require_once("../../dbconnect.php");

    // Gemmer brugernavn og kodeord i variabler
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Tjekker hvorvidt at brugernavn eller kodeord er tomt
    if (empty($username) || empty($password)){
        // Sørger for at der ikke køres mere kode fra denne fil
        header("Location: ../adminlogin.php?error=emptyfields");
        exit();
    }
    else{
        // SQL forespørgsel der vælger alt (*) fra "login" tabel hvor brugernavnet er lig det indtastede brugernavn
        $query = "SELECT * FROM `admin-user` WHERE adminnavn=?";
        $stmt = mysqli_stmt_init($db_connection);

        // Tjekker hvorvidt forespørgslen er gyldig
        if(!mysqli_stmt_prepare($stmt, $query)){
            header("Location: ../adminlogin.php?error=sqlerror");
            exit();
        }
        else{
            // Binder brugernavns variablen til forespørgsels parameter
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);

            // Udfører forespørgslen og gemmer data i $result
            $result = mysqli_stmt_get_result($stmt);

            // Tjekker om der er et resultat fra databasen
            if ($row = mysqli_fetch_assoc($result)){

                // Tjekker hvorvidt det indtastede kodeord matcher det i databasen
                $pwdCheck = password_verify($password, $row['kodeord']);
                if ($pwdCheck == false){
                    // Hvis ikke, sendes brugeren tilbage til forsiden med en fejlmeddelelse
                    // og koden slutter med at køre fra denne fil
                    header("Location: ../adminlogin.php?error=wrongpw");
                    exit();
                }
                else if ($pwdCheck == true){
                    // Hvis kodeordet er gyldigt oprettes en session
                    session_start();
                    $_SESSION['username'] = $row['adminnavn'];

                    header("Location: ../index.php?login=success");
                    exit();
                }
                else{
                    // Hvis der er en situation hvor $pwdCheck hverken er TRUE eller FALSE 
                    // sørges der for at brugeren ikke logges ind, da en fejl er opstået
                    exit();
                }
            }
            else{
                // Hvis brugernavnet ikke findes, sendes brugeren tilbage til forsiden
                // med en fejlmeddelelse
                header("Location: ../adminlogin.php?error=nousr");
                exit();
            }
        }
    }

    // Sørger for at alle forbindelser til databasen er lukket
    mysqli_stmt_close($stmt);
}
else{
    // Hvis der ikke er sendt en POST forespørgsel, sendes brugeren til forsiden
    exit();
}
?>