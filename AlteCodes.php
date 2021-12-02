<head>
    <script>
        function change_interest(data) {
            if (!interest.includes(data)) {
                // if the interest isnt already included in the array, add it 
                interest.push(data);
                interestString += " OR '" + data + "'";
                console.log(interestString);
                return (interestString);
            } else { // if the element is already in the array, find and remove it. 
                function arrayRemove(arr, value) {
                    return arr.filter(function(ele) {
                        return ele != value;
                    });
                }
                interest = arrayRemove(interest, data);
                interestString = "";
                for (let index = 0; index < interest.length; index++) {
                    if (index == interest.length - 1) {
                        interestString += " '" + interest[index] + "'"
                    } else if (interest[index] != undefined) {
                        interestString += " '" + interest[index] + "' OR ";
                    }
                }
                console.log(interestString);
                return (interestString);
            }
        }
        <?php 
                function change_interest($data) {
            if (!$interest.includes($data)) {
                // if the interest isnt already included in the array, add it 
                $interest.push($data);
                $interestString += " OR '" + $data + "'";
                console.log($interestString);
                return ($interestString);
            } else { // if the element is already in the array, find and remove it. 
                function arrayRemove($arr, $value) {
                    return $arr.filter(function($ele) {
                        return $ele != $value;
                    });
                }
                $interest = arrayRemove($interest, $data);
                $interestString = "";
                for ($index = 0; $index < $interest.length; $index++) {
                    if ($index == $interest.length - 1) {
                        $interestString += " '" + $interest[$index] + "'"
                    } else if ($interest[$index] != undefined) {
                        $interestString += " '" + $interest[$index] + "' OR ";
                    }
                }
                console.log($interestString);
                return ($interestString);
            }
        }
        ?>

        function ajaxLoadSpecifiedData(interestString) {
            $.ajax({
                url: ('POI-Dash-GetSpecifiedData.php'),
                data: {
                    /*
                'Freizeit': Freizeit,
                'Gesundheitswesen': Gesundheitswesen,
                'Bildung': Bildung,
                'EinzelhandelUndDienstleistungen': EinzelhandelUndDienstleistungen,
                'Entsorgung': Entsorgung,
                'Finanzen': Finanzen,
                'Transport': Transport,
                'Party': Party,
                'Gastronomie': Gastronomie,
                'Religion': Religion,
                'ÖffentlicheHand': ÖffentlicheHand
                */
                    'interest': interestString
                },
                type: 'GET',
                timeout: 1000,
                dataType: 'json',
                error: function(xhr, status, error) {
                    var errorMessage = xhr.status + ': ' + xhr.statusText
                    alert('Error - ' + errorMessage);
                },
                //success: ajaxLoadDataSuccess
                success: function(ajaxresult) {
                    $("#ajaxrequest").html(ajaxresult);
                }
            })
        }

        var interest = ["Freizeit", "Gesundheitswesen", "Bildung", "Einzelhandel und Dienstleistungen", "Entsorgung", "Finanzen", "Transport", "Party", "Gastronomie", "Religion", "Öffentliche Hand"];
        var interestString = "Freizeit OR Gesundheitswesen OR Bildung OR Einzelhandel und Dienstleistungen OR Entsorgung OR Finanzen OR Transport OR Party OR Gastronomie OR Religion OR Öffentliche Hand ";
    
//////////////// innerhalb der LoadSuccess: 

            //  myData.forEach(element => {
            //   var row = document.createElement("tr");
            //if (element.POI_Name != "" &&
            //    element.long != "" &&
            //    element.lat != "" &&
            //    element.kategorie != "") {
            //
            //    var cell = document.createElement("td");
            //    var txt = document.createTextNode(element.POI_Name);
            //    cell.append(txt);
            //    row.appendChild(cell);
            //
            //    txt = document.createTextNode(element.long + " | ");
            //    cell.appendChild(txt);
            //    row.appendChild(cell);
            //
            //    txt = document.createTextNode(element.lat + " | ");
            //    cell.appendChild(txt);
            //    row.appendChild(cell);
            //
            //    txt = document.createTextNode(element.kategorie);
            //    cell.appendChild(txt);
            //    row.appendChild(cell);
            //
            //} else {
            //    var cell = document.createElement("td");
            //    var txt = document.createTextNode("Datensatz unvollständig");
            //    cell.appendChild(txt);
            //    row.appendChild(cell);
            //};
            //
            //document.body.appendChild(row);
            // });
/////////unbenutzt
                    //document.getElementById('ErgName').innerHTML += cell.nodeValue;
                //row.innerHTML = "<tr> " + row.childNodes + "</tr>";
                // row.push(element.POI_Name);
                // row.push(element.long);
                // row.push(element.lat);
                // row.push(element.kategorie);
                // document.getElementById('ErgName').innerHTML += txt.nodeValue;
                // document.getElementById('ErgName').innerHTML += "<tr>" + element.POI_Name + "</tr>";
                // document.getElementById('ErgName').innerHTML += cell.nodeValue;

                // document.getElementById('tbody').innerHTML +=
                //     "<tr> <td>" + row[0] + "</td> <td>" + row[1] +
                //     "</td> <td>" + row[2] + "</td> <td>" + row[3] + "</td> </tr>";
                //    document.getElementById('ErgName').innerHTML +=
                //        "<tr> <td>" + row[0] + "</td>";
                //    document.getElementById('ErgLong').innerHTML +=
                //        "<td>" + row[1] + "</td>";
                //    document.getElementById('ErgLat').innerHTML +=
                //        "<td>" + row[2] + "</td>";
                //    document.getElementById('ErgAuswahl').innerHTML +=
                //        "<td>" + row[3] + "</td> </tr>";



    </script>
        <!--ursprünglich table für Ausgabe // Ungenutzt-->
    <table>
        <caption>Daten</caption>
        <colgroup>
            <col span="1" class="Name" id="ErgName">
            <col span="1" class="Long" id="ErgLong">
            <col span="1" class="Lat" id="ErgLat">
            <col span="1" class="Kategorie" id="ErgAuswahl">
        </colgroup>
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Long</th>
                <th scope="col">Lat</th>
                <th scope="col">Kategorie</th>
            </tr>
        </thead>

        <tbody id="tbody">
        </tbody>
    </table>
</head>