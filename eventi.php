<!DOCTYPE html>
<html>
   <?php
      session_start();
      ?>
   <head>
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <title>DATI LOMBARDIA</title>
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <link rel="icon" href="https://i.imgur.com/FD639yK.png" type="image/png">
      <link rel="stylesheet" type="text/css" media="screen" href="stile.css" />
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ol@latest/dist/ol.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
      <script src="https://cdn.jsdelivr.net/npm/ol@latest/dist/ol.js"></script>
      <style>
         header {
         background-color: green;
         color: #fff;
         padding: 20px;
         text-align: center;
         }
         footer {
         background-color: rgb(20, 20, 20);
         color: #fff;
         text-align: center;
         padding: 10px;
         position: fixed;
         width: 100%;
         bottom: 0;
         }
         #map {
         width: 40%;
         height: 60vh;
         margin-left: 6.5%;
         margin-top: 5%;
         position: relative;
         float: left;
         border-collapse: collapse;
         border-radius: 10px;
         overflow: hidden; 
         box-shadow: 0 15px 35px rgba(0,0,0,9);
         }
         .marker-description {
         position: absolute;
         min-width: 20vh;
         width: 7.5%;
         background-color: white;
         padding: 7px;
         box-shadow: 0 15px 35px rgba(0,0,0,9);
         font-size:15px;
         border-radius: 4px;
         z-index: 1000; 
         display: none; 
         margin-top:10%;
         margin-left:22.5%;
         background-color: #f0f0f0; 
         } 
         .close-btn {
         position: absolute;
         top: 7px;
         right: 10px;
         cursor: pointer;
         }
         #marker-description-in {
         margin-left: 10%;
         margin-right: 10%;
         min-width: 8vh;
         margin-top: 10%;
         margin-bottom: 10%;
         font-size:15px;
         padding: 15px;
         border-bottom: 1px solid #ccc; 
         background-color: #fff; 
         border-radius: 5px; 
         box-shadow: 0 0 5px rgba(0, 0, 0, 0.1); 
         }
         #marker-info {
         width:95%;
         }
         #marker-descr-button {
         padding: 8px 16px; 
         border: none;
         border-radius: 5px; 
         background-color: green; 
         color: #fff;
         font-size: 14px; 
         cursor: pointer;
         transition: background-color 0.3s, color 0.3s;
         }
         #marker-descr-button:hover {
         background-color: darkgreen;
         }
         #refresh-container {
         position: absolute;
         bottom: 50px;
         left: 10px;
         z-index: 1001;
         background-color: black; 
         padding: 10px;
         border-radius: 5px;
         }
         #refresh-btn {
         color: white;
         background-color: transparent; 
         border: none;
         cursor: pointer; 
         }
         #refresh-btn:hover {
         background-color: rgba(255, 255, 255, 0.1);
         }
         #items-list {
         width:50%;
         max-height: 50vh;
         overflow-y: auto; 
         overflow-x: hidden;
         background-color: #f0f0f0;
         }
         #container-tot {
         width: 42%;
         height: 60vh;
         background-color: #f0f0f0;
         float: left; 
         margin-top: 5%;
         margin-left: 5%;
         border-collapse: collapse;
         border-radius: 10px;
         overflow: hidden; 
         box-shadow: 0 15px 35px rgba(0,0,0,9);
         }
         .item {
         margin-left: 2%;
         margin-right: 2%;
         margin-top: 2%;
         margin-bottom: 2%;
         padding: 15px;
         border-bottom: 1px solid #ccc; 
         background-color: #fff;
         border-radius: 5px; 
         box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
         display: flex; 
         justify-content: space-between; 
         align-items: center; 
         }
         .item:hover {
         background-color: lightgrey;
         }
         .info-button {
         padding: 8px 16px;
         width:30%;
         border: none; 
         border-radius: 5px; 
         background-color: green; 
         color: #fff; 
         font-size: 14px; 
         cursor: pointer; 
         transition: background-color 0.3s, color 0.3s;
         }
         .info-button:hover {
         background-color: darkgreen; 
         }
         #items-list::-webkit-scrollbar {
         width: 8px; 
         }
         #items-list::-webkit-scrollbar-track {
         background: lightgrey; 
         }
         #items-list::-webkit-scrollbar-thumb {
         background-color: green; 
         border-radius: 3px;
         }
         #search-box {
         padding: 10px;
         background-color: #fff;
         border-radius: 5px;
         box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
         width:47.5%;
         margin-left: 1%;
         margin-right: 2%;
         margin-top: 2%;
         margin-bottom: 2%;
         }
         #search-box input {
         width: 100%; 
         padding: 8px; 
         border: none; 
         border-radius: 5px;
         box-sizing: border-box; 
         background-color: #f0f0f0;
         color: #333; 
         font-size: 16px;
         transition: background-color 0.3s, color 0.3s; 
         }
         #search-box input:focus {
         outline: none; 
         background-color: #fff; 
         color: #555; 
         }
         .filter-section {
         margin-top:2%;
         width: 40%;
         background-color: #f0f0f0; 
         float: right; 
         margin-right: 5%;
         border-radius: 10px;
         overflow: hidden; 
         box-shadow: 0 15px 35px rgba(0,0,0,0.1);
         padding: 15px; 
         height:95.5%;
         }
         .filter-section h2 {
         text-align: center;
         margin-bottom: 20px;
         }
         .filters {
         margin-bottom: 20px; 
         }
         .filters select,
         .filters input[type="text"],
         .filters input[type="date"] {
         width: 100%; 
         padding: 10px; 
         border: 1px solid #ccc; 
         border-radius: 5px; 
         margin-bottom: 10px; 
         box-sizing: border-box; 
         background-color: #fff; 
         font-size: 14px;
         transition: border-color 0.3s;
         }
         .filters select:focus,
         .filters input[type="date"]:focus {
         outline: none;
         border-color: green;
         }
         .filters input[type="text"]::placeholder,
         .filters input[type="date"]::placeholder {
         margin-left: 1%;
         color: black; 
         opacity: 1; 
         }
         .filters button {
         width: 100%;
         padding: 15px; 
         background-color: green; 
         color: #fff; 
         border: none; 
         border-radius: 5px; 
         cursor: pointer; 
         font-size: 16px; 
         transition: background-color 0.3s; 
         }
         .filters button:hover {
         background-color: darkgreen; 
         }
         .filters #reset-filters{
         background-color: red; 
         }
         .filters #reset-filters:hover{
         background-color: darkred; 
         }
         .alertLogin-overlay {
         position: fixed;
         top: 0;
         left: 0;
         width: 100%;
         height: 100%;
         background-color: rgba(0, 0, 0, 0.5);
         z-index: 9998; 
         display: none; 
         }
         .alertLogin {
         position: fixed;
         top: 50%;
         left: 50%;
         transform: translate(-50%, -50%);
         background-color: #f0f0f0;
         border: 2px solid green;
         padding: 20px;
         border-radius: 5px;
         box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
         z-index: 9999;
         text-align: center;
         }   
         .alertLogin p {
         color: #333;
         margin-bottom: 10px;
         }
         .alertLogin button {
         background-color: green;
         color: #fff;
         padding: 10px 20px;
         border: none;
         border-radius: 5px;
         margin: 0 5px; 
         cursor: pointer;
         }
         .alertLogin button:last-child {
         margin-right: 0;
         }
         #custom-alert {
         position: fixed;
         top: 0;
         left: 0;
         width: 100%;
         height: 100%;
         background-color: rgba(0, 0, 0, 0.5);
         display: none;
         justify-content: center;
         align-items: center;
         }
         .alert-content {
         background-color: #fff;
         padding: 20px;
         border-radius: 10px;
         box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
         text-align: center;
         }
         #confirm-btn,
         #cancel-btn {
         padding: 10px 20px;
         margin: 10px;
         border: none;
         border-radius: 5px;
         cursor: pointer;
         font-size: 16px;
         transition: background-color 0.3s, color 0.3s;
         }
         #confirm-btn {
         background-color: #28a745;
         color: #fff;
         }
         #confirm-btn:hover {
         background-color: #218838;
         }
         #cancel-btn {
         background-color: #dc3545;
         color: #fff;
         }
         #cancel-btn:hover {
         background-color: #c82333;
         }
      </style>
   </head>
   <body>
      <?php
         
         $host = 'localhost';
         $user = '5biin-15';
         $pass = '5biin-15';
         $db='5biin-15';
         $conn = new mysqli($host,$user,$pass,$db);

         $result = $conn->query("SHOW TABLES LIKE 'evento'");

         if(isset($_GET["carica"])) {
           $caricaDB = $_GET["carica"];
         }else if ($result->num_rows <= 0) {
           $caricaDB = true;
         }else{
           $caricaDB = false;
         }
        
          if($caricaDB){

           $json_string = 'https://dati.lombardia.it/resource/hs8z-dcey.json?$limit=5000';
           $jsondata = file_get_contents($json_string);
           $obj = json_decode($jsondata);
         
           if ($conn->connect_error) {
               echo "error";
           } else {
               $tables = ['evento', 'tipo', 'comune', 'provincia', 'organizzazione', 'toponimo'];
               foreach ($tables as $table) {
                   $conn->query("DROP TABLE IF EXISTS $table");
               }
         
               $create_tables = [
                   "CREATE TABLE tipo (id INT AUTO_INCREMENT, descrizione VARCHAR(100), PRIMARY KEY (id))",
                   "CREATE TABLE provincia (id INT AUTO_INCREMENT, nome VARCHAR(100), PRIMARY KEY (id))",
                   "CREATE TABLE comune (id INT AUTO_INCREMENT, nome VARCHAR(100), id_prov INT, cap INT, istat INT, PRIMARY KEY (id), FOREIGN KEY (id_prov) REFERENCES provincia(id) ON DELETE CASCADE ON UPDATE CASCADE)",
                   "CREATE TABLE organizzazione (id INT AUTO_INCREMENT, nome VARCHAR(100), PRIMARY KEY (id))",
                   "CREATE TABLE toponimo (id INT AUTO_INCREMENT, descrizione VARCHAR(100), PRIMARY KEY (id))",
                   "CREATE TABLE evento (id INT AUTO_INCREMENT, denom VARCHAR(100), id_tipo INT, n_ediz VARCHAR(100), descrizione VARCHAR(150), data_in DATE, ora_in TIME, data_fine DATE, ora_fine TIME, anno INT, id_comune INT, id_toponimo INT, indirizzo VARCHAR(50), coordinata_x DOUBLE, coordinata_y DOUBLE, somminis VARCHAR(10), id_organizzazione INT, url_programma VARCHAR(200), PRIMARY KEY (id), FOREIGN KEY (id_tipo) REFERENCES tipo(id) ON DELETE CASCADE ON UPDATE CASCADE, FOREIGN KEY (id_comune) REFERENCES comune(id) ON DELETE CASCADE ON UPDATE CASCADE, FOREIGN KEY (id_toponimo) REFERENCES toponimo(id) ON DELETE CASCADE ON UPDATE CASCADE, FOREIGN KEY (id_organizzazione) REFERENCES organizzazione(id) ON DELETE CASCADE ON UPDATE CASCADE)"
               ];
               foreach ($create_tables as $sql) {
                   $conn->query($sql);
               }
         
               $conn->query("CREATE TABLE IF NOT EXISTS utenti (nome VARCHAR(50), cognome VARCHAR(50), email VARCHAR(50), password VARCHAR(50))");
         
         
               foreach ($obj as $evento) {
                   $denom = isset($evento->denom) ? $conn->real_escape_string($evento->denom) : "NULL";
                   $n_ediz = isset($evento->n_ediz) ? $conn->real_escape_string($evento->n_ediz) : "NULL";
                   $descriz = isset($evento->descriz) ? $conn->real_escape_string($evento->descriz) : "NULL";
                   $data_in = isset($evento->data_in) ? $evento->data_in : "NULL";
                   $ora_in = isset($evento->ora_in) ? $evento->ora_in : "NULL";
                   $data_fine = isset($evento->data_fine) ? $evento->data_fine : "NULL";
                   $ora_fine = isset($evento->ora_fine) ? $evento->ora_fine : "NULL";
                   $anno = isset($evento->anno) ? $conn->real_escape_string($evento->anno) : "NULL";
                   $indirizzo = isset($evento->indirizzo) ? $conn->real_escape_string($evento->indirizzo) : "NULL";
                   $geo_x = isset($evento->geo_x) ? floatval($evento->geo_x) : "NULL";
                   $geo_y = isset($evento->geo_y) ? floatval($evento->geo_y) : "NULL";
                   $somminis = isset($evento->somminis) ? $conn->real_escape_string($evento->somminis) : "NULL";
                   $id_sito = $evento->id;
                   $id_nome_org_temp = get_or_insert_id($conn, 'organizzazione', 'nome', isset($evento->nome_org) ? $conn->real_escape_string($evento->nome_org) : null);
                   $id_toponimo_temp = get_or_insert_id($conn, 'toponimo', 'descrizione', isset($evento->toponimo) ? $conn->real_escape_string($evento->toponimo) : null);
                   $id_tipo_temp = get_or_insert_id($conn, 'tipo', 'descrizione', isset($evento->tipo) ? $conn->real_escape_string($evento->tipo) : null);
                   $id_prov_temp = get_or_insert_id($conn, 'provincia', 'nome', isset($evento->prov) ? $conn->real_escape_string($evento->prov) : null);
         
                   if (isset($evento->comune) && isset($evento->cap) && isset($evento->istat)) {
                     $comune = $conn->real_escape_string($evento->comune);
                     $cap = $conn->real_escape_string($evento->cap);
                     $istat = $conn->real_escape_string($evento->istat);
                     $sql = "SELECT id FROM comune WHERE nome='$comune'";
                     $result = $conn->query($sql);
                     if ($result && $result->num_rows == 0) {
                         $sql = "INSERT INTO comune (nome, id_prov, cap, istat) VALUES ('$comune', '$id_prov_temp', '$cap', '$istat')";
                         $conn->query($sql);
                     }
                     $sql = "SELECT id FROM comune WHERE nome='$comune'";
                     $result = $conn->query($sql);
                     $id_comune_temp = $result->fetch_assoc()['id'];
                 } else {
                     $id_comune_temp = 1;
                 }
         
                 $sql = "SELECT id FROM evento WHERE id='$id_sito'";
                 $result = $conn->query($sql);
                 if ($result && $result->num_rows == 0) {
                   $sql = "INSERT INTO evento (id, denom, id_tipo, n_ediz, descrizione, data_in, ora_in, data_fine, ora_fine, anno, id_comune, id_toponimo, indirizzo, coordinata_x, coordinata_y, somminis, id_organizzazione, url_programma) VALUES ('$id_sito', '$denom', '$id_tipo_temp', '$n_ediz', '$descriz', '$data_in', '$ora_in', '$data_fine', '$ora_fine', '$anno', '$id_comune_temp', '$id_toponimo_temp', '$indirizzo', '$geo_x', '$geo_y', '$somminis', '$id_nome_org_temp', 'https://www.procedimenti.servizirl.it/sagre/public/programma/$id_sito')";
                   $conn->query($sql);
               }
           }
             
           }
         
          echo '<script> window.location.href = "eventi.php" </script>';
         
         }
         
         
         function get_or_insert_id($conn, $table, $column, $value) {
         
         if ($value === null) return "NULL";
         $sql = "SELECT id FROM $table WHERE $column='$value'";
         $result = $conn->query($sql);
         if ($result && $result->num_rows == 0) {
             $conn->query("INSERT INTO $table ($column) VALUES ('$value')");
             $result = $conn->query("SELECT id FROM $table WHERE $column='$value'");
         }
         return $result->fetch_assoc()['id'];
         }
         
         
         
         
         $sql="SELECT evento.id, evento.denom, evento.descrizione, evento.indirizzo, evento.coordinata_x, evento.coordinata_y, evento.anno, provincia.nome AS nomeProv, comune.nome AS nomeCom from evento INNER JOIN comune ON comune.id = evento.id_comune  INNER JOIN provincia ON provincia.id = comune.id_prov";
         $result = $conn->query($sql);
         $eventi = [];
         
         if ($result->num_rows > 0) {
           while($row = $result->fetch_assoc()) {
             if($row["descrizione"]=="NULL") {
               $row["descrizione"] = "NESSUNA DESCRIZIONE";
             }
         
             $eventi[] = [strtoupper($row["id"]), strtoupper($row["denom"]), strtoupper($row["descrizione"]), strtoupper($row["indirizzo"]), floatval($row["coordinata_x"]+ (mt_rand(1, 9) / 100000)), floatval($row["coordinata_y"]+(mt_rand(1, 9) / 100000)), $row["anno"], strtoupper($row["nomeProv"]), strtoupper($row["nomeCom"])];
           }
         }
         
         
         ?>
      <nav>
         <input type="checkbox" id="check" />
         <label for="check" class="menu">
            <svg
               xmlns="http://www.w3.org/2000/svg"
               width="30"
               height="30"
               fill="currentColor"
               class="bi bi-list"
               viewBox="0 0 16 16"
               >
               <path
                  fill-rule="evenodd"
                  d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"
                  />
            </svg>
         </label>
         <div class="logo">
            <h2>DATI LOMBARDIA</h2>
         </div>
         <div class="nav-items">
            <ul class="overview">
               <h3>Generale</h3>
               <li>
                  <a href="index.php">
                  <img src="https://i.imgur.com/Y1ED7i0.png" alt="Home" style="width: 20px; height: 20px; filter: invert(100%)">
                  HOME
                  </a>
               </li>
               <li>
                  <a href="eventi.php">
                  <img src="https://i.imgur.com/Zv8hEBY.png" alt="Home" style="width: 20px; height: 20px; filter: invert(100%)">
                  EVENTI
                  </a>
               </li>
            </ul>
            <ul class="account">
               <h3>Account</h3>
               <?php
                  if(isset($_SESSION["email_loggato"])) {
                  ?>
               <li>
                  <a href="logout.php">
                  <img src="https://i.imgur.com/3hl8NI9.png" alt="Home" style="width: 20px; height: 20px; filter: invert(100%)">
                  LOGOUT
                  </a>
               </li>
               <?php
                  }else{
                  ?> 
               <li>
                  <a href="login.php">
                  <img src="https://i.imgur.com/gYlRZoc.png" alt="Home" style="width: 20px; height: 20px; filter: invert(100%)">
                  LOGIN
                  </a>
               </li>
               <li> 
                  <a href="registrazione.php">
                  <img src="https://i.imgur.com/67wWPEU.png" alt="Home" style="width: 20px; height: 20px; filter: invert(100%)">
                  REGISTRAZIONE
                  </a>
               </li>
               <?php
                  }
                  ?>
            </ul>
         </div>
      </nav>
      <div id="custom-alert" class="alert hidden">
         <div class="alert-content">
            <p>SEI SICURO DI VOLER AGGIORNARE IL DATABASE?</p>
            <br>
            <button id="confirm-btn">CONFERMA</button>
            <button id="cancel-btn">ANNULLA</button>
         </div>
      </div>
      <header>
         <h1>VISUALIZZA TUTTI GLI EVENTI DELLA LOMBARDIA</h1>
      </header>
      <div id="map"></div>
      <div id="marker-description" class="marker-description">
         <div id="marker-description-in">
            <div id="marker-info"></div>
            <span class="close-btn" id="close-btn"><i class="fas fa-times"></i></span>
         </div>
      </div>
      <div id="refresh-container">
         <button id="refresh-btn"><i style="color:green" class="fas fa-sync-alt"></i></button>
      </div>
      <div id ="container-tot">
         <div class="filter-section">
            <center>
               <h3>FILTRA LA TUA RICERCA</h3>
               <br>
            </center>
            <div class="filters">
               <select id="tipoevento">
                  <option value="noVal">SELEZIONA IL TIPO DI EVENTO</option>
                  <?php
                     $sql = "SELECT * FROM tipo";
                     $result = $conn->query($sql);
                     
                     if ($result->num_rows > 0) {
                       while ($row = $result->fetch_assoc()) {
                           echo "<option value='" . $row['id'] . "'>" . strtoupper($row['descrizione']) . "</option>";
                       }
                     }
                     
                     ?>
               </select>
               <select id="organizzatore">
                  <option value="noVal">SELEZIONA L'ORGANIZZATORE</option>
                  <?php
                     $sql = "SELECT * FROM organizzazione";
                     $result = $conn->query($sql);
                     
                     if ($result->num_rows > 0) {
                       while ($row = $result->fetch_assoc()) {
                           echo "<option value='" . $row['id'] . "'>" . strtoupper($row['nome']) . "</option>";
                       }
                     }
                     
                     ?>
               </select>
               <select id="provincia" onchange="provinciaSelezionata()">
                  <option value="noVal">SELEZIONA LA PROVINCIA</option>
                  <?php
                     $regioni_lombardia = array(
                       ["BERGAMO","BG"],
                       ["BRESCIA","BS"],
                       ["COMO","CO"],
                       ["CREMONA","CR"],
                       ["LECCO","LC"],
                       ["LODI","LO"],
                       ["MANTOVA","MN"],
                       ["MILANO","MI"],
                       ["MONZA E DELLA BRIANZA","MB"],
                       ["PAVIA","PV"],
                       ["SONDRIO","SO"],
                       ["VARESE","VA"],
                     );
                     
                     foreach ($regioni_lombardia as $regione) {
                       echo "<option value=\"$regione[1]\">$regione[0]</option>";
                     }
                     ?>
               </select>
               <select id="comune" >
                  <option value="noVal">SELEZIONA IL COMUNE</option>
               </select>
               <select id="anno">
                  <option value="noVal">SELEZIONA L'ANNO</option>
                  <option value="2023">2023</option>
                  <option value="2024">2024</option>
               </select>
               <input type="text" id="data_inizio" placeholder="DATA INIZIO" onfocus="(this.type='date')" onblur="(this.type='text')">
               <input type="text" id="data_fine" placeholder="DATA FINE" onfocus="(this.type='date')" onblur="(this.type='text')">
               <button type="submit" onclick="ApplicaFiltri()" style="margin-top:2%">APPLICA FILTRI</button>
               <button id="reset-filters" onclick="RimuoviFiltri()" style="margin-top:5%">RIMUOVI FILTRI</button>
            </div>
         </div>
         <div id="search-box">
            <input type="text" id="search-input" placeholder="CERCA NOME...">
         </div>
         <div id="items-list"> </div>
      </div>
      <div class="alertLogin-overlay"></div>
      <footer>
         <p>© 2024 DATI LOMBARDIA. TUTTI I DIRITTI RISERVATI.</p>
      </footer>
      <script>
         var regionStyle = new ol.style.Style({
             stroke: new ol.style.Stroke({
                 color: 'black',
                 width: 1
             })
         });
         
         
         var regionLayer = new ol.layer.Vector({
             source: new ol.source.Vector({
                 url: 'lombardy.geojson',
                 format: new ol.format.GeoJSON()
             }),
             style: regionStyle
         });
         
         
         var map = new ol.Map({
             target: 'map',
             layers: [
                 
                 new ol.layer.Tile({
                     source: new ol.source.OSM()
                 }),
                 regionLayer 
             ],
             
             view: new ol.View({
                 center: ol.proj.fromLonLat([9.1903, 45.4668]), 
                 extent: ol.proj.transformExtent([7.8, 44.6, 11.8, 46.9], 'EPSG:4326', 'EPSG:3857'), 
                 zoom: 0 
             }),
             controls: []
         });
         
           var eventi = <?php echo json_encode($eventi); ?>;
           var ind = 0;
           var waypointLayer;
         
         
         function addWaypointsToMap(waypoints) {
             var waypointFeatures = [];
         
             waypoints.forEach(function(coord) {
               coord = [coord[4], coord[5]]
                 var waypointFeature = new ol.Feature({
                     geometry: new ol.geom.Point(ol.proj.fromLonLat(coord))
                 });
                 waypointFeatures.push(waypointFeature);
             });
         
             var waypointStyle = new ol.style.Style({
                 image: new ol.style.Icon({
                     src: 'https://i.imgur.com/yGlzq7s.png', 
                     scale: 0.03 
                 }),
                 cursor: 'pointer' 
             });
         
             waypointLayer = new ol.layer.Vector({
                 source: new ol.source.Vector({
                     features: waypointFeatures
                 }),
                 style: waypointStyle
             });
         
             map.addLayer(waypointLayer);
         }
         
         function removeAllWaypoints() {
           waypointLayer.getSource().clear();
         }
         
         
         function showAlert() {
           document.querySelector('.alertLogin-overlay').style.display = 'block';
             var alertDiv = document.createElement('div');
             alertDiv.className = 'alertLogin';
         
             alertDiv.innerHTML = '<p>DEVI EFFETTUARE L\'ACCESSO PER VISUALIZZARE I DATI.</p>' +
                                 '<button onclick="redirectToLoginPage()">LOGIN</button>' +
                                 '<button onclick="redirectToRegistrationPage()">REGISTRAZIONE</button>';
         
             document.body.appendChild(alertDiv);
         
             setTimeout(function() {
               alertDiv.remove();
               document.querySelector('.alertLogin-overlay').style.display = 'none';
             }, 3000);
         }
         
         
         function redirectToLoginPage() {
             window.location.href = 'login.php'; 
         }
         
         
         function redirectToRegistrationPage() {
             window.location.href = 'registrazione.php'; 
         }
         
           
         
           function InfoEvento(id) {
               var loggato = <?php 
            if (isset($_SESSION["email_loggato"])) { 
              echo json_encode($_SESSION["email_loggato"]); 
            }else{
              echo json_encode("nolog");
            } 
            
            ?>;
         
               if(loggato=="nolog") {
                 showAlert();
         
               }else{
                 if(id) {
                   window.location.href = "infoeventi.php?id="+id;
                 }else{
                   window.location.href = "infoeventi.php?id="+eventi[ind][0];
                 }
               }
         
             }
         
         
           map.on('click', function(event) {
                 var markerInfo = '';
                
                 map.forEachFeatureAtPixel(event.pixel, function(feature) {
         
                     var coordinates = feature.getGeometry().getCoordinates();
                     var lonLat = ol.proj.toLonLat(coordinates);
                       ind = 0;
                       for(let i=0;i<eventi.length;i++) {
         
                         if(parseFloat(lonLat[0].toFixed(6))==parseFloat(eventi[i][4].toFixed(6)) && parseFloat(lonLat[1].toFixed(6))==parseFloat(eventi[i][5]).toFixed(6)) {
                           ind = i;
                           break;
                         } 
                       }
         
                     markerInfo = "<center><h4>"+eventi[ind][1]+"</h4> <br>"+eventi[ind][2]+"<br><br> <button onclick='InfoEvento()' id='marker-descr-button' ' >VAI ALLA FIERA</button></center>";
         
                     var markerDescription = document.getElementById('marker-description');
                     markerDescription.style.display = 'block';
                     var markerInfoElement = document.getElementById('marker-info');
                     markerInfoElement.innerHTML = markerInfo;
                 });
                 if (markerInfo === '') {
                     document.getElementById('marker-description').style.display = 'none';
                 }
             });
         
             document.getElementById('close-btn').addEventListener('click', function(event) {
                 document.getElementById('marker-description').style.display = 'none';
             }); 
             
         
             document.getElementById("refresh-btn").addEventListener("click", function() {
               document.getElementById("custom-alert").style.display = 'flex';
             });
         
             document.getElementById("cancel-btn").addEventListener("click", function() {
               document.getElementById("custom-alert").style.display = 'none';
             });
         
             document.getElementById("confirm-btn").addEventListener("click", function() {
               document.getElementById("custom-alert").style.display = 'none';
               window.location.href = 'eventi.php?carica=true'; 
             });
         
         
             function addItemToList(item) {
             var newItem = document.createElement('div');
             newItem.className = 'item';
         
             newItem.innerHTML = `
                 <div style="width:75%">
                   <h3>${item.titolo}</h3><br>
                   <p>${item.descrizione}</p>
                   <p style="margin-top:5%"><i>${item.comune} (${item.provincia})</i></p>
                   <p style="margin-top:3%"><u>ANNO ${item.anno}</u></p>
                 </div>
                 <button class="info-button" onclick="InfoEvento(${item.id})">VAI ALLA FIERA</button>
             `;
         
             
             document.getElementById('items-list').appendChild(newItem);
         }
         
         function removeAllItems() {
           var itemsList = document.getElementById('items-list');
           while (itemsList.firstChild) {
             itemsList.removeChild(itemsList.firstChild);
           }
         }
         
         function refreshItems() {
           for(let i=0;i<eventi.length;i++) {
             addItemToList({titolo: eventi[i][1], descrizione: eventi[i][2], id: eventi[i][0], anno: eventi[i][6], provincia: eventi[i][7], comune: eventi[i][8]});
           }
         }
         
         
         var queryFiltro="";
         
         
         document.getElementById('search-input').addEventListener('input', function() {
             var searchText = this.value.trim(); 
         
             if (queryFiltro=="") {
               queryFiltro=queryFiltro+ "WHERE denom LIKE '%"+searchText+"%'";
             }else{
               queryFiltro=queryFiltro+ " AND WHERE denom LIKE '%"+searchText+"%'";
             }
         
             
             if(document.getElementById("tipoevento").value!="noVal") {
             if (queryFiltro=="") {
               queryFiltro= queryFiltro+"WHERE evento.id_tipo = "+document.getElementById("tipoevento").value+"";
             }else{
               queryFiltro=queryFiltro+" AND evento.id_tipo = "+document.getElementById("tipoevento").value+"";
             }
           }
         
           if(document.getElementById("organizzatore").value!="noVal") {
             if (queryFiltro=="") {
               queryFiltro= queryFiltro+"WHERE evento.id_organizzazione = "+document.getElementById("organizzatore").value+"";
             }else{
               queryFiltro=queryFiltro+" AND evento.id_organizzazione = "+document.getElementById("organizzatore").value+"";
             }
           }
         
         
         
           if(document.getElementById("provincia").value!="noVal") {
             if (queryFiltro=="") {
               queryFiltro= queryFiltro+"WHERE provincia.nome = '"+document.getElementById("provincia").value+"'";
             }else{
               queryFiltro=queryFiltro+" AND provincia.nome = '"+document.getElementById("provincia").value+"'";
             }
           }
         
         
           if(document.getElementById("comune").value!="noVal") {
             if (queryFiltro=="") {
               queryFiltro= queryFiltro+"WHERE evento.id_comune = '"+document.getElementById("comune").value+"'";
             }else{
               queryFiltro=queryFiltro+" AND evento.id_comune = '"+document.getElementById("comune").value+"'";
             }
           }
         
         
           if(document.getElementById("anno").value!="noVal") {
             if (queryFiltro=="") {
               queryFiltro= queryFiltro+"WHERE evento.anno = "+document.getElementById("anno").value+"";
             }else{
               queryFiltro=queryFiltro+" AND evento.anno = "+document.getElementById("anno").value+"";
             }
           }
         
         
         
           if(document.getElementById("data_inizio").value!="") {
             if (queryFiltro=="") {
               queryFiltro= queryFiltro+"WHERE evento.data_in >= '"+document.getElementById("data_inizio").value+"'";
             }else{
               queryFiltro=queryFiltro+" AND evento.data_in >= '"+document.getElementById("data_inizio").value+"'";
             }
           }
         
         
           if(document.getElementById("data_fine").value!="") {
             if (queryFiltro=="") {
               queryFiltro= queryFiltro+"WHERE evento.data_fine <= '"+document.getElementById("data_fine").value+"'";
             }else{
               queryFiltro=queryFiltro+" AND evento.data_fine <= '"+document.getElementById("data_fine").value+"'";
             }
           }
         
         
             var xhr = new XMLHttpRequest();
         
             xhr.open("POST", "query.php", true);
             
             xhr.setRequestHeader("Content-Type", "application/json");
             
             xhr.onreadystatechange = function() {
               if (xhr.readyState == 4 && xhr.status == 200) {
                 if(xhr.responseText) {
                   if(JSON.parse(xhr.responseText)) { 
                     if (JSON.parse(xhr.responseText)!="[]") {
                       eventi = JSON.parse(xhr.responseText);
                       removeAllItems();
                       removeAllWaypoints();
                       refreshItems()
                       addWaypointsToMap(eventi);
                     }
                   }
                 }
               }
             };
         
             var dati = JSON.stringify({ query: queryFiltro });
           
             xhr.send(dati);
             queryFiltro ="";
         
         });
         
         
         function provinciaSelezionata() {
             var select = document.getElementById("provincia");
             var selectCom = document.getElementById("comune");
             
             var selectedOption = select.options[select.selectedIndex].value;
         
             selectCom.innerHTML = '<option value="noVal">SELEZIONA IL COMUNE</option>';
         
             let query = "";
         
             query = "WHERE provincia.nome ='"+selectedOption+"'";
         
             var xhr = new XMLHttpRequest();
         
             xhr.open("POST", "filtro_provincia.php", true);
             
             xhr.setRequestHeader("Content-Type", "application/json");
             
             xhr.onreadystatechange = function() {
                 if (xhr.readyState == 4 && xhr.status == 200) {
                   if (JSON.parse(xhr.responseText)!="[]") {
                       JSON.parse(xhr.responseText).forEach(function(comune){
                         var nuovaOpzione = document.createElement("option");
                         nuovaOpzione.text = comune[0];
                         nuovaOpzione.value = comune[1].toUpperCase(); 
                         selectCom.add(nuovaOpzione);
                       });
                     }
                 }
             };
         
             var dati = JSON.stringify({ query: query });
             
             xhr.send(dati);
         
         }
         
         function ApplicaFiltri() {
         
           if(document.getElementById("search-input").value!="") {
             queryFiltro=queryFiltro+ "WHERE evento.denom LIKE '%"+document.getElementById("search-input").value.trim()+"%'";
           }
         
         
           if(document.getElementById("tipoevento").value!="noVal") {
             if (queryFiltro=="") {
               queryFiltro= queryFiltro+"WHERE evento.id_tipo = "+document.getElementById("tipoevento").value+"";
             }else{
               queryFiltro=queryFiltro+" AND evento.id_tipo = "+document.getElementById("tipoevento").value+"";
             }
           }
         
           if(document.getElementById("organizzatore").value!="noVal") {
             if (queryFiltro=="") {
               queryFiltro= queryFiltro+"WHERE evento.id_organizzazione = "+document.getElementById("organizzatore").value+"";
             }else{
               queryFiltro=queryFiltro+" AND evento.id_organizzazione = "+document.getElementById("organizzatore").value+"";
             }
           }
         
         
         
           if(document.getElementById("provincia").value!="noVal") {
             if (queryFiltro=="") {
               queryFiltro= queryFiltro+"WHERE provincia.nome = '"+document.getElementById("provincia").value+"'";
             }else{
               queryFiltro=queryFiltro+" AND provincia.nome = '"+document.getElementById("provincia").value+"'";
             }
           }
         
         
           if(document.getElementById("comune").value!="noVal") {
             if (queryFiltro=="") {
               queryFiltro= queryFiltro+"WHERE evento.id_comune = '"+document.getElementById("comune").value+"'";
             }else{
               queryFiltro=queryFiltro+" AND evento.id_comune = '"+document.getElementById("comune").value+"'";
             }
           }
         
         
           if(document.getElementById("anno").value!="noVal") {
             if (queryFiltro=="") {
               queryFiltro= queryFiltro+"WHERE evento.anno = "+document.getElementById("anno").value+"";
             }else{
               queryFiltro=queryFiltro+" AND evento.anno = "+document.getElementById("anno").value+"";
             }
           }
         
         
         
           if(document.getElementById("data_inizio").value!="") {
             if (queryFiltro=="") {
               queryFiltro= queryFiltro+"WHERE evento.data_in >= '"+document.getElementById("data_inizio").value+"'";
             }else{
               queryFiltro=queryFiltro+" AND evento.data_in >= '"+document.getElementById("data_inizio").value+"'";
             }
           }
         
         
           if(document.getElementById("data_fine").value!="") {
             if (queryFiltro=="") {
               queryFiltro= queryFiltro+"WHERE evento.data_fine <= '"+document.getElementById("data_fine").value+"'";
             }else{
               queryFiltro=queryFiltro+" AND evento.data_fine <= '"+document.getElementById("data_fine").value+"'";
             }
           }
         
             var xhr = new XMLHttpRequest();
         
             xhr.open("POST", "query.php", true);
             
             xhr.setRequestHeader("Content-Type", "application/json");
             
             xhr.onreadystatechange = function() {
                 if (xhr.readyState == 4 && xhr.status == 200) {
                   if (JSON.parse(xhr.responseText)!="[]") {
                       eventi = JSON.parse(xhr.responseText);
                       removeAllItems();
                       removeAllWaypoints();
                       refreshItems()
                       addWaypointsToMap(eventi);
                     }
                 }
             };
         
             var dati = JSON.stringify({ query: queryFiltro });
             
             xhr.send(dati);
             queryFiltro="";
         
         }
         
         
         function RimuoviFiltri() {
           var selects = document.querySelectorAll(".filters select");
           var inputs = document.querySelectorAll(".filters input[type='text']");
           document.getElementById("search-input").value = "";
         
         
           selects.forEach(function(select) {
               select.value = "noVal";
           });
         
           inputs.forEach(function(input) {
               input.value = "";
           });
         
           var selectCom = document.getElementById("comune");
           selectCom.innerHTML = '<option value="noVal">SELEZIONA IL COMUNE</option>';
         
           queryFiltro="";
         
           var xhr = new XMLHttpRequest();
         
           xhr.open("POST", "query.php", true);
           
           xhr.setRequestHeader("Content-Type", "application/json");
           
           xhr.onreadystatechange = function() {
               if (xhr.readyState == 4 && xhr.status == 200) {
                 if (JSON.parse(xhr.responseText)!="[]") {
                     eventi = JSON.parse(xhr.responseText);
                     removeAllItems();
                     removeAllWaypoints();
                     refreshItems()
                     addWaypointsToMap(eventi);
                   }
               }
           };
         
           var dati = JSON.stringify({ query: queryFiltro });
           
           xhr.send(dati);
           queryFiltro="";
         }
         
         window.onload = function() {
           var dataInizioInput = document.getElementById("data_inizio");
           var dataFineInput = document.getElementById("data_fine");
         
           dataInizioInput.addEventListener("blur", function() {
               if (dataInizioInput.type === "text" && !dataInizioInput.value) {
                   dataInizioInput.value = "";
               }
           });
         
           dataFineInput.addEventListener("blur", function() {
               if (dataFineInput.type === "text" && !dataFineInput.value) {
                   dataFineInput.value = "";
               }
           });
         };
         
         
         addWaypointsToMap(eventi);
         refreshItems();
         
      </script>
   </body>
</html>