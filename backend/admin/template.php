
<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Administration</title>

    <!-- Bootstrap -->
    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="../../assets/js/html5shiv370.js"></script>
      <script src="../../assets/js/respond.min.js"></script>

      <![endif]-->

  </head>
  <body>

  <div id="body">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <!-- Image and text -->
          <nav class="navbar navbar-light bg-light">
              <a class="navbar-brand" href="?home"><?=$title?> </a>
          </nav>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                  <li class="nav-item">
                      <a class="nav-link" href="?import">Import</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="?user">Benutzer</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="?settings">Einstellungen</a>
                  </li>
              </ul>
              <a class="btn btn-outline-danger my-2 my-sm-0 logout" href="?logout">Abmelden</a>
          </div>
      </nav>
<!-- /Search Form -->
      <?php if(isset($_GET['home'])): ?>
      <div class="jumbotron">
          <h1>Hallo, <?=$_SESSION['user']['username']?></h1>
          <p>Bitte wähle aus folgenden Optionen:</p>

          <div class="row">
              <div class="col-sm-4 text-center">
                  <a href="?import" class="card">
                      <div class="card-body color-black">
                          <h5 class="card-title">Import</h5>
                          <p class="card-text">Dateien in die Datenbank hinzufügen.</p>
                      </div>
                  </a>
              </div>
              <div class="col-sm-4 text-center">
                  <a href="?user" class="card">
                      <div class="card-body color-black">
                          <h5 class="card-title">Benutzer verwalten</h5>
                          <p class="card-text">Benutzer anlegen oder verwalten.</p>
                      </div>
                  </a>
              </div>
          <div class="col-sm-4 text-center">
              <a href="?settings" class="card">
                  <div class="card-body color-black">
                      <h5 class="card-title">Einstellungen</h5>
                      <p class="card-text">Nehmen Sie Veränderungen am System vor.</p>
                  </div>
              </a>
          </div>
          </div>
      </div>


      <?php endif; ?>
      <!-- Import - Anfang -->
      <?php if(isset($_GET['import'])): ?>
      <div class="jumbotron ">
          <h1>Importfunktion</h1>
          <p>Hier können Sie auswählen zwischen Import/Export:</p>
          <form method="get" class="display-inline">
              <button class="btn btn-outline-success my-2 my-sm-0" name="manimport" type="submit">Import</button>
          </form>

      </div>

    <?php endif; ?>

      <?php if(isset($_GET['manimport'])): ?>
          <div class="jumbotron row">
              <div class="col-md-6">
              <h1>Manueller Import</h1>
              <p>Hier können Sie eine neue Datei hinzufügen:</p>
              <form  method="post" enctype="multipart/form-data">
                  <div class="form-group" >
                      <input type="file" class="form-control-file" id="fileUpload" name="fileUpload" aria-describedby="fileHelp" placeholder="Datei auswählen">
                      <small id="fileHelp" class="form-text text-muted">Bitte nur Dateien im vorgegebenem JSON Format hinzufügen.</small>
                  </div>


                  <button type="submit" class="btn btn-outline-success">Hinzufügen</button>
              </form>
          </div>

          <div class="col-md-6">

              <p><strong>Beispiel JSON-Format:</strong></p>
              <span>{<br>
                        "metadata": {
          <br>"type": "poem",
          <br>"author": "Guido Zernatto",
          <br>"title": "18 Gedichte",
          <br>"booktitle": "... kündet laut die Zeit",
          <br>"publisher": "Stiasny Verlag",
          <br>"editor": "Hans Brunmayr",
         <br> "year": "1961"
         <br> },
         <br> "content": {
         <br> "Sommerabend": "Gegen neun verdreht der Wind       \n Über uns den Zug der Wolkenfläume       \n Und fällt tiefer unten in die Bäume,       \n Die schon schattenlos im Dämmer sind.\nIn den Gräsern ist noch Ruh       \n Und die abendliche Feuchte zeigt sich       \n Kühl. Aus einem Fenster neigt sich       \n Mein Gesicht der Erde zu.        \n"
         <br> }
         <br> }
              </span>

          </div>
          </div>

      <?php endif; ?>
      <!-- Import - Ende -->
      <!-- Benutzerverwaltung - Anfang -->
      <?php if(isset($_GET['user'])): ?>
          <div class="jumbotron ">
              <h1>Nutzerverwaltung</h1>
              <p>Hier können Sie bestehende oder neue Nutzer Verwalten:</p>

              <form method="get" class="d-inline"  >
                  <button class="btn btn-outline-success my-2 my-sm-0" name="create" type="submit">Benutzer anlegen</button>
              </form>
              <form method="get" class="d-inline">
                  <button class="btn btn-outline-success my-2 my-sm-0" name="manage" type="submit">Benutzer verwalten</button>
              </form>

          </div>

      <?php endif; ?>
      <?php if(isset($_GET['create'])): ?>
      <div class="jumbotron">
          <h1>Benutzer anlegen</h1>
          <p>Hier können Sie einen neuen Benutzer anlegen:</p>
          <form autocomplete="off"  method="post" >
              <div class="form-group" >
                  <label for="username">Benutzername</label>
                  <input autocomplete="off" type="text" class="form-control" id="username" name="username" aria-describedby="usernameHelp" placeholder="Benutzername">
                  <small id="usernameHelp" class="form-text text-muted">Benutzernamen oder E-Mail angeben.</small>
              </div>
              <div class="form-group">
                  <label for="password">Passwort</label>
                  <input autocomplete="off" type="password" class="form-control" name="password" id="password"  placeholder="Passwort">
              </div>

              <button type="submit" class="btn btn-outline-success">Anlegen</button>
          </form>
      </div>
      <?php endif; ?>
      <?php if(isset($_GET['manage'])): ?>
          <div class="jumbotron">
              <h1>Benutzer verwalten</h1>
              <p>Hier können Sie ihre bestehenden Benutzer verwalten:</p>
              <table class="table">
                  <thead>
                  <tr>
                      <th scope="col">Benutzer</th>
                      <th scope="col">Aktion</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  $user = opendir($userPath);
                  while ($u = readdir($user)):
                      if($u != "." && $u != ".." ):
                      $userData = json_decode(file_get_contents($userPath.$u),true);
                      ?>
                    <tr><td><?=$userData['username']?></td><td><a class="btn btn-outline-danger" href="?manage&delete=<?=$u?>">Löschen</a></td></tr>
                  <?php endif; ?>
                  <?php endwhile; ?>
                  </tbody>
              </table>
          </div>
      <?php endif; ?>
      <!-- Benutzerverwaltung - Ende -->

      <!-- Einstellungen - Anfang -->
      <?php if(isset($_GET['settings'])): ?>
          <div class="jumbotron">
              <h1>Einstellungen</h1>
              <h3>Websitename ändern</h3>
              <table class="mb-3">
              <tr>
              <form method="post">
                  <td><input autocomplete="off" type="text" class="form-control" id="project" name="project" placeholder="<?=$title?>"></td><td><button class="btn btn-outline-success" type="submit" >Anpassen</button></td>
              </form>
              </tr>
              </table>
              <h3>Cache leeren</h3>
              <p>Hier können Sie den Cache leeren:</p>
              <form class="mb-3" method="post" >
                  <button class="btn btn-outline-danger my-2 my-sm-0" name="cache" type="submit">Cache leeren</button>
              </form>
              <h3>Kategorien verwalten</h3>
              <table class="table">
                  <thead>
                  <tr>
                      <th scope="col">Kategorie</th>
                      <th scope="col">Aktion</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach ($categories as $c=>$v): ?>
                          <tr><td><?=$c?></td><td><a class="btn btn-outline-danger" href="?settings&deleteCategory=<?=$c?>">Löschen</a></td></tr>
                  <?php endforeach; ?>
                  <?php if (empty($categories)): ?>
                  <tr><td colspan="2">Sie haben derzeit keine Kategorien defniert.</td></tr>
                  <?php endif; ?>
                  <tr>
                  <form method="post">
                  <td><input autocomplete="off" type="text" class="form-control" id="category" name="category" placeholder="Kategorie"></td><td><button class="btn btn-outline-success" type="submit" >Hinzufügen</button></td>
                  </form>
                  </tr>
                  </tbody>
              </table>
              <h3>Felder verwalten</h3>
              <table class="table">
                  <thead>
                  <tr>
                      <th scope="col">Feld</th>
                      <th scope="col">Kategorie</th>
                      <th scope="col">Aktion</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach ($categories as $c=>$v): ?>
                  <?php if(!empty($c) && !empty($v)):
                      $felder = explode(",",$v);
                      foreach ($felder as $f): ?>
                      <tr><td><?=$f?></td><td><?=$c?></td><td><a class="btn btn-outline-danger" href="?settings&deleteFeld=<?=$f?>&cat=<?=$c?>">Löschen</a></td></tr>
                  <?php endforeach; ?>
                  <?php endif; endforeach; ?>
                  <tr>
                      <form method="post">
                          <td><input autocomplete="off" type="text" class="form-control" id="feld" name="feld" placeholder="Feld"></td>
                          <td>
                              <select name="selectedCat" class="form-control form-control-sm">
                                 <?php foreach ($categories as $c=>$v): ?><option><?=$c?></option> <?php endforeach; ?>
                              </select>
                          </td>
                          <td><button class="btn btn-outline-success" type="submit" >Hinzufügen</button></td>
                      </form>
                  </tr>
                  </tbody>
              </table>
          </div>

      <?php endif; ?>
      <!-- Einstellungen - Ende -->

            <!-- jQuery -->
          <script src="../../assets/js/jquery-3.3.1.min.js"></script>
          <script src="../../assets/js/popper.min.js"></script>
          <script src="../../assets/js/bootstrap.min.js"></script>


      </div>
</body>
</html>