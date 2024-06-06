<!doctype html>
<html lang="en">
   <?php
      session_start();
      ?>
   <head>
      <meta charset="UTF-8">
      <title>DATI LOMBARDIA</title>
      <link rel="stylesheet" href="stile.css">
      <link rel="icon" href="https://i.imgur.com/FD639yK.png" type="image/png">
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
         .alert {
         position: fixed;
         top:0;
         left: 0;
         width: 100%;
         height: 100%;
         background-color: rgba(0, 0, 0, 0.5);
         display: flex;
         justify-content: center;
         align-items: center;
         z-index: 1000;
         }
         .hidden {
         display: none;
         }
         .alertContent {
         background-color: #f0f0f0;
         padding: 20px;
         border-radius: 5px;
         text-align: center;
         box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
         position: relative;
         animation: slideDown 0.4s ease;
         }
         .closeBtn {
         position: absolute;
         top: 3px;
         right: 5px;
         font-size: 20px;
         cursor: pointer;
         color: black;
         }
         .closeBtn:hover {
         color: black;
         }
         @keyframes slideDown {
         from {
         transform: translateY(-100%);
         }
         to {
         transform: translateY(0);
         }
         }
      </style>
      <script>
         var tipoScelto;
         
         function mostraAlert(tipo, msg) {
           tipoScelto = tipo;
           if (tipo == "successo") {
             document.getElementById('paragrafo').innerHTML = msg;
             document.getElementById('alertContent').style.border = "2px solid green";
           }else if (tipo == "errore") {
             document.getElementById('paragrafo').innerHTML = msg;
             document.getElementById('alertContent').style.border = "2px solid red";
           }
           
           document.getElementById('successAlert').classList.remove('hidden');
         }
         
           function chiudiAlertSucc() {
             document.getElementById('successAlert').classList.add('hidden');
             if (tipoScelto=="successo") {
               window.location.href="index.php"
             }
           }
      </script>
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
      <div id="successAlert" class="alert hidden">
         <div class="alertContent" id = "alertContent">
            <span class="closeBtn" onclick="chiudiAlertSucc()">&times;</span>
            <p id="paragrafo"></p>
         </div>
      </div>
      <header>
         <h1>REGISTRAZIONE</h1>
      </header>
      <div id="sezione">
         <div class="signin">
            <div class="content">
               <h2>REGISTRAZIONE</h2>
               <form name="menu" class="formRoba" method="POST">
                  <div class="inputBox"> 
                     <input type="text" name="nome" required> <i>NOME</i> 
                  </div>
                  <div class="inputBox"> 
                     <input type="text" name="cognome" required> <i>COGNOME</i> 
                  </div>
                  <div class="inputBox"> 
                     <input type="text" name="email" required> <i>EMAIL</i> 
                  </div>
                  <div class="inputBox"> 
                     <input type="password" name="password" required> <i>PASSWORD</i> 
                  </div>
                  <div class="links"> 
                     <u style="color:green"><a href="login.php">VAI AL LOGIN</a></u>
                  </div>
                  <div class="inputBox"> 
                     <input type="submit" name="sendReg" value="REGISTRATI"> 
                  </div>
               </form>
            </div>
         </div>
      </div>
      <footer>
         <p>© 2024 DATI LOMBARDIA. TUTTI I DIRITTI RISERVATI.</p>
      </footer>
      <?php
         $host = "localhost";
         $user = "5biin-15";
         $pass = "5biin-15";
         $db = "5biin-15";
         $conn = new mysqli($host, $user, $pass, $db);
         
         if(isset($_POST["sendReg"])) {
         
           $nome = $_POST["nome"];
           $cognome = $_POST["cognome"];
           $email = $_POST["email"];
           $password = $_POST["password"];
           
           $sql = "SELECT * FROM utenti WHERE email='" . $email . "'";
           $result = $conn->query($sql);
         
           if ($result->num_rows > 0) {
             echo '<script>mostraAlert("errore", "QUESTA EMAIL È GIÁ REGISTRATA")</script>';
           }else{
               
             $sql = "INSERT INTO utenti (nome, cognome, email, password) VALUES ('$nome', '$cognome', '$email', '$password')";
         
             if ($conn->query($sql) === TRUE) {
               $_SESSION["email_loggato"] =$email;
               echo '<script>mostraAlert("successo", "TI SEI REGISTRATO CON SUCCESSO")</script>';
             } else {
               echo "Errore";
             }
           }
         }
         
         ?>
   </body>
</html>