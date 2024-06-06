<?php

    $host = 'localhost';
    $user = '5biin-15';
    $pass = '5biin-15';
    $db='5biin-15';
    $conn = new mysqli($host,$user,$pass,$db);

    $dati_json = file_get_contents("php://input");
    $dati = json_decode($dati_json);
    
    $query= $dati->query;

    $sql = "SELECT evento.id, evento.denom, evento.descrizione, evento.indirizzo, evento.coordinata_x, evento.coordinata_y, evento.anno, provincia.nome AS nomeProv, comune.nome AS nomeCom from evento INNER JOIN comune ON comune.id = evento.id_comune  INNER JOIN provincia ON provincia.id = comune.id_prov ".$query;
    $result = $conn->query($sql);

    $eventiTemp = [];

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if($row["descrizione"]=="NULL") {
                $row["descrizione"] = "NESSUNA DESCRIZIONE";
            }
            $eventiTemp[] = [strtoupper($row["id"]), strtoupper($row["denom"]), strtoupper($row["descrizione"]), strtoupper($row["indirizzo"]), floatval($row["coordinata_x"]+ (mt_rand(1, 9) / 100000)), floatval($row["coordinata_y"]+(mt_rand(1, 9) / 100000)), $row["anno"], strtoupper($row["nomeProv"]), strtoupper($row["nomeCom"])];
        }
    }
    
    echo json_encode($eventiTemp);


?>