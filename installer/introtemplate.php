
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
            <a class="navbar-brand" href="#">FileSearch              </a>
        </nav>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

    </nav>

        <div class="jumbotron">
            <h1>Einführung</h1>
            <p>Was Sie vor der Installation wissen sollten:</p>
            <form autocomplete="off"  method="get" >
                <p>Im nächsen Schritt werden Sie aufgefordert den absoluten Pfad und ein Administrationspasswort festzulegen.</p>
                <p>Im Datenbankordner wird automatisch ein user/ und ein cache/ Ordner erstellt, der alle User enthält. Die log.json die alle, für das System relevante, Angaben bereitstellt finden Sie unter <b>/backend/config/log.json</b>. <b>Passworte</b> werden <b>niemlas in Klartext</b>, sondern <b>immer als SHA-1 Hash</b> gespeichert. Bitte stellen Sie sicher, dass <b>Schreibrechte</b> auf dem, von ihnen angebgebenen, <b>Datenbankordner</b> gegeben sind.</p>
                <p><b>Weitere Einstellungen</b>, wie die Angabe von Kategorien, oder das verwalten von Angaben, nehmen Sie in den <b>Einstellungen im Administrationsbereich nach der Installation</b> vor.</p>
                <p><b>Hinweise zur Datenbank:</b> Die Datenbank sollte aus Dateien im JSON-Format vorliegen.</p>
                <a href="?install"  class="btn btn-outline-success">Weiter</a>
            </form>
        </div>

    <!-- jQuery -->
    <script src="../assets/js/jquery-3.3.1.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>


</div>
</body>
</html>