<?php
session_start();
$blockedResult = null;
$unBlockedResult = null;
$change = null;
//Eseguo il require dei file esterni necessari.
require_once('php/db_connection.php');
require_once('php/data_change.php');
//Creao gli oggetti delle classi necessarie;
$conn = new connection();
$gestions = new gestions();
//Controllo se é stato eseguito il POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  //Eseguo il controllo su quale bottone submit viene premuto, in base ai dati con cui l'amministratore lavora.
  if (isset($_POST["anno"]) && isset($_POST["id"])){
    //Creo delle variabili di sessione e le assegno il valore che é contenuto nel post degli input dell'anno e dell'id.
    $_SESSION["anno"] = $_POST["anno"];
    $_SESSION["id"] = $_POST["id"];
  }
  //Se l'amministratore lavora con la tabella degli utenti bloccati, richiamo le funzioni specifiche con i relativi parametri.
  //Altrimenti "so" che sta lavorando con l'altra tabella.
  if (isset($_POST["start"]) && isset($_POST["end"])) {
    if (isset($_POST["studentBlocked"])) {
        $gestions->getCheckboxState($_POST["studentBlocked"], $_SESSION["anno"], $_SESSION["id"], 0, $conn);
    }
    if (isset($_POST["YouTubeBlocked"])) {
        $gestions->getCheckboxYouTube($_POST["YouTubeBlocked"], $_SESSION["anno"], $_SESSION["id"], 0, $conn);
    }
  }
  else {
    if (isset($_POST["studentUnBlocked"])) {
        $gestions->getCheckboxState($_POST["studentUnBlocked"], $_SESSION["anno"], $_SESSION["id"], 1, $conn);
    }
    if (isset($_POST["youTubeUnBlocked"])) {
        $gestions->getCheckboxYouTube($_POST["youTubeUnBlocked"], $_SESSION["anno"], $_SESSION["id"], 1, $conn);
    }
  }
}
//Stampo a schermo le tabelle anche senza la necessità del click del primo bottone submit.
if (isset($_SESSION["anno"]) && isset($_SESSION["id"])) {
    //Richiamo la funzione desiderata passandogli i parametri che necessita.
  $blockedResult = $conn->getClassBlocked($_SESSION["anno"], $_SESSION["id"]);
  $unBlockedResult = $conn->getClassUnblocked($_SESSION["anno"], $_SESSION["id"]);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Progetto SAMT Controllo dell’accesso ad una rete WiFi tramite proxy Server I4AC 2018">
  <meta name="author" content="Alessandro Gomes">
  <link rel="icon" href="Media/favicon.ico">

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet">

  <!-- Custom script for this template
  <link href="js/script.js" rel="stylesheet">-->

<title>Gestione accessi</title>

</head>
<body onload="getData()">
  <div class="container">
    <header class="header clearfix">
      <nav>
        <ul class="nav nav-pills float-right">
          <li class="nav-item">
            <a class="nav-link active" href="index.php">Accessi <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="php/White-List.php">White-List</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="php/log.php">Log</a>
          </li>
        </ul>
      </nav>
      <h1>RETE - ACCESSO AD INTERNET PER CLASSI</h1>
      <br>
      <h2>Controllo accesso ad internet per allievi SAM / IN / I "Informatico"</h2>
    </header>
    <main role="main">
      <div class="jumbotron">
        <form class="form" action="" method="post">
          <div class="row">
            <div class="col-md-4 mb-3">
              <label for="anno">Anno scolastico</label>
              <select class="custom-select d-block w-100" name="anno" id="year" required>
                <option value="">Choose...</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
              </select>
            </div>
            <div class="col-md-4 mb-3">
              <label for="state">Classe</label>
              <select class="custom-select d-block w-100" name="id" id="id" required>
                <option value="">Choose...</option>
                <option value="AA">AA</option>
                <option value="AC">AC</option>
                <option value="BB">BB</option>
                <option value="BC">BC</option>
              </select>
            </div>
            <div class="col-md-4 mb-3">
              <label for="state">###################### </label>
              <button  name="checkButton" type="submit" class="btn btn-lg btn-outline-secondary" style="font-size: medium; height">Visualizza stato</button>
              <label for="state">###################### </label>
            </div>
          </div>
        </form>
      </div>
      <h2>Allievi bloccati</h2>
      <div class="jumbotron">
        <form class="form" action="" method="post">
            <div class="row">
              <div class="col-md-8 mb-3">
                <table class="table table-striped">
                  <tr>
                    <th>Nome</th>
                    <th>Cognome</th>
                    <th>Stato</th>
                    <th>
                      Seleziona
                      <input type="checkbox" class="checkedAllBlockedSeleziona" id="checkAllBlockedState" checked>
                    </th>
                    <th>
                      YouTube
                      <input type="checkbox" class="checkedAllBlockedYouTube" id="checkAllBlockedYoutube">
                    </th>
                    <th>Classe</th>
                  </tr>
                  <?php for ($i=0; $i < count($blockedResult); $i++): ?>
                    <tr>
                      <td><?php echo $blockedResult[$i]['Nome']; ?></td>
                      <td><?php echo $blockedResult[$i]['Cognome']; ?></td>
                      <td><?php echo "<img src='Media/red.png' width='15px' height='15px'/>" ?></td>
                      <td><input type="checkbox" class="checkBlockedState" name="studentBlocked[]" value="<?php echo $blockedResult[$i]['Nome']. "_" . $blockedResult[$i]['Cognome']?>" checked></td>
                      <td>
                        <?php
                          //Tramite un'operatore ternario controllo se lo stato di YouTube é 0 o 1 (false o true),
                          //in base al risultato carico l'immagine che serve.
                          echo ($blockedResult[$i]['Youtube'] == 0 ?
                          "<img src='Media/red.png' style='margin-left:10px; height:1rem; width:1rem;'/>" : "<img src='Media/green.png' style='margin-left:10px; height:1rem; width:1rem;'/>"
                          );
                        ?>
                        <input type="checkbox" class="checkBlockedYouTube" name="YouTubeBlocked[]" value="<?php echo $blockedResult[$i]['Nome']. "_" . $blockedResult[$i]['Cognome']?>">
                      </td>
                      <td>
                        <?php echo $blockedResult[$i]['Anno_Classe'].$blockedResult[$i]['Id_Classe']; ?>
                      </td>
                    </tr>
                  <?php endfor; ?>
                  <input type="hidden" name="anno" value="<?php echo $_SESSION["anno"] ?>">
                  <input type="hidden" name="id" value="<?php echo $_SESSION["id"] ?>">
                </table>
              </div>
              <div class="col-md-4 mb-3">
                <table class="table table-striped">
                  <tr>
                    <th class="azione">Azione</th>
                  </tr>
                  <tr>
                    <td>
                      <div class="row">
                        <div class="col-md-6 mb-3">
                          <label for="state">Inizio sblocco</label>
                          <select class="custom-select d-block" name="start">
                            <option value="">Choose...</option>
                          </select>
                        </div>
                        <div class="col-md-6 mb-3">
                          <label for="state">Fine sblocco</label>
                          <select class="custom-select d-block" name="end">
                            <option value="">Choose...</option>
                          </select>
                        </div>
                        <div class="col-md-1 mb-3">
                          <button name="checkButton" type="submit" class="btn btn-outline-secondary" style="font-size: medium; height" >Sblocca selezionati</button>
                        </div>
                      </div>
                    </td>
                  </tr>
                </table>
              </div>
            </div>
          <br>
      </form>
    </div>
    <h2>Allievi sbloccati</h2>
    <div class="jumbotron">
      <form class="form" action="" method="post">
          <div class="row">
            <div class="col-md-10 mb-3">
              <table class="table table-striped">
                <tr>
                  <th>Nome</th>
                  <th>Cognome</th>
                  <th>Stato</th>
                  <th>
                    Seleziona
                    <input type="checkbox" class="checkedAllSblockedSeleziona" id="checkAllSblockedState" >
                  </th>
                  <th>
                    YouTube
                    <input type="checkbox" class="checkedAllSblockedYouTube" id="checkAllSblockedYouTube">
                  </th>
                  <th>Classe</th>
                </tr>
                <?php for ($i=0; $i < count($unBlockedResult); $i++): ?>
                  <tr>
                    <td><?php echo $unBlockedResult[$i]['Nome']; ?></td>
                    <td><?php echo $unBlockedResult[$i]['Cognome']; ?></td>
                    <td><?php echo "<img src='Media/green.png' width='15px' height='15px'/>" ?></td>
                    <td><input type="checkbox" class="checkSblockedState" name="studentUnBlocked[]" value="<?php echo $unBlockedResult[$i]['Nome']. "_" . $unBlockedResult[$i]['Cognome']?>"></td>
                    <td>
                      <?php
                      //Tramite un'operatore ternario controllo se lo stato di YouTube é 0 o 1 (false o true),
                      //in base al risultato carico l'immagine che serve.
                      echo ($unBlockedResult[$i]['Youtube'] == 1 ?
                      "<img src='Media/green.png' style='margin-left:10px; height:1rem; width:1rem;'/>" : "<img src='Media/red.png' style='margin-left:10px; height:1rem; width:1rem;'/>");
                      ?>
                      <input type="checkbox" class="checkSblockedYouTube" name="youTubeUnBlocked[]" value="<?php echo $unBlockedResult[$i]['Nome']. "_" . $unBlockedResult[$i]['Cognome']?>">
                    </td>
                    <td><?php echo $unBlockedResult[$i]['Anno_Classe'].$unBlockedResult[$i]['Id_Classe']; ?></td>
                  </tr>
                <?php endfor;?>
                <input type="hidden" name="anno" value="<?php echo $_SESSION["anno"] ?>">
                <input type="hidden" name="id" value="<?php echo $_SESSION["id"] ?>">
              </table>
            </div>
            <div class="col-md-2 mb-3">
              <table class="table table-striped">
                <tr>
                  <th class="azione">Azione</th>
                </tr>
                <tr>
                  <td>
                    <button name="checkButton" type="submit" class="btn btn-outline-secondary" style="font-size: medium; height">Blocca selezionati</button>
                  </td>
                </tr>
              </table>
            </div>
          </div>
      </form>
    </div>
  </main>
</div>
<script type="text/javascript">
//Funzione che permette la gestione del checkbox select all dello stato presente nella tabella degli utenti bloccati.
$("#checkAllBlockedState").click(function () {
  $(".checkBlockedState").prop('checked', $(this).prop('checked'));
});

//Funzione che permette la gestione del checkbox select all di YouTube presente nella tabella degli utenti bloccati.
$("#checkAllBlockedYoutube").click(function () {
  $(".checkBlockedYouTube").prop('checked', $(this).prop('checked'));
});

//Funzione che permette la gestione del checkbox select all dello stato presente nella tabella degli utenti sbloccati.
$("#checkAllSblockedState").click(function () {
  $(".checkSblockedState").prop('checked', $(this).prop('checked'));
});

//Funzione che permette la gestione del checkbox select all di YouTube presente nella tabella degli utenti sbloccati.
$("#checkAllSblockedYouTube").click(function () {
  $(".checkSblockedYouTube").prop('checked', $(this).prop('checked'));
});
var year = null;
var id = null;
function getData(){
  year = "<?php echo $_SESSION["anno"]; ?>";
  id = "<?php echo $_SESSION["id"]; ?>";

  document.getElementById("id").value = id;
  document.getElementById("year").value = year;
}
</script>
</body>
</html>
