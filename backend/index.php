<?php


include_once 'config/require.php';
include_once "lib/functions.php";


if(isset($_SESSION['user']['id'])) {

    // Wenn Suchanfrage gestellt wird
    if(isset($_POST['search'])){
        $totalcount = 0;
        $filenames = array();


            // Parameter in Variablen speichern
            $searchQuery = trim($_POST['searchQuery']);
            $field = trim($_POST['field']);

            // Suchfunktion ausführen
            $hits = php_grep($field,$searchQuery);
            $totalcount += $hits['count'];
            array_push($filenames,$hits['filename']);

    }

        // Suchmaske
        include_once "template.php";

}else{
    header("Location: ../../index.php");
}

