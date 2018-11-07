<?php
  session_start();

  require('linkGestions.php');
  $classe = new linkGestions();
  //Richiamo la funzione desiderata passandogli i parametri che necessita.
  $get = $classe->getData();

  //Controllo se é stato eseguito il POST
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Eseguo il controllo su quale bottone submit viene premuto, in base ai dati con cui l'amministratore lavora.
    if (isset($_POST["webSite"])) {
      $_SESSION["webSite"] = $_POST["webSite"];
    }
  }
  if (isset($_SESSION["webSite"])) {
    $set = $classe->setData($_SESSION["webSite"]);
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Progetto SAMT Controllo dell’accesso ad una rete WiFi tramite proxy Server I4AC 2018">
  <meta name="author" content="Alessandro Gomes">
  <link rel="icon" href="images/favicon.ico">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

  <!-- Custom styles for this template -->
  <link href="../css/style.css" rel="stylesheet">

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

  <title>White-List server proxy</title>
</head>
<body>
  <div class="container">
    <header class="header clearfix">
      <nav>
        <ul class="nav nav-pills float-right">
          <li class="nav-item">
            <a class="nav-link" href="../index.php">Accessi</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="White-List.php">White-List<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="log.php">Log</a>
          </li>
        </ul>
      </nav>
      <h1>RETE - ACCESSO AD INTERNET PER CLASSI</h1>
      <br>
      <h2>Controllo file delle White-List SAM / IN / I "Informatico"</h2>
    </header>
    <main role="main">
      <h2>File delle White-List del proxy server squid</h2>
      <div class="jumbotron">
        <form class="form" action="" method="post">
          <div class="row">
            <div class="col-md-4 mb-3">
              <div class="form-group">
                <label for="usr">Inserire Link</label>
                <input type="text" class="form-control" id="link" name="webSite" required>
              </div>
            </div>
            <div class="col-md-4 mb-3">
              <label for="state">###################### </label>
              <button name="checkButton" type="submit" class="btn btn-lg btn-outline-secondary" style="font-size: medium; height">Abilitare link</button>
              <label for="state">###################### </label>
            </div>
          </div>
        </form>
        <div class="row">
          <div class="col-md-10 mb-3">
            <table class="table table-striped">
              <tr>
                <th>Link</th>
              </tr>
                <?php for ($i=0; $i < count($get); $i++): ?>
                <tr>
                  <td><?php echo $get[$i][0]; ?></td>
                </tr>
                <?php endfor;?>
            </table>
          </div>
        </div>
      </div>
    </main>
  </div>
</body>
</html>
