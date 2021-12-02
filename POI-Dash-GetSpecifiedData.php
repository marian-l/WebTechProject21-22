<?php session_start();?>
<?php
   header('Content-Type: application/json; charset=utf-8');

    $verbindung = include ('db.inc.php');

    $messages = array();
    $sql = "SELECT * FROM test_parken WHERE";

    //"Freizeit", "Gesundheitswesen", "Bildung", "Einzelhandel und Dienstleistungen", "Entsorgung", "Finanzen", "Transport", "Party",
    //        "Gastronomie", "Religion", "Öffentliche Hand"
     // METHODEN:
     // implode, join — Verbindet Array-Elemente zu einem String
     // parse_str — Überträgt einen String in Variablen
     // str_contains
     // str_replace — Ersetzt alle Vorkommen des Suchstrings durch einen anderen String
     //stripos — Findet das erste Vorkommen eines Teilstrings in einem String, unabhängig von Groß- und Kleinschreibung
     // strlen — Ermitteln der String-Länge
     // substr_replace — Ersetzt Text innerhalb einer Zeichenkette
    
    if (isset($_GET["Freizeit"]) && ($_GET["Freizeit"] == 1))   {
    $sql = $sql . " Selection='Freizeit' ";                     } 
 
    if (isset($_GET["Gesundheitswesen"]) && ($_GET["Gesundheitswesen"] == 1))   {
    $sql = $sql . " Selection='Gesundheitswesen' ";                             }
 
    if (isset($_GET["Bildung"]) && ($_GET["Bildung"] == 1))     {
    $sql = $sql . " Selection='Bildung' ";                      }
 
    if (isset($_GET["EinzelhandelUndDienstleistungen"]) && ($_GET["EinzelhandelUndDienstleistungen"] == 1)) {
    $sql = $sql . " Selection='Einzelhandel Und Dienstleistungen' ";                                        }
 
    if (isset($_GET["Entsorgung"]) && ($_GET["Entsorgung"] == 1))       {
    $sql = $sql . " Selection='Entsorgung' ";                           }
 
    if (isset($_GET["Finanzen"]) && ($_GET["Finanzen"] == 1))   {
    $sql = $sql . " Selection='Finanzen' ";                     }
 
    if (isset($_GET["Transport"]) && ($_GET["Transport"] == 1))      {
    $sql = $sql . " Selection='Transport' ";                        }
 
    if (isset($_GET["Party"]) && ($_GET["Party"] == 1))   {
    $sql = $sql . " Selection='Party' ";   }
 
    if (isset($_GET["Gastronomie"]) && ($_GET["Gastronomie"] == 1))   {
    $sql = $sql . " Selection='Gastronomie' ";  }
 
    if (isset($_GET["Religion"]) && ($_GET["Religion"] == 1)) {
    $sql = $sql . " Selection='Religion' "; }
 
    if (isset($_GET["ÖffentlicheHand"]) && ($_GET["ÖffentlicheHand"] == 1)) {
    $sql = $sql . " Selection='Öffentliche Hand' ";  }
 
    $sql = str_replace("' ", "' OR ", $sql);
    $sql = chop($sql, " OR ");
    $sql = $sql . "LIMIT 200";

 
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


    mysqli_close ($verbindung);
    $json = json_encode($messages);
    print($json);       
        
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
?>