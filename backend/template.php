<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?=$title?></title>

    <!-- Bootstrap -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />
    <link href="css/jquery-ui.min.css" rel="stylesheet" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv370.js"></script>
      <script src="../assets/js/respond.min.js"></script>
      <![endif]-->
  </head>
  <body>
      <div id="body">

          <nav class="navbar navbar-expand-lg navbar-light bg-light">
              <!-- Image and text -->
              <nav class="navbar navbar-light bg-light">
                  <a class="navbar-brand" href="?home"><?=$title?>                  </a>
              </nav>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
              </button>

              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav mr-auto">
                      <li class="nav-item">
                          <a class="nav-link" href="?home">Suche</a>
                      </li>
                  </ul>
                  <a class="btn btn-outline-danger my-2 my-sm-0 logout" href="?logout">Abmelden</a>
              </div>
          </nav>

            <?php if(isset($_GET['home'])): ?>
          <!-- Search Form -->

              <form autocomplete="off"  method="post" class="text-center row border border-light p-5 ">

                  <div class="col-md-12">

              <p class="h4 mb-4">Suchanfrage starten</p>
              <div class="form-row">
                  <!-- Searchphrase -->
                  <div class="col-4">
                      <select name="field" class="form-control form-control-sm">
                          <?php foreach ($categories as $c=>$v): ?>
                              <option value="none-<?=$c?>"><?=$c?></option>
                              <?php
                              $fTmp =  $categories[$c]==null ? [] : explode(",",$categories[$c]);
                              foreach ($fTmp as $field): ?>
                                  <option value="<?=$c?>-<?=$field?>">- <?=$field?></option>
                              <?php endforeach; ?>
                          <?php endforeach; ?>
                      </select>
                  </div>
                  <div class="col-8">
                      <input type="text" id="searchQuery" name="searchQuery" class="form-control mb-4" placeholder="Enthält.." >

                  </div>

              </div>


                      </div>


                  <button class="btn btn-outline-dark btn-block " name="search" type="submit">Suchen</button>

              </form>



          <?php if(isset($_POST['search'])): ?>

          <div class="container">


                  <h4>Suchergebnisse</h4>
                  <h2 class="lead"><strong class="text-danger"><?=$totalcount?></strong> Treffer gefunden. </h2>

                <table class="table">
                    <tbody>
                    <?php foreach ($hits as $k => $v): if($k != "filename" && $k != "searchQuery" && $k != "count" && $k != "queryGen"): ?>

                    <tr>
                        <td> <?=$v?></td> <td><a class="btn btn-success" href="<?=$k?>" target="_blank">Download</a></td>
                    </tr>
                    <?php endif; endforeach; ?>
                    </tbody>
                </table>

          </div>
          <?php endif; ?>
          <?php endif; ?>
      </div>
          <script src="../assets/js/jquery-3.3.1.min.js"></script>
          <script src="js/jquery-ui.min.js"></script>
          <script src="../assets/js/popper.min.js"></script>
          <script src="../assets/js/bootstrap.min.js"></script>



</body>
</html>