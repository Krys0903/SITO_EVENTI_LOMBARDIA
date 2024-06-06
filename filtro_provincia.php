<?php

    $host = 'localhost';
    $user = '5biin-15';
    $pass = '5biin-15';
    $db='5biin-15';
    $conn = new mysqli($host,$user,$pass,$db);

    $dati_json = file_get_contents("php://input");
    $dati = json_decode($dati_json);
    
    $query= $dati->query;

    $sql = "SELECT comune.nome, comune.id FROM comune INNER JOIN provincia ON comune.id_prov = provincia.id ".$query;
    $result = $conn->query($sql);

    $comuniTemp = [];

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $comuniTemp[] = [$row["nome"], $row["id"]];
        }
    }

    echo json_encode($comuniTemp);

?>