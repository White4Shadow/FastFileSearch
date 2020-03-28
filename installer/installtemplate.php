
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Installer</title>

    <!-- Bootstrap -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />

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
            <a class="navbar-brand" href="?">FileSearch              </a>
        </nav>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

    </nav>

    <div class="jumbotron">
        <h1>Installationsvorbereitungen</h1>
        <p>Vor der Installation benötigen wir noch einige Informationen:</p>
        <form autocomplete="off"  method="post"  >
            <div class="form-group" >
                <label for="header">Name des Projekts:</label>
                <input autocomplete="off" type="text" class="form-control" id="header" name="header" aria-describedby="headerHelp" placeholder="FileSearch">
                <small id="headerHelp" class="form-text text-muted">Bitte geben Sie einen Namen an, der oben links erscheinen soll.</small>
            </div>
            <div class="form-group" >
                <label for="database">Pfad zur Datenbank:</label>
                <input autocomplete="off" type="text" class="form-control" id="database" name="database" aria-describedby="databaseHelp" placeholder="/">
                <small id="databaseHelp" class="form-text text-muted">Bitte geben Sie den absoluten Pfad an. Beispiel: /var/www/vhosts/domain/database/</small>
            </div>
            <div class="form-group">
                <label for="username">Administrator-Benutzername</label>
                <input autocomplete="off" type="text" class="form-control" name="username" id="username"  placeholder="Benutzername">
            </div>
            <div class="form-group">
                <label for="password">Administrator-Passwort</label>
                <input autocomplete="off" type="password" class="form-control" name="password" id="password"  placeholder="Passwort">
            </div>

            <button type="submit" name="install" class="btn btn-outline-success">Installation starten</button>
            <small id="submitHelp" class="form-text text-muted">Nach Start der Installation werden Sie automatisch zum Loginbereich weitergeleitet.</small>

        </form>
    </div>


    <!-- jQuery -->
    <script src="../assets/js/jquery-3.3.1.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>


</div>
</body>
</html>