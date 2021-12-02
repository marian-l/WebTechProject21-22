<!DOCTYPE html>
<html lang="en">

<head>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/2.2.3/jquery.min.js"></script>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css" integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA==" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js" integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA==" crossorigin=""></script>
    <link rel="stylesheet" type="text/css" href="stylesheetInput.css" />


    <title>Parken Dashboard</title>
</head>

<body>
<?php 
header('Content-Type: application/json; charset=utf-8');
// Speichern der Daten 
$ajaxSpeichernSummary = array(
"message"=>"Undefined",
"speicherStatus"=>false);
$verbindung = include ('db.inc.php');
$table = "mhs_hilfesuchend";

if (isset($_Get["vn"])&& isset($_GET["nn"])
    && isset($_GET["long"]) && isset($_GET["lat"]) 
    && isset($_GET["dringlichkeit"] && isset($_GET["hilfeart"]))) {
    $vn = urldecode(htmlspecialchars($_GET["vn"]);)
    $nn = urldecode(htmlspecialchars($_GET["nn"]);)
    $long =htmlspecialchars($_GET["long"]);
    $lat = htmlspecialchars($_GET["lat"]);
    $dringlichkeit = htmlspecialchars($_GET["dringlichkeit"]);
    $hilfeart = htmlspecialchars($_GET["hilfeart"]);

        $sql = "INSERT INTO parken (POI_Name, longitude, lat, Selection) VALUES ('$name', '$long', '$lat', '$kategorie')";
        //echo $sql;
        $result = mysqli_query($verbindung, $sql);
        if($result){  
          $ajaxSpeichernSummary['message'] = "Daten wurden Erfolgreich gespeichert";
          $ajaxSpeichernSummary['speicherStatus'] = true;
          
            
        } else{
          
            $ajaxSpeichernSummary['message'] = "Daten wurden nicht gespeichert - DB Problem ";
            $ajaxSpeichernSummary['speicherStatus'] = false;    
        }
        
    }else {
        $ajaxSpeichernSummary['message'] = "Daten wurden nicht gespeichert - Daten fehlerhaft";
        $ajaxSpeichernSummary['speicherStatus'] = false;    
    }
} 
$json = json_encode($ajaxSpeichernSummary);
print($json);
mysqli_close ($verbindung);
?>

    <script type="text/javascript">
        class Hilfesuchender {
            constructor() {
                this.nn = "Default";
                this.vn = "Default";
                this.long = 0.0;
                this.lat = 0.0;
                this.dringlichkeit = 0;
                this.hilfeart = "";
            }
        }
        var hilfeS = new Hilfesuchender();


        function ajaxSend() {
            $.ajax({
                url: ('POI-DashSendData.php'),
                data: {
                    'vn': hilfeS.vn,
                    'nn': hilfeS.nn,
                    'dringlichkeit': hilfeS.dringlichkeit,
                    'long': hilfeS.long,
                    'lat': hilfeS.lat,
                    'hilfeart': hilfeS.hilfeart
                },
                type: 'GET',
                timeout: 1000,
                dataType: 'json',
                error: ajaxSendError,
                success: ajaxSendSuccess
            })
        }

        function takePosition(position) {
            hilfeS.lat = position.coords.latitude;
            hilfeS.long = position.coords.longitude;
            ajaxSend();
        }

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(takePosition);
            } else {
                setUserInstruction("Geolocation is not supported by this browser.");
            }
        }

        function senden() {
            hilfeS.vn = encodeURI(document.getElementById('vn').value); //encodeURI betrachtet den String und wandelt ihn in eine korrekt Form um
            hilfeS.nn = encodeURI(document.getElementById('nn').value);
            hilfeS.dringlichkeit = document.getElementById('dringlichkeit').value;
            hilfeS.hilfeart = document.getElementById('hilfeart').value;
            var tmplong = document.getElementById('long').value;
            var tmplat = document.getElementById('lat').value;
            window.document.forms[0].reset();
            if ((tmplong == "") || (tmplat == "")) {
                getLocation();
            } else {
                hilfeS.long = tmplong;
                hilfeS.lat = tmplat;

                ajaxSend();
            }
        }
    </script>

    <div class="InputForm">
        <table>
            <tr>
                <td>Vorname:</td>
                <td><input type="text" value="" name="Vname" id="Vorname"></td>
            </tr>
            <tr>
                <td>Nachname:</td>
                <td><input type="text" value="" name="Nname" id="Nachname"></td>
            </tr>
            <tr>
                <td>Hilfeart:</td>
                <td><input type="text" value="" name="Nname" id="hilfeart"></td>
            </tr>
            <tr>
                <td>dringlichkeit:</td>
                <td><input type="text" value="" name="Nname" id="dringlichkeit"></td>
            </tr>
            <tr>
                <tr>
                    <td>Long:</td>
                    <td><input type="text" value="" name="long" id="long"></td>
                </tr>
                <tr>
                    <td>Lat:</td>
                    <td><input type="text" value="" name="lat" id="lat"></td>
                </tr>
                <tr></tr>
                <tr>
                    <td><input type="button" value="Speichern" onclick="senden()"></td>
        </table>
    </div>
    <div class="list">
        <h3>Dein Input: </h3>
        <div id="messageContent">
        </div>
        <h4>id="userInstruction"</h4>
</body>