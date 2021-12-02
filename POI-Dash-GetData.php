<?php session_start();?>
<?php
   header('Content-Type: application/json; charset=utf-8');

    $verbindung = include ('db.inc.php');

    $messages = array();

    $sql = "SELECT * FROM test_parken limit 200";
    
    $result = mysqli_query($verbindung, $sql);

    if($result){
        while($row = mysqli_fetch_assoc($result)) {
            $message = array(
                "id"=>$row['id'],
                "POI_Name"=>$row['POI_Name'],
                "long"=>floatval($row['longitude']),
                "lat"=>floatval($row['lat']),
                "kategorie"=>$row['Selection']);
                array_push($messages,$message);   
        }
    }

//    $sql = "SELECT * FROM parkhäuser";
//    
//    $result = mysqli_query($verbindung, $sql);
//
//    if($result){
//        while($row = mysqli_fetch_assoc($result)) {
//            $message = array(
//                "id"=>$row['parkhaus_id'],
//                "POI_Name"=>$row['Name'],
//                "long"=>floatval($row['Long']),
//                "lat"=>floatval($row['Lat']),
//                "kategorie"=>$row['mittlere_Auslastung']);
//                array_push($messages,$message);   
//        }
//    }
    mysqli_close ($verbindung);
    $json = json_encode($messages);
    print($json);       
        
?>