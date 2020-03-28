<?php
// Loginfunktion
if(isset($_POST['username']) && isset($_POST['password'])){
    include_once "backend/config/require.php";

    $username = $_POST['username'];
    $password = $_POST['password'];
    $database = $log['dbpath']."user/";

    $file = preg_replace ( '/[^a-z0-9 ]/i', '', $username);
    $file .= ".json";
    $error = "";
    if(file_exists($database.$file)){

        $user = json_decode(file_get_contents($database.$file),true);

        if(sha1($password)==$user['password'] && $username==$user['username'] ) {
            $_SESSION['user']['id'] = $user['id'];
            $_SESSION['user']['username'] = $user['username'];

            if ($user['id'] == 1) {
                header("Location: backend/admin/?home");
            } else {
                header("Location: backend/?home");
            }
        }else{
            $error="Benutzername oder Passwort sind falsch";
        }

    }else{
        $error="Benutzername existiert nicht";

    }


}

include_once "template.php";