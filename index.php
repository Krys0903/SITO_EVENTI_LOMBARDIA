<!DOCTYPE html>
<html>
   <?php
      session_start();
      ?>
   <head>
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <title>DATI LOMBARDIA</title>
      <link rel="icon" href="https://i.imgur.com/FD639yK.png" type="image/png">
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <link rel="stylesheet" type="text/css" media="screen" href="stile.css" />
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
         body {
         font-family: Arial, sans-serif;
         margin: 0;
         padding: 0;
         background-color: #f4f4f4;
         }
         .container {
         width: 90%;
         max-width: 1200px;
         margin: 0 auto;
         background-color: white;
         padding: 20px;
         box-shadow: 0 15px 35px rgba(0,0,0,9);
         border-radius: 10px;
         margin-top: 25px;
         }
         main {
         padding: 20px 0;
         }
         .intro {
         text-align: center;
         padding: 20px 0;
         }
         .intro h2 {
         font-size: 2em;
         font-weight: 600;
         margin-bottom: 20px;
         color: #ff6f61;
         }
         .intro p {
         font-size: 1.1em;
         line-height: 1.6;
         margin-bottom: 20px;
         color: #666;
         }
         .images {
         display: flex;
         justify-content: center;
         gap: 20px;
         margin-top: 20px;
         }
         .images img {
         max-width: 45%;
         height: auto;
         border-radius: 10px;
         box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
         transition: transform 0.3s, box-shadow 0.3s;
         }
         .images img:hover {
         transform: scale(1.05);
         box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
         }
      </style>
   </head>
   <body>
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
         <h1>BENVENUTI NELLA NOSTRA HOMEPAGE</h1>
      </header>
      <div class="container">
         <section class="intro">
            <p>LE SAGRE E LE FIERE SONO EVENTI CHE CELEBRANO LA CULTURA, L'ENOGASTRONOMIA E LE TRADIZIONI LOCALI DELLA LOMBARDIA. IN QUESTO SITO TROVERETE UNA GUIDA COMPLETA AGLI EVENTI LOMBARDI, CON DETTAGLI SULLE DATE, LE ATTRAZIONI PRINCIPALI E CONSIGLI SU COME GODERSI AL MEGLIO OGNI MANIFESTAZIONE.</p>
            <p>LE SAGRE OFFRONO L'OPPORTUNITÀ DI SCOPRIRE I PRODOTTI TIPICI DEL TERRITORIO, COME FORMAGGI, SALUMI, VINI E DOLCI. OGNI EVENTO È UN VIAGGIO TRA I SAPORI AUTENTICI DELLA LOMBARDIA. LE FIERE, INVECE, PRESENTANO ARTIGIANATO, INNOVAZIONE E COMMERCIO, CON ESPOSIZIONI CHE SPAZIANO DALL'ARTE ALLE TECNOLOGIE MODERNE.</p>
            <p>PARTECIPARE A UNA SAGRA O A UNA FIERA SIGNIFICA ENTRARE IN CONTATTO CON LA COMUNITÀ LOCALE E VIVERE UN'ESPERIENZA UNICA. ESPLORATE IL NOSTRO SITO PER TROVARE GLI EVENTI CHE VI INTERESSANO DI PIÙ E PIANIFICARE LA VOSTRA VISITA. NON PERDETE L'OCCASIONE DI SCOPRIRE LE TRADIZIONI LOMBARDE!</p>
            <p>IL SITO È COSTANTEMENTE AGGIORNATO CON LE ULTIME NOVITÀ SUGLI EVENTI IN PROGRAMMA. TORNATE SPESSO PER SCOPRIRE LE NUOVE SAGRE E FIERE. BUONA ESPLORAZIONE E BUON DIVERTIMENTO!</p>
            <h4>SITO REALIZZATO DA ANTONIO RUSSO & CRISTIAN SHIMA</h4>
            <div class="images">
               <img src="https://i.imgur.com/xr6LkFK.jpeg" alt="">
               <img src="https://i.imgur.com/hb7k8NQ.jpeg" alt="">
            </div>
         </section>
      </div>
      <br><br><br><br>
      <footer>
         <p>© 2024 DATI LOMBARDIA. TUTTI I DIRITTI RISERVATI.</p>
      </footer>
   </body>
</html>