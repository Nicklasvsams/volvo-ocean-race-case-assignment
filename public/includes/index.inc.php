<?php
    require_once("/opt/lampp/htdocs/Nicklas/dbconnect.php");

    class Boat{
        public $name;
        public $points;
        public $imgsrc;
    }

    $boats = array();

    $sqlread = "SELECT * FROM (boatscore) ORDER BY (point) desc";

    $result = $db_connection->query($sqlread);

    if (!$result->num_rows > 0){
        exit();
    }
    else{
        while($row = $result->fetch_assoc()){
            $boat = new Boat();
            $boat->name = $row['holdnavn'];
            $boat->points = $row['point'];
            $boat->imgsrc = $row['imgpath'];
            
            $boats[] = $boat;
        };
    };
?>