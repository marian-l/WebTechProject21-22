<?php session_start();?>
<?php
header('Content-Type: application/json; charset=utf-8');
// Speichern der Daten 
// Annahme es geht alles gut :-)
$ajaxSpeichernSummary = array(
    "message"=>"Undefined",
    "speicherStatus"=> false
);
    $verbindung = include ('db.inc.php');
    $table    = 'test_parken'; //vorher: poi
    //$table    = "poi";

    if (isset($_GET["name"])&& isset($_GET["kategorie"])&&
        isset($_GET["long"])&& isset($_GET["long"])){
        $name = urldecode(htmlspecialchars($_GET["name"]));
        $kategorie = $_GET["kategorie"];
        $long = $_GET["long"];
        $lat = $_GET["lat"];
        
        
    
        $sql = "INSERT INTO parken (POI_Name, longitude, lat, Selection) VALUES ('$name', '$long', '$lat', '$kategorie')";
        //echo $sql;
        $result = mysqli_query($verbindung, $sql);
        if($result){  
          $ajaxSpeichernSummary['message'] = "Daten wurden Erfolgreich gespeichert";
          $ajaxSpeichernSummary['speicherStatus'] = true;
          
            
        } else {
          
            $ajaxSpeichernSummary['message'] = "Daten wurden nicht gespeichert - DB Problem ";
            $ajaxSpeichernSummary['speicherStatus'] = false;    
        }
        
    } else {
        $ajaxSpeichernSummary['message'] = "Daten wurden nicht gespeichert - Daten fehlerhaft";
        $ajaxSpeichernSummary['speicherStatus'] = false;    
    }	
        
    $json = json_encode($ajaxSpeichernSummary);

    print($json);
    mysqli_close ($verbindung);   
        
?>