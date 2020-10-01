<?php
    // Sørger for at der kan oprettes forbindelse til databasen
    // Bruger $_SERVER['DOCUMENT_ROOT'] for at sikre at der er adgang til den rette fil
    require_once($_SERVER['DOCUMENT_ROOT'] . "/Nicklas/dbconnect.php");

    // Opretter en klasse
    class Boat{
        public $name;
        public $points;
        public $imgsrc;
    }

    // Et globalt array med bådinformation
    $boats = array();

    // Database forespørgsel vælger alt fra "boatscore" tabellen og sorterer efter point
    $sqlread = "SELECT * 
    FROM (boatscore) 
    ORDER BY (point) desc";

    // Gemmer resultat i en variabel
    $result = $db_connection->query($sqlread);

    // Hvis der intet resultat er, afsluttes processen
    if (!$result->num_rows > 0){
        exit();
    }
    else{
        // Hvis der er et resultat gemmes hver kolonne i en klasse og tilføjes til globalt array
        while($row = $result->fetch_assoc()){
            $boat = new Boat();
            $boat->name = $row['holdnavn'];
            $boat->points = $row['point'];
            $boat->imgsrc = $row['imgpath'];
            
            $boats[] = $boat;
        };
    };
?>