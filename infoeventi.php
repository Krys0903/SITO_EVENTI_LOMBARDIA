<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Dati Lombardia</title>
      <link rel="icon" href="https://i.imgur.com/FD639yK.png" type="image/png">
      <link rel="stylesheet" href="stile.css">
   </head>
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
      .container {
      width: 50%;
      margin: 0 auto;
      padding: 20px;
      height:100%;
      }
      h1 {
      text-align: center;
      }
      table {
      width: 100%;
      height:50%;
      border-collapse: collapse;
      border-radius: 10px;
      overflow: hidden; 
      box-shadow: 0 15px 35px rgba(0,0,0,9);
      }
      td {
      padding: 15px 20px;
      border-bottom: 1px solid #ddd;
      }
      td:first-child {
      width: 40%;
      font-weight: bold;
      }
      td:last-child {
      width: 60%;
      text-align: right;
      }
      tr:not(:last-child) {
      border-bottom: 2px solid #28a745; 
      }
      tr:nth-child(even) {
      background-color: #f9f9f9; 
      }
   </style>
   <body>
      <?php
         session_start();
         
         $host = 'localhost';
         $user = '5biin-15';
         $pass = '5biin-15';
         $db='5biin-15';
         $conn = new mysqli($host,$user,$pass,$db);
         $id = $_GET["id"];
         
         
         if ($conn->connect_error) {
             die("Connessione fallita: " . $conn->connect_error);
         }
         
         $sql = "SELECT * FROM evento WHERE id='$id'";
         
         $result = $conn->query($sql);
         
         if ($result->num_rows > 0) {
             while ($row = $result->fetch_assoc()) {
                 $nome = $row["denom"];
                 $n_ediz = $row["n_ediz"];
                 $descrizione = $row["descrizione"];
                 if($descrizione=="NULL") { $descrizione = "NESSUNA DESCRIZIONE";};
                 $ora_inizio = $row["ora_in"];
                 $ora_fine = $row["ora_fine"];
                 $data_inizio = $row["data_in"];
                 $data_fine = $row["data_fine"];
                 $anno = $row["anno"];
                 $coord_x = $row["coordinata_x"];
                 $coord_y = $row["coordinata_y"];
                 $linkgooglemaps = "https://www.google.com/maps/search/?api=1&query=$coord_y%2C$coord_x";
                 $linkprogramma = $row["url_programma"];
                 $id_organizzatore = $row["id_organizzazione"];
                 $indirizzoTemp =  $row["indirizzo"];
                 $id_toponimo =  $row["id_toponimo"];
                 $id_tipo =  $row["id_tipo"];
                 $id_comune = $row["id_comune"];
             }
         } else {
             echo "Nessun risultato trovato";
         }
         
         $sql = "SELECT toponimo.descrizione FROM toponimo INNER JOIN evento on toponimo.id = evento.id_toponimo  WHERE evento.id='$id'";
         $result = $conn->query($sql);
         
         
         if ($result->num_rows > 0) {
             $row = $result->fetch_assoc();
             $indirizzo = strtoupper($row["descrizione"]. " ". $indirizzoTemp);
         } else {
             echo "Nessun risultato trovato";
         }
         
         $sql = "SELECT organizzazione.nome FROM organizzazione INNER JOIN evento on organizzazione.id = evento.id_organizzazione  WHERE evento.id='$id'";
         $result = $conn->query($sql);
         
         
         if ($result->num_rows > 0) {
             $row = $result->fetch_assoc();
             $organizzazione = $row["nome"];
         } else {
             echo "Nessun risultato trovato";
         } 
         
         $sql = "SELECT tipo.descrizione FROM tipo INNER JOIN evento on tipo.id = evento.id_tipo  WHERE evento.id='$id'";
         $result = $conn->query($sql);
         
         if ($result->num_rows > 0) {
             $row = $result->fetch_assoc();
             $tipo = $row["descrizione"];
         } else {
             echo "Nessun risultato trovato";
         } 
         
         $sql = "SELECT comune.nome, comune.id_prov, comune.cap, comune.istat FROM comune INNER JOIN evento on comune.id = evento.id_comune  WHERE evento.id='$id'";
         $result = $conn->query($sql);
         
         if ($result->num_rows > 0) {
             $row = $result->fetch_assoc();
             $nome_comune = $row["nome"];
             $id_prov = $row["id_prov"];
             $cap = $row["cap"];
             $istat = $row["istat"];
         } else {
             echo "Nessun risultato trovato";
         } 
         
         $sql = "SELECT provincia.nome FROM provincia WHERE provincia.id='$id_prov'";
         $result = $conn->query($sql);
         
         
         if ($result->num_rows > 0) {
             $row = $result->fetch_assoc();
             $nome_provincia = $row["nome"];
         } else {
             echo "Nessun risultato trovato";
         } 
         
         $conn->close();
         
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
      <header>
         <h1><?php echo strtoupper($tipo).": ".strtoupper($nome); ?></h1>
      </header>
      <div class="container">
         <table>
            <tr>
               <td>ID</td>
               <td><?php echo strtoupper($id); ?></td>
            </tr>
            <tr>
               <td>TIPO EVENTO</td>
               <td><?php echo strtoupper($tipo); ?></td>
            </tr>
            <tr>
               <td>NOME</td>
               <td><?php echo strtoupper($nome); ?></td>
            </tr>
            <tr>
               <td>DESCRIZIONE</td>
               <td><?php echo strtoupper($descrizione); ?></td>
            </tr>
            <tr>
               <td>ORGANIZZATORE</td>
               <td><?php echo strtoupper($organizzazione); ?></td>
            </tr>
            <tr>
               <td>N° EDIZIONE</td>
               <td><?php echo strtoupper($n_ediz); ?></td>
            </tr>
            <tr>
               <td>DATA INIZIO</td>
               <td><?php echo strtoupper($data_inizio); ?></td>
            </tr>
            <tr>
               <td>ORARIO INIZIO</td>
               <td><?php echo strtoupper($ora_inizio); ?></td>
            </tr>
            <tr>
               <td>DATA FINE</td>
               <td><?php echo strtoupper($data_fine); ?></td>
            </tr>
            <tr>
               <td>ORARIO FINE</td>
               <td><?php echo strtoupper($ora_fine); ?></td>
            </tr>
            <tr>
               <td>ANNO</td>
               <td><?php echo strtoupper($anno); ?></td>
            </tr>
            <tr>
               <td>PROVINCIA</td>
               <td><?php echo strtoupper($nome_provincia); ?></td>
            </tr>
            <tr>
               <td>COMUNE</td>
               <td><?php echo strtoupper($nome_comune); ?></td>
            </tr>
            <tr>
               <td>CAP</td>
               <td><?php echo strtoupper($cap); ?></td>
            </tr>
            <tr>
               <td>ISTAT</td>
               <td><?php echo strtoupper($istat); ?></td>
            </tr>
            <tr>
               <td>INDIRIZZO</td>
               <td><?php echo "<a href= '$linkgooglemaps' target='_blank' >$indirizzo</a>"; ?></td>
            </tr>
            <tr>
               <td>PROGRAMMA</td>
               <td><?php echo "<a href= '$linkprogramma' target='_blank' >SCARICA PROGRAMMA</a>"; ?></td>
            </tr>
         </table>
      </div>
      <br><br>
      <footer>
         <p>© 2024 DATI LOMBARDIA. TUTTI I DIRITTI RISERVATI.</p>
      </footer>
   </body>
</html>