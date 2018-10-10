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
  <body>
    <div class="container">
      <header class="header clearfix">
        <nav>
          <ul class="nav nav-pills float-right">
            <li class="nav-item">
              <a class="nav-link active" href="index.html">Accessi <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="log.php">Log</a>
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
                  <select class="custom-select d-block w-100" name="anno" required>
                    <option value="">Choose...</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                  </select>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="state">Classe</label>
                  <select class="custom-select d-block w-100" name="id" required>
                    <option value="">Choose...</option>
                    <option value="AA">AA</option>
                    <option value="AC">AC</option>
                    <option value="BB">BB</option>
                    <option value="BC">BC</option>
                  </select>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="state" style="width:100%; height:30%"> </label>
                  <button name="checkButton" type="submit" class="btn btn-lg btn-outline-secondary" style="font-size: medium; height">Visualizza stato</button>
                </div>
              </div>
          </form>
        </div>
        <h2>Allievi bloccati</h2>
        <div class="jumbotron">
            <form class="form" action="" method="post">
            <?php
              //Controllo se é stato eseguito il POST
              if ($_SERVER["REQUEST_METHOD"] == "POST") :
                //Eseguo la connessione al database
                require_once('php/db_connection.php');
                $conn = new connection();
                //Richiamo la funzione desiderata passandogli i parametri che necessita.
                $result = $conn->getClassBlocked($_POST["anno"], $_POST["id"]);
            ?>
            <table class="table table-striped">
              <tr>
              <th>Nome</th>
              <th>Cognome</th>
              <th>Stato</th>
              <th>
                Seleziona
                <input type="checkbox" class="checked" id="checkAllBlockedState">
              </th>
              <th>
                YouTube
                <input type="checkbox" class="checked" id="checkAllBlocked">
              </th>
              <th>Classe</th>
              </tr>
              <?php for ($i=0; $i < count($result); $i++): ?>
                <tr>
                  <td><?php echo $result[$i]['Nome']; ?></td>
                  <td><?php echo $result[$i]['Cognome']; ?></td>
                  <td><?php echo "<img src='Media/red.png' width='15px' height='15px'/>" ?></td>
                  <td><input type="checkbox" class="checkBlockedState"></td>
                  <td>
                    <?php
                      //Tramite un'operatore ternario controllo se lo stato di YouTube é 0 o 1 (false o true),
                      //in base al risultato carico l'immagine che serve.
                      echo ($result[$i]['Youtube'] == 0 ?
                      "<img src='Media/red.png' style='margin-left:10px; height:1rem; width:1rem;'/>" : "<img src='Media/green.png' width='15px' height='15px'/>"
                      );
                    ?>
                    <input type="checkbox" class="checkBlocked">
                  </td>
                  <td><?php echo $result[$i]['Anno_Classe'].$result[$i]['Id_Classe']; ?></td>
                </tr>
              <?php endfor; ?>
            </table>
            <table class="table table-striped">

            </table>
            <br>
            <?php endif; ?>
          </form>
        </div>
        <h2>Allievi sbloccati</h2>
        <div class="jumbotron">
            <form class="form" action="" method="post">
              <?php
                //Controllo se é stato eseguito il POST
                if ($_SERVER["REQUEST_METHOD"] == "POST") :
                  //Eseguo la connessione al database
                  require_once('php/db_connection.php');
                  $conn = new connection();
                  //Richiamo la funzione desiderata passandogli i parametri che necessita.
                  $result = $conn->getClassSblocked($_POST["anno"], $_POST["id"]);
                  //print_r($result);
              ?>
              <table class="table table-striped">
                <tr>
                <th>Nome</th>
                <th>Cognome</th>
                <th>Stato</th>
                <th>
                  Seleziona
                  <input type="checkbox" class="checked">
                </th>
                <th>
                  YouTube
                  <input type="checkbox" class="checked">
                </th>
                <th>Classe</th>
                </tr>
                <?php for ($i=0; $i < count($result); $i++): ?>
                  <tr>
                    <td><?php echo $result[$i]['Nome']; ?></td>
                    <td><?php echo $result[$i]['Cognome']; ?></td>
                    <td><?php echo "<img src='Media/green.png' width='15px' height='15px'/>" ?></td>
                    <td><input type="checkbox" class="check"></td>
                    <td>
                      <?php
                        //Tramite un'operatore ternario controllo se lo stato di YouTube é 0 o 1 (false o true),
                        //in base al risultato carico l'immagine che serve.
                        echo ($result[$i]['Youtube'] == 1 ?
                        "<img src='Media/green.png' width='15px' height='15px'/>" : "<img src='Media/red.png' width='15px' height='15px'/>");
                      ?>
                      <input type="checkbox" class="check">
                    </td>
                    <td><?php echo $result[$i]['Anno_Classe'].$result[$i]['Id_Classe']; ?></td>
                  </tr>
                <?php endfor;?>
              </table>
              <br>
              <?php endif; ?>
          </form>
        </div>
      </main>
    </div>
    <script>
    $("#checkAllBlockedState").click(function () {
        $(".checkBlockedState").prop('checked', $(this).prop('checked'));
    });


    </script>
  </body>
</html>
